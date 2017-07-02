// Конструктор для Review
function Review() {
    Container.call(this, 'review');

    // количество товара
    this.countGoods = 0;

    // цена
    this.amount = 0;

    // массив для хранения товаров
    this.reviewItems = [];

    this.collectReviewItems();
}

// Полноценное наследование
Review.prototype = Object.create(Container.prototype);
Review.prototype.constructor = Review;

// Отрисовка корзины
Review.prototype.render = function(root) {
    // Обратить внимание на синтаксис создания нового объекта
    var reviewDiv = $('<div />', {
        id: this.id,
        text: 'Корзина'
    });

    var reviewItemsDiv = $('<div />', {
        id: this.id + '_items'
    });

    // appendTo - вставить в...
    reviewItemsDiv.appendTo(reviewDiv);
    reviewDiv.appendTo(root);
};

// Получаем изначальные элементы из JSON
Review.prototype.collectReviewItems = function() {
    var appendId = '#' + this.id + '_items';
    // var self = this;
    $.get({
        // Файл-заглушка
        url: 'js-2_5-2_review.json',
        // Вызов при успешном запросе
        success: function(data) {
            var reviewData = $('<div />', {
                id: 'review_data'
            });

            // Меняем количество товара
            this.countGoods = data.review.length;
            this.amount = data.amount;

            reviewData.append('<p>Всего товаров: ' + this.countGoods + '</p>');
            reviewData.append('<p>Сумма: ' + this.amount + '</p>');

            reviewData.appendTo(appendId);

            // Перебираем корзину и добавляем в массив
            for (var item in data.review) {
                this.reviewItems.push(data.review[item]);
            }
        },
        // привязка контекста, чтобы указывал на наш объект, а не на window, 2-й способ, более профессиональный, чем self
        context: this,
        dataType: 'json'
    });
};

// Метод добавления нового элемента
Review.prototype.add = function (idProduct, quantity, price) {
    var reviewItem = {
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
    this.reviewItems.push(reviewItem);
    // Обновляем данные
    this.refresh();
};

// Удаление товара
Review.prototype.del = function (idProduct, quantity, price) {
    // Если в корзине ничего нет, нечего и удалять. Выходим из функции.
    if (this.countGoods == 0) return;

    var reviewItem = {
        "id_product": idProduct,
        "price": price
    };

    // Уменьшаем количество товаров
    for (var i = 1; i <= quantity; i++) {
        this.countGoods--;
    }

    // Уменьшаем стоимость
    this.amount -= price * quantity;
    // Удаляем товар из массива
    this.reviewItems.pop(reviewItem);
    // Обновляем данные
    this.refresh();
};


// Перерисовка
Review.prototype.refresh = function() {
    var reviewDataDiv = $('#review_data');
    // Очищаем содержимое, но элемент сам не удаляем в отличии от remove
    reviewDataDiv.empty();
    // Вставляем код в HTML
    // Количество
    reviewDataDiv.append('<p>Всего товаров: ' + this.countGoods + ' </p>');
    // Сумма
    reviewDataDiv.append('<p>Сумма: ' + this.amount + ' </p>');
};
