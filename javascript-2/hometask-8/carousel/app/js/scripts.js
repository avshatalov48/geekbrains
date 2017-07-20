function Container() {
    this.id = '';
    this.className = '';
    this.htmlCode = '';
}

Container.prototype.render = function () {
    return this.htmlCode;
};

function Carousel() {
    Container.call(this, "carousel");
    this.widthCarousel = 0;
    this.leftString = 0;
    this.productsSlide = 0;
    this.productsFirst = 0;
    this.countProducts = 0;
    this.productsItems = [];
    this.widthCarouselNav = function() {
        return $('.carousel__nav').width();
    }
    this.widthProduct = function () {
        // return (this.widthCarousel - this.widthCarouselNav()*2)/ this.productsSlide;
        return $('.carousel__products-container').width()+20;
    };
    this.widthString = function () {
        var widthString = (this.widthProduct()) * this.countProducts;
        $('.carousel__products-string').css({'width': widthString});
        return widthString;
    };
    this.loadCarouselItems();
    this.render();
    this.renderDots();
    this.keyDown();
}

Carousel.prototype = Object.create(Container.prototype);
Carousel.prototype.constructor = Carousel;

Carousel.prototype.arrows = function(direction) {
    if (direction == 'right') {
        this.leftString -= this.widthProduct();
        this.productsFirst++;
    } else {
        this.leftString += this.widthProduct();
        this.productsFirst--;
    }
    if (this.leftString > 0) {
        this.leftString = 0;
        this.productsFirst = 1;
    }
    if (this.leftString < (this.widthProduct()*this.productsSlide-this.widthString())) {
        this.leftString = (this.widthProduct())*this.productsSlide-this.widthString();
        this.productsFirst = this.countProducts - this.productsSlide + 1;
    }

    $('.carousel__products-string').css({'left': this.leftString});

    console.log(this.productsFirst, this.leftString, this.widthCarouselNav(), this.widthProduct(), this.widthString());

    this.renderDots('.carousel__dots-items');
};


Carousel.prototype.render = function(root) {

    $('.carousel').css({'width': this.widthCarousel});
    this.widthCarouselNav();
    this.widthProduct();
    this.widthString();

    // Отрисовка товаров
    $(root).empty();

    for (var item in this.productsItems) {
        var containerDiv = $('<div />', {
            class: 'carousel__products-container'
        });
        containerDiv.appendTo(root);

        var itemsDiv = $('<div />', {
            class: 'carousel__products-items'
        });
        itemsDiv.appendTo(containerDiv);

        var itemsImagesDiv = $('<div />', {
            class: 'carousel__products-items-images',
            style: 'background-image: url(' + this.productsItems[item].image + ')'
        });
        itemsImagesDiv.appendTo(itemsDiv);

        var itemsTitlesDiv = $('<div />', {
            class: 'carousel__products-items-titles',
            text: this.productsItems[item].title
        });
        itemsTitlesDiv.appendTo(itemsDiv);

        var itemsDescriptionsDiv = $('<div />', {
            class: 'carousel__products-items-descriptions',
            text: this.productsItems[item].description
        });
        itemsDescriptionsDiv.appendTo(itemsDiv);

        var itemsPricesDiv = $('<div />', {
            class: 'carousel__products-items-prices',
            text: this.productsItems[item].price
        });
        itemsPricesDiv.appendTo(itemsDiv);

        var itemsBasketDiv = $('<div />', {
            class: 'carousel__products-items-basket',
            text: 'В корзину'
        });
        itemsBasketDiv.appendTo(itemsDiv);
    }
};


Carousel.prototype.renderDots = function(root) {
    // Отрисовка кругляшков
    $(root).empty();

    console.log ('dots:', Math.round((this.productsFirst + 1)/ this.productsSlide));

    for (var i=1; i <= this.countProducts / this.productsSlide; i++) {

        var active = '';
        if (Math.round((this.productsFirst + 3) / this.productsSlide) == i) {
            active = ' carousel__dots-items-links-rounds_active';
        }

        // span.carousel__dots-items-links
        //     .carousel__dots-items-links-rounds.carousel__dots-items-links-rounds_active
        // span.carousel__dots-items-links
        //     .carousel__dots-items-links-rounds
        // span.carousel__dots-items-links
        //     .carousel__dots-items-links-rounds

        var dotsItemsLinks = $('<span />', {
            class: 'carousel__dots-items-links'
        });
        dotsItemsLinks.appendTo(root);

        var dotsItemsLinksRounds = $('<span />', {
            class: 'carousel__dots-items-links-rounds' + active
        });
        dotsItemsLinksRounds.appendTo(dotsItemsLinks);
    }

};


// Получаем изначальные элементы из JSON
Carousel.prototype.loadCarouselItems = function() {
    $.get({
        url: './json/carousel.json',
        dataType: 'json',
        error: function() {
            console.log ('JSON load: Error!');
        },
        success: function(data) {
            console.log ('JSON load: Ок!');
            this.widthCarousel = data.widthCarousel;
            this.productsSlide = data.productsSlide;
            this.countProducts = data.products.length;
            for (var item in data.products) {
                this.productsItems.push(data.products[item]);
            }
            this.render('.carousel__products-string');
            this.renderDots('.carousel__dots-items');
        },
        context: this
    });

};


// Обработка нажатия клавиш
Carousel.prototype.keyDown = function() {
    var _this = this,
        directions = {
            37: 'left',
            39: 'right'
        };
    $('body').on('keydown', function(e) {
        if (e.keyCode in directions) {
            _this.arrows(directions[e.keyCode]);
        }
    })
};


// Запуск функции, после загрузки документа
$(document).ready(function() {
    var carousel = new Carousel();
    // $('.carousel').show();

    // Кнопка - Влево
    $('.carousel__nav-arrows-links_left').on('click', function() { carousel.arrows('left'); });

    // Кнопка - Вправо
    $('.carousel__nav-arrows-links_right').on('click', function() { carousel.arrows('right'); });
});