function Container() {
    this.id = '';
    this.className = '';
    this.htmlCode = '';
    this.src = '';
    this.alt = '';
}

Container.prototype.render = function() {
    return this.htmlCode;
};

function Gallery(myId, myClass, myItems, mySrc, myAlt) {
    Container.call(this);
    this.id = myId;
    this.className = myClass;
    this.items = myItems;
    this.src = mySrc;
    this.alt = myAlt;
}

Gallery.prototype = Object.create(Container.prototype);
Gallery.prototype.constructor = Gallery;

Gallery.prototype.render = function() {
    var res = '<div class="' + this.className + '">';

    for (var item in this.items) {
        if (this.items[item] instanceof GalleryItem) {
            res += this.items[item].render();
        }
    }
    res += '</div>';
    return res;
};

function GalleryItem(myId, myClass, myItems, mySrc, myAlt) {
    Container.call(this);
    this.id = myId;
    this.className = myClass;
    this.items = myItems;
    this.src = mySrc;
    this.alt = myAlt;
}

GalleryItem.prototype = Object.create(Container.prototype);
GalleryItem.prototype.constructor = GalleryItem;

GalleryItem.prototype.render = function() {
    return '<a href="' + this.src + '" target="_blank">'
        + '<img src="' + this.src + '" alt="' + this.alt + '" class="' + this.className + '"></a>';
};

window.onload = function() {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', './js-2_2-3.json', true);
        xhr.send();

        xhr.onreadystatechange = function() {
            if (xhr.readyState != 4) return;

            if (xhr.status != 200) {
                console.log('Error', xhr.status, xhr.statusText);
            } else {
                var items = [];
                var myItems = JSON.parse(xhr.responseText);

                for (var i = 0; i < myItems.length; i++) {
                    items.push(new GalleryItem('galleryItemId', 'gallery__items', 'galleryItemItems', myItems[i].src, myItems[i].alt));
                }

                var galleryNew = new Gallery('galleryId', 'gallery', items, 'gallerySrc', 'galleryAlt');

                document.getElementById('wrapper').innerHTML = galleryNew.render();
            }
        }

    };