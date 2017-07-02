// Конструктор для Basket
function Basket() {
    Container.call(this, 'basket');

    // количество товара
    this.countGoods = 0;

    // цена
    this.amount = 0;

    // массив для хранения товаров
    this.basketItems = [];

    this.collectBasketItems();
}

// Полноценное наследование
Basket.prototype = Object.create(Container.prototype);
Basket.prototype.constructor = Basket;

// Отрисовка корзины
Basket.prototype.render = function(root) {
    // Обратить внимание на синтаксис создания нового объекта
    var basketDiv = $('<div />', {
        id: this.id,
        text: 'Корзина'
    });

    var basketItemsDiv = $('<div />', {
        id: this.id + '_items'
    });

    // appendTo - вставить в...
    basketItemsDiv.appendTo(basketDiv);
    basketDiv.appendTo(root);
};

// Получаем изначальные элементы из JSON
Basket.prototype.collectBasketItems = function() {
    var appendId = '#' + this.id + '_items';
    // var self = this;
    $.get({
        // Файл-заглушка
        url: 'js-2_5-1_basket.json',
        // Вызов при успешном запросе
        success: function(data) {
            var basketData = $('<div />', {
                id: 'basket_data'
            });

            // Меняем количество товара
            this.countGoods = data.basket.length;
            this.amount = data.amount;

            basketData.append('<p>Всего товаров: ' + this.countGoods + '</p>');
            basketData.append('<p>Сумма: ' + this.amount + '</p>');

            basketData.appendTo(appendId);

            // Перебираем корзину и добавляем в массив
            for (var item in data.basket) {
                this.basketItems.push(data.basket[item]);
            }
        },
        // привязка контекста, чтобы указывал на наш объект, а не на window, 2-й способ, более профессиональный, чем self
        context: this,
        dataType: 'json'
    });
};

// Метод добавления нового элемента
Basket.prototype.add = function (idProduct, quantity, price) {
    var basketItem = {
        "id_product": idProduct,
        "price": price
    };

    // TODO: Передача нового товара на сервер

    // Увеличиваем количество товаров
    for (var i = 1; i <= quantity; i++) {
        this.countGoods++;
    }

    // Увеличиваем стоимость
    this.amount += price * quantity;
    // Добавляем товар
    this.basketItems.push(basketItem);
    // Обновляем данные
    this.refresh();
};

// Удаление товара
Basket.prototype.del = function (idProduct, quantity, price) {
    // Если в корзине ничего нет, нечего и удалять. Выходим из функции.
    if (this.countGoods < 1) return;

    // Уменьшаем количество товаров
    for (var i = 1; i <= quantity; i++) {
        this.countGoods--;
    }

    // Уменьшаем стоимость
    this.amount -= price * quantity;
    // Удаляем товар из массива
    this.basketItems.pop();
    // Обновляем данные
    this.refresh();
};


// Перерисовка
Basket.prototype.refresh = function() {
    var basketDataDiv = $('#basket_data');
    // Очищаем содержимое, но элемент сам не удаляем в отличии от remove
    basketDataDiv.empty();
    // Вставляем код в HTML
    // Количество
    basketDataDiv.append('<p>Всего товаров: ' + this.countGoods + ' </p>');
    // Сумма
    basketDataDiv.append('<p>Сумма: ' + this.amount + ' </p>');
};