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
    this.widthCarousel = 1024;
    this.productsSlide = 5;
    this.countProducts = 0;
    this.productsItems = [];
    this.loadCarouselItems();
}

Carousel.prototype = Object.create(Container.prototype);
Carousel.prototype.constructor = Carousel;

Carousel.prototype.render = function(root) {
    // for (var item in data.products) {
    //     this.productsItems.push(data.products[item]);
    // }

    // .carousel__products-container
    //     .carousel__products-items
    //     .carousel__products-items-images
    //     .carousel__products-items-titles СмартФон 1
    //     .carousel__products-items-descriptions 32Gb
    //     .carousel__products-items-prices 10$
    //     .carousel__products-items-basket В корзину
    //
    // var commentsDiv = $('<div />', {
    //     id: this.id,
    //     text: 'ОТЗЫВЫ:'
    // });
    //
    // var commentsItemsDiv = $('<div />', {
    //     id: this.id + '_items'
    // });
    //
    // commentsItemsDiv.appendTo(commentsDiv);
    // commentsDiv.appendTo(root);
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
            console.log (data);
        },
        context: this
    });
};

// Добавление отзыва
/*Carousel.prototype.add = function (idComment, text, userMessage) {
    var commentsItem = {
        "id_comment": idComment,
        "text": text,
        "submit": false
    };
    // Увеличиваем количество отзывов
    this.countCarousel++;
    // Добавляем отзыв в массив
    this.commentsItems.push(commentsItem);
    // Обновляем данные
    this.refresh();
    if (!!userMessage) alert (userMessage);
};*/

// Удаление отзыва
/*Carousel.prototype.del = function () {
    if (this.countCarousel < 1) { this.refresh(); return; }
    this.countCarousel--;
    this.commentsItems.pop();
    this.refresh();
};*/

// Одобрение отзыва
/*Carousel.prototype.submit = function () {
    this.commentsItems[this.countCarousel-1].submit = true;
    this.refresh();
};*/

// Показать все отзывы
/*Carousel.prototype.list = function () {
    $('#comments__list').remove();

    if (this.countCarousel < 1) { return; }

    var commentsDiv = $('<div />', {
        id: 'comments__list',
        html: '<br><hr><br>СПИСОК ВСЕХ ОТЗЫВОВ:<br>&nbsp;'
    });

    for (var item in this.commentsItems) {
        var comment = this.commentsItems[item],
            commentsItemsDiv = $('<div />', {
                html: '<hr width="50%"><p>Отзыв №' + comment.id_comment + '</p>'
                + '<p>Текст: <span class="comments-text-list">' + comment.text + '</span></p>'
                + '<p>Отзыв одобрен: ' + comment.submit + '</p>'
            });
        commentsItemsDiv.appendTo(commentsDiv);
    }

    commentsDiv.appendTo('body');
};*/

// Перерисовка
/*Carousel.prototype.refresh = function() {
    var commentsDataDiv = $('#comments_data');
    commentsDataDiv.empty();
    commentsDataDiv.append('<p>Всего отзывов: ' + this.countCarousel + '</p>');

    // Вывод в консоль для самопроверки
    console.log(this.commentsItems, this.countCarousel);

    if (this.countCarousel < 1) {
        $('.comments').hide();
    } else {
        $('.comments').show();
    }
};*/

// Запуск функции, после загрузки документа
$(document).ready(function() {
    var carousel = new Carousel();

    carousel.render('.carousel__products');

    // Кнопка - Влево
    $('.carousel__nav-arrows-links_left').on('click', function() {
        console.log ('Влево');
    });

    // Кнопка - Вправо
    $('.carousel__nav-arrows-links_right').on('click', function() {
        console.log ('Вправо');
    });

    // // Кнопка - Добавить
    // $('.comments-add').on('click', function() {
    //     var idComment = parseInt($(this).attr('id').split('_')[1]);
    //     var text = $(this).parent().parent().find('.comments-text').val();
    //     comments.add(idComment, text, 'Ваш отзыв был передан на модерацию!');
    // });
    //
    // // Кнопка - Удалить
    // $('.comments-delete').on('click', function() {
    //     comments.del();
    // });
    //
    // // Кнопка - Одобрить
    // $('.comments-submit').on('click', function() {
    //     comments.submit();
    // });
    //
    // // Кнопка - Показать все отзывы
    // $('.comments-list').on('click', function() {
    //     comments.list();
    // });
});
