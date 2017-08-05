// To Do:
// + Добавлена возможность управления эффектом transition, его параметрами
// + Кнопки "В корзину" задействовать
// + Сделать фотографии-заглушки
// + Под ИТОГО - кнопка "Оформить", "Купить"
// + Уникальные id т.к. удаляет сразу несколько товаров или менять-добавлять количество
// + Валюта
// + После удаления элементов, id становятся не уникальными
// + Вынести в отдельный метод
// + Удалять из массива
// + Пересчет итоговой суммы
// + Убрать img/temp из Gulp


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
    this.effects = true;
    this.widthCarousel = 0;
    this.currency = '';
    this.leftString = 0;
    this.productsSlide = 0;
    this.productsFirst = 1;
    this.countProducts = 0;
    this.productsItems = [];

    this.effectsString = function () {
        if (this.effects!='') {
            var effectsString = {
                '-webkit-transition': this.effects,
                '-o-transition': this.effects,
                'transition': this.effects
            };
            $('.carousel__products-string').css(effectsString);
        }
    };

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
    this.delBasket();
    this.addBasket();
    this.amountBasket();
    this.totalBasket();
    this.renderBasket();

    this.keyDown();
    this.arrows();
}


Carousel.prototype = Object.create(Container.prototype);
Carousel.prototype.constructor = Carousel;


// <Боковые кнопки "Стрелки">
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
// </Боковые кнопки "Стрелки">


// <Отрисовка карусели с товарами>
Carousel.prototype.render = function (root) {

    var _this = this;

    $('.carousel').css({'width': this.widthCarousel});

    this.effectsString();
    this.widthCarouselNav();
    this.widthProduct();
    this.widthString();

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
            helper: function () {
                var copy = $(this).clone();
                return copy;
            },
            appendTo: 'body',
            scroll: false,
            // Скрываем прежний товар при перетаскивании, с сохранением пространства
            start: function () {
                $(this).css({'opacity': 0});
            },
            stop: function () {
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
            text: this.productsItems[item].price + this.currency
        });
        itemsPricesDiv.appendTo(itemsDiv);

        var itemsBasketDivClass = 'carousel__products-items-basket',
            itemsBasketDivId = itemsBasketDivClass + '_' + item,
            itemsBasketDiv = $('<div />', {
            class: itemsBasketDivClass,
            id: itemsBasketDivId,
            text: 'В корзину'
        });
        itemsBasketDiv.appendTo(itemsDiv);

        // <В корзину>
        $('#' + itemsBasketDivId).on('click', function () {
            _this.addBasket(_this, this.id);
            _this.renderBasket('.basket__table');
        });
        // </В корзину>

    }
};
// </Отрисовка карусели с товарами>


// <Отрисовка кругляшков>
Carousel.prototype.renderDots = function (root) {
    var _this = this;

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
// </Отрисовка кругляшков>


// <Отрисовка таблицы товаров>
Carousel.prototype.renderBasket = function (root) {
    var _this = this;

    $(root).empty();

    if (this.productsBasket.length > 0) {

        $(root).css({'display': 'table'});
        $('.basket__button').css({'display': 'block'});

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

        var basketTableCellAmountClass = 'basket__table-cell basket__table-cell_amount',
            basketTableCellAmount = $('<span />', {
                class: basketTableCellAmountClass,
                text: 'Кол-во'
            });
        basketTableCellAmount.appendTo(basketTableRowHeader);

        var basketTableCellCountClass = 'basket__table-cell basket__table-cell_count',
            basketTableCellCount = $('<span />', {
                class: basketTableCellCountClass,
                text: 'Сумма'
            });
        basketTableCellCount.appendTo(basketTableRowHeader);

        var basketTableCellDelClass = 'basket__table-cell basket__table-cell_del',
            basketTableCellDel = $('<span />', {
                class: basketTableCellDelClass,
                text: 'Операция'
            });
        basketTableCellDel.appendTo(basketTableRowHeader);
        // </Шапка таблицы товаров>


        // <Содержимое таблицы товаров>
        for (var product in this.productsBasket) {

            var item = this.productsBasket[product].number;

            var basketTableRowProductsClass = 'basket__table-row basket__table-row_products',
                basketTableRowProducts = $('<div />', {
                    class: basketTableRowProductsClass
                });
            basketTableRowProducts.appendTo(root);

            basketTableCellNumbersClass = 'basket__table-cell basket__table-cell_numbers';
            basketTableCellNumbers = $('<span />', {
                class: basketTableCellNumbersClass
                // text: parseInt(product)+1
            });
            basketTableCellNumbers.appendTo(basketTableRowProducts);

            basketTableCellTitlesClass = 'basket__table-cell basket__table-cell_titles';
            basketTableCellTitles = $('<span />', {
                class: basketTableCellTitlesClass,
                text: this.productsItems[item].title
            });
            basketTableCellTitles.appendTo(basketTableRowProducts);

            basketTableCellPhotosClass = 'basket__table-cell basket__table-cell_photos';
            basketTableCellPhotos = $('<span />', {
                class: basketTableCellPhotosClass,
                style: 'background-image: url(' + this.productsItems[item].image + ')'
                // text: this.productsItems[item].image
            });
            basketTableCellPhotos.appendTo(basketTableRowProducts);

            basketTableCellDescriptionsClass = 'basket__table-cell basket__table-cell_descriptions';
            basketTableCellDescriptions = $('<span />', {
                class: basketTableCellDescriptionsClass,
                text: this.productsItems[item].description
            });
            basketTableCellDescriptions.appendTo(basketTableRowProducts);


            var price = this.productsItems[item].price;
            basketTableCellPricesClass = 'basket__table-cell basket__table-cell_prices';
            basketTableCellPrices = $('<span />', {
                class: basketTableCellPricesClass,
                text: price + this.currency
            });
            basketTableCellPrices.appendTo(basketTableRowProducts);

            basketTableCellAmountClass = 'basket__table-cell basket__table-cell_amount';
            basketTableCellAmount = $('<span />', {
                class: basketTableCellAmountClass,
                text: ''
            });
            basketTableCellAmount.appendTo(basketTableRowProducts);

            var value = this.productsBasket[product].count,
                basketTableCellAmountInputClass = 'basket__table-cell_amount-input',
                basketTableCellAmountInputId = 'basket__table-cell_amount-input' + '_' + item,
                basketTableCellAmountInput = $('<input />', {
                    id: basketTableCellAmountInputId,
                    class: basketTableCellAmountInputClass,
                    maxlength: 2,
                    type: 'number',
                    min: 1,
                    max: 10,
                    value: value
                });
            basketTableCellAmountInput.appendTo(basketTableCellAmount);


            // Отслеживание изменений количества товаров в корзине
            $('#' + basketTableCellAmountInputId).on('click keyup input', function () {
                // Проверка максильного количества введенных в поле символов
                if (this.value.length > this.maxLength) {
                     this.value = this.value.slice(0, this.maxLength)
                } else {
                     _this.amountBasket(this.id);
                }
            });


            var basketTableCellCountId = 'basket__table-cell_count' + '_' + item;
            basketTableCellCountClass = 'basket__table-cell basket__table-cell_count';
            basketTableCellCount = $('<span />', {
                id: basketTableCellCountId,
                class: basketTableCellCountClass,
                text: price * value + this.currency
            });
            basketTableCellCount.appendTo(basketTableRowProducts);


            basketTableCellDelClass = 'basket__table-cell basket__table-cell_del';
            basketTableCellDel = $('<span />', {
                class: basketTableCellDelClass
            });
            basketTableCellDel.appendTo(basketTableRowProducts);

            var basketTableCellDelButtonClass = 'basket__table-cell_del-button',
                basketTableCellDelButtonId = 'basket__table-cell_del-button' + '_' + item,
                basketTableCellDelButton = $('<span />', {
                    class: basketTableCellDelButtonClass,
                    id: basketTableCellDelButtonId,
                    text: 'Удалить'
                });
            basketTableCellDelButton.appendTo(basketTableCellDel);

            // Удаление товара
            $('#' + basketTableCellDelButtonId).on('click', function () {
                _this.delBasket(this.id);
            });

        }
        // </Содержимое таблицы товаров>


        // <Футер таблицы товаров>
        var basketTableRowSumClass = 'basket__table-row basket__table-row_sum',
            basketTableRowSum = $('<div />', {
                class: basketTableRowSumClass
            });
        basketTableRowSum.appendTo(root);

        for (var i = 1; i <= 7; i++) {
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
                text: this.totalBasket()
            });
        basketTableCellTotal.appendTo(basketTableRowSum);
        // </Футер таблицы товаров>
    } else {
        $(root).css({'display': 'none'});
        $('.basket__button').css({'display': 'none'});
    }
};
// </Отрисовка таблицы товаров>


// <Пересчет ИТОГО>
Carousel.prototype.totalBasket = function () {
    var total = 0;
    for (var item in this.productsBasket){
        var number =  this.productsBasket[item].number;
        total += this.productsItems[number].price * this.productsBasket[item].count;
    }
    return 'ИТОГО: ' + total + this.currency;
};
// </Пересчет ИТОГО>


// <Количество товаров в корзине>
Carousel.prototype.amountBasket = function (id) {
    if (typeof(id)=='string') {

        var value = $('#' + id).val(),
            itemId = id.split('_')[4],
            product = this.productsItems[itemId],
            newPrice = product.price * value + this.currency;

        for (var item in this.productsBasket){
            if (this.productsBasket[item].number == itemId) {
                this.productsBasket[item].count = value;
            }
        }

        $('#' + 'basket__table-cell_count' + '_' + itemId).text(newPrice);
        $('.basket__table-cell_total').text(this.totalBasket());
        // console.log(itemId, product, value, newPrice);
    }
};
// </Количество товаров в корзине>


// <Удаление товара из корзины>
Carousel.prototype.delBasket = function (id) {
    if (typeof(id)=='string') {
        var itemId = id.split('_')[4];
        for (var item in this.productsBasket){
            if (this.productsBasket[item].number == itemId) {
                this.productsBasket.splice(item, 1);
            }
        }
        $('#' + id).parent().parent().remove();
        this.renderBasket('.basket__table');
    }
};
// </Удаление товара из корзины>


// <Получаем изначальные элементы из файла JSON>
Carousel.prototype.loadCarouselItems = function () {
    $.get({
        url: './json/carousel.json',
        dataType: 'json',
        error: function () {
            console.log('JSON file settings load: Error!');
        },
        success: function (data) {
            console.log('JSON file settings load: Ок!');
            this.effects = data.effects;
            this.widthCarousel = data.widthCarousel;
            this.productsSlide = data.productsSlide;
            this.currency = data.currency;
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
// </Получаем изначальные элементы из файла JSON>


// <Обработка нажатия клавиш>
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
// </Обработка нажатия клавиш>


// <Добавление товара в корзину>
Carousel.prototype.addBasket = function (_this, dropItemId) {
    if (typeof(dropItemId)=='string') {
        var dropItem = $('#' + dropItemId).attr('id').split('_')[3];
        // <Проверка на дубликаты товаров>
        var duplicate = false;
        for (var item in _this.productsBasket){
            if (_this.productsBasket[item].number == dropItem) {
                duplicate = true;
                _this.productsBasket[item].count++;
            }
        }
        if (!duplicate) {
            _this.productsBasket.push({number: parseInt(dropItem), count: 1});
        }
        // </Проверка на дубликаты товаров>
    }
};
// </Добавление товара в корзину>


// <Ready - Запуск функции, после загрузки документа>
$(document).ready(function () {
    var carousel = new Carousel(),
        _this = carousel;

    // Кнопка - Влево
    $('.carousel__nav-arrows-links_left').on('click', function () {
        _this.arrows('left');
    });

    // Кнопка - Вправо
    $('.carousel__nav-arrows-links_right').on('click', function () {
        _this.arrows('right');
    });

    // Кнопка - Оформить заказ
    $('.basket__button').on('click', function () {
        $('.' + this.className).effect('bounce', { times: 3 }, 'slow');
    });

    // Droppable для корзины
    $('.basket').droppable({
        drop: function (event, ui) {
            $('.basket').css('border', 'solid 1px white');
            _this.addBasket(_this, ui.draggable[0].id);
            _this.renderBasket('.basket__table');
        },
        over: function (event, ui) {
            $('.basket').css('border', 'solid 1px #007DC7');
        },
        out: function (event, ui) {
            $('.basket').css('border', 'solid 1px white');
        }
    });

});
// </Ready - Запуск функции, после загрузки документа>