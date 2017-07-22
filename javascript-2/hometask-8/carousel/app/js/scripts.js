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
    this.productsFirst = 1;
    this.countProducts = 0;
    this.productsItems = [];
    this.widthCarouselNav = function () {
        return $('.carousel__nav').width();
    };
    this.widthProduct = function () {
        return $('.carousel__products-container').width() + 20;
    };
    this.widthString = function () {
        var widthString = (this.widthProduct()) * this.countProducts;
        $('.carousel__products-string').css({'width': widthString});
        return widthString;
    };
    this.loadCarouselItems();
    this.render();
    this.renderDots();

    this.productsBasket = [];

    this.renderBasket();

    this.keyDown();
    this.arrows();
}

Carousel.prototype = Object.create(Container.prototype);
Carousel.prototype.constructor = Carousel;

Carousel.prototype.arrows = function (direction) {
    if (direction == 'right') {
        this.leftString -= this.widthProduct();
        this.productsFirst++;
    } else if (direction == 'left') {
        this.leftString += this.widthProduct();
        this.productsFirst--;
    } else if (!isNaN(direction)) {
        this.leftString = -((direction - 1) * this.productsSlide * this.widthProduct());
        this.productsFirst = (direction) * this.productsSlide;
    }
    if (this.leftString > 0) {
        this.leftString = 0;
        this.productsFirst = 1;
    }
    if (this.leftString < (this.widthProduct() * this.productsSlide - this.widthString())) {
        this.leftString = (this.widthProduct()) * this.productsSlide - this.widthString();
        this.productsFirst = this.countProducts - this.productsSlide + 1;
    }

    $('.carousel__products-string').css({'left': this.leftString});

    this.renderDots('.carousel__dots-items');
};


Carousel.prototype.render = function (root) {

    $('.carousel').css({'width': this.widthCarousel});

    this.widthCarouselNav();
    this.widthProduct();
    this.widthString();

    // Отрисовка товаров
    $(root).empty();

    for (var item in this.productsItems) {

        var containerDivClass = 'carousel__products-container',
            containerDivId = containerDivClass + '_' + item,
            containerDiv = $('<div />', {
            class: containerDivClass,
            id: containerDivId
        });
        containerDiv.appendTo(root);

        // Draggable для товаров (хитрости, из-за overflow: hidden;)
        $('#' + containerDivId).draggable({
            revert: 'invalid',
            helper: function(){
                var copy = $(this).clone();
                return copy;},
            appendTo: 'body',
            scroll: false,
            // Скрываем прежний товар при перетаскивании
            start: function() {
                $(this).css({'opacity': 0});
            },
            stop: function() {
                $(this).css({'opacity': 100});
            }
        });

        var itemsDiv = $('<div />', {
            class: 'carousel__products-items'
        });
        itemsDiv.appendTo(containerDiv);

        var itemsImagesDivClass = 'carousel__products-items-images',
            itemsImagesDivId = itemsImagesDivClass + '_' + item,
            itemsImagesDiv = $('<div />', {
            class: itemsImagesDivClass,
            id: itemsImagesDivId,
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
            text: this.productsItems[item].price + '$'
        });
        itemsPricesDiv.appendTo(itemsDiv);

        var itemsBasketDiv = $('<div />', {
            class: 'carousel__products-items-basket',
            text: 'В корзину'
        });
        itemsBasketDiv.appendTo(itemsDiv);
    }
};


Carousel.prototype.renderDots = function (root) {
    var _this = this;

    // Отрисовка кругляшков
    $(root).empty();

    for (var item = 1; item <= this.countProducts / this.productsSlide; ++item) {
        var active = '';

        if (Math.ceil((this.productsFirst) / this.productsSlide) == item) {
            active = ' carousel__dots-items-links-rounds_active';
        }

        var dotsItemsLinksClass = 'carousel__dots-items-links',
            dotsItemsLinks = $('<span />', {
                class: dotsItemsLinksClass
            });
        dotsItemsLinks.appendTo(root);

        var dotsItemsLinksRoundsClass = 'carousel__dots-items-links-rounds',
            dotsItemsLinksRoundsId = dotsItemsLinksRoundsClass + '_' + item,
            dotsItemsLinksRounds = $('<span />', {
                id: dotsItemsLinksRoundsId,
                class: dotsItemsLinksRoundsClass + active
            });
        dotsItemsLinksRounds.appendTo(dotsItemsLinks);

        // Добавление клика кругляшкам
        $('#' + dotsItemsLinksRoundsId).on('click', function () {
            _this.arrows($(this).attr('id').split('_')[3]);
        });
    }

};


Carousel.prototype.renderBasket = function (root) {
    var _this = this;

    // Отрисовка таблицы товаров
    $(root).empty();

    if (this.productsBasket.length>0) {

        // <Шапка таблицы товаров>
        var basketTableRowHeaderClass = 'basket__table-row basket__table-row_header',
            basketTableRowHeader = $('<div />', {
                class: basketTableRowHeaderClass
            });
        basketTableRowHeader.appendTo(root);

        var basketTableCellNumbersClass = 'basket__table-cell basket__table-cell_numbers',
            basketTableCellNumbers = $('<span />', {
                class: basketTableCellNumbersClass,
                text: '№'
            });
        basketTableCellNumbers.appendTo(basketTableRowHeader);

        var basketTableCellTitlesClass = 'basket__table-cell basket__table-cell_titles',
            basketTableCellTitles = $('<span />', {
                class: basketTableCellTitlesClass,
                text: 'Наименование'
            });
        basketTableCellTitles.appendTo(basketTableRowHeader);

        var basketTableCellPhotosClass = 'basket__table-cell basket__table-cell_photos',
            basketTableCellPhotos = $('<span />', {
                class: basketTableCellPhotosClass,
                text: 'Фото'
            });
        basketTableCellPhotos.appendTo(basketTableRowHeader);

        var basketTableCellDescriptionsClass = 'basket__table-cell basket__table-cell_descriptions',
            basketTableCellDescriptions = $('<span />', {
                class: basketTableCellDescriptionsClass,
                text: 'Описание'
            });
        basketTableCellDescriptions.appendTo(basketTableRowHeader);

        var basketTableCellPricesClass = 'basket__table-cell basket__table-cell_prices',
            basketTableCellPrices = $('<span />', {
                class: basketTableCellPricesClass,
                text: 'Цена'
            });
        basketTableCellPrices.appendTo(basketTableRowHeader);

        var basketTableCellDelClass = 'basket__table-cell basket__table-cell_del',
            basketTableCellDel = $('<span />', {
                class: basketTableCellDelClass,
                text: 'Операция'
            });
        basketTableCellDel.appendTo(basketTableRowHeader);
        // </Шапка таблицы товаров>


        // <Содержимое таблицы товаров>
        var total = 0;
        for (var product in this.productsBasket) {

            var item = this.productsBasket[product];

            var basketTableRowProductsClass = 'basket__table-row basket__table-row_products',
                basketTableRowProducts = $('<div />', {
                    class: basketTableRowProductsClass
                });
            basketTableRowProducts.appendTo(root);

            var basketTableCellNumbersClass = 'basket__table-cell basket__table-cell_numbers',
                basketTableCellNumbers = $('<span />', {
                    class: basketTableCellNumbersClass
                    // text: parseInt(product)+1
                });
            basketTableCellNumbers.appendTo(basketTableRowProducts);

            var basketTableCellTitlesClass = 'basket__table-cell basket__table-cell_titles',
                basketTableCellTitles = $('<span />', {
                    class: basketTableCellTitlesClass,
                    text: this.productsItems[item].title
                });
            basketTableCellTitles.appendTo(basketTableRowProducts);

            var basketTableCellPhotosClass = 'basket__table-cell basket__table-cell_photos',
                basketTableCellPhotos = $('<span />', {
                    class: basketTableCellPhotosClass,
                    style: 'background-image: url(' + this.productsItems[item].image + ')'
                    // text: this.productsItems[item].image
                });
            basketTableCellPhotos.appendTo(basketTableRowProducts);

            var basketTableCellDescriptionsClass = 'basket__table-cell basket__table-cell_descriptions',
                basketTableCellDescriptions = $('<span />', {
                    class: basketTableCellDescriptionsClass,
                    text: this.productsItems[item].description
                });
            basketTableCellDescriptions.appendTo(basketTableRowProducts);


            var price = this.productsItems[item].price,
                basketTableCellPricesClass = 'basket__table-cell basket__table-cell_prices',
                basketTableCellPrices = $('<span />', {
                    class: basketTableCellPricesClass,
                    text: price + '$'
                });
            basketTableCellPrices.appendTo(basketTableRowProducts);

            total += price;

            var basketTableCellDelClass = 'basket__table-cell basket__table-cell_del',
                basketTableCellDelId = 'basket__table-cell' + '_' + item,
                basketTableCellDel = $('<span />', {
                    class: basketTableCellDelClass,
                    id: basketTableCellDelId,
                    text: 'Удалить'
                });
            basketTableCellDel.appendTo(basketTableRowProducts);

            // Удаление товара
            $('#' + basketTableCellDelId).on('click', function () {
                $('#' + this.id).parent().remove();
                // _this.renderBasket('.basket__table');
                // To Do:
                // 1) Вынести в отдельный метод
                // 2) Удалять из массива
                // 3) Пересчет итоговой суммы
                // 4) Сделать фотографии-заглушки
                // 5) Убрать img/temp из Gulp
            });

        }
        // </Содержимое таблицы товаров>


        // <Футер таблицы товаров>
        var basketTableRowSumClass = 'basket__table-row basket__table-row_sum',
            basketTableRowSum = $('<div />', {
                class: basketTableRowSumClass
            });
        basketTableRowSum.appendTo(root);

        for (var i = 1; i <= 5; i++) {
            var basketTableCellClass = 'basket__table-cell',
                basketTableCell = $('<span />', {
                    class: basketTableCellClass,
                    html: '&nbsp;'
                });
            basketTableCell.appendTo(basketTableRowSum);
        }

        var basketTableCellTotalClass = 'basket__table-cell basket__table-cell_total',
            basketTableCellTotal = $('<span />', {
                class: basketTableCellTotalClass,
                text: 'ИТОГО: ' + total + '$'
            });
        basketTableCellTotal.appendTo(basketTableRowSum);
        // </Футер таблицы товаров>
    }
};


// Получаем изначальные элементы из JSON
Carousel.prototype.loadCarouselItems = function () {
    $.get({
        url: './json/carousel.json',
        dataType: 'json',
        error: function () {
            console.log('JSON load: Error!');
        },
        success: function (data) {
            console.log('JSON-file load: Ок!');
            this.widthCarousel = data.widthCarousel;
            this.productsSlide = data.productsSlide;
            this.countProducts = data.products.length;
            for (var item in data.products) {
                this.productsItems.push(data.products[item]);
            }
            this.render('.carousel__products-string');
            this.renderDots('.carousel__dots-items');
            this.renderBasket('.basket__table');
            $('.carousel').css({'opacity': 100});
        },
        context: this
    });
};


// Обработка нажатия клавиш
Carousel.prototype.keyDown = function () {
    var _this = this,
        directions = {
            37: 'left',
            39: 'right'
        };
    $('body').on('keydown', function (e) {
        if (e.keyCode in directions) {
            _this.arrows(directions[e.keyCode]);
        }
    })
};


// Запуск функции, после загрузки документа
$(document).ready(function () {
    var carousel = new Carousel();

    // Кнопка - Влево
    $('.carousel__nav-arrows-links_left').on('click', function () {
        carousel.arrows('left');
    });

    // Кнопка - Вправо
    $('.carousel__nav-arrows-links_right').on('click', function () {
        carousel.arrows('right');
    });

    // Droppable для корзины
    $('.basket').droppable({
        drop: function(event, ui) {
            $('.basket').css('border', 'solid 1px white');
            var dropItemId = ui.draggable[0].id,
                dropItem = $('#' + dropItemId).attr('id').split('_')[3];
            carousel.productsBasket.push(dropItem);
            carousel.renderBasket('.basket__table');
            console.log(carousel.productsBasket, dropItem, carousel.productsItems[dropItem]);
        },
        over: function(event, ui) {
            // $('.basket').effect('pulsate', 1000)
            $('.basket').css('border', 'solid 1px #007DC7');
        }
    });

});