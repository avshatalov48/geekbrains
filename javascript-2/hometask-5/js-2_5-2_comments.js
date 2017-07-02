// Конструктор для Comments
function Comments() {
    Container.call(this, 'comments');

    // количество отзывов
    this.countComments = 0;

    // массив для хранения отзывов
    this.commentsItems = [];

    // Получаем изначальные элементы из JSON
    this.collectCommentsItems();
}

Comments.prototype = Object.create(Container.prototype);
Comments.prototype.constructor = Comments;

Comments.prototype.render = function(root) {
    var commentsDiv = $('<div />', {
        id: this.id,
        text: 'ОТЗЫВЫ:'
    });

    var commentsItemsDiv = $('<div />', {
        id: this.id + '_items'
    });

    commentsItemsDiv.appendTo(commentsDiv);
    commentsDiv.appendTo(root);
};

// Получаем изначальные элементы из JSON
Comments.prototype.collectCommentsItems = function() {
    var appendId = '#' + this.id + '_items';

    $.get({
        // Файл-заглушка
        url: 'js-2_5-2_comments.json',
        // Вызов при успешном запросе
        success: function(data) {
            var commentsData = $('<div />', {
                id: 'comments_data'
            });

            // Меняем количество отзывов
            this.countComments = data.comments.length;
            // this.amount = data.amount;

            commentsData.append('<p>Всего отзывов: ' + this.countComments + '</p>');
            // commentsData.append('<p>Сумма: ' + this.amount + '</p>');

            commentsData.appendTo(appendId);

            // Перебираем корзину и добавляем в массив
            for (var item in data.comments) {
                this.commentsItems.push(data.comments[item]);
            }
        },
        // привязка контекста, чтобы указывал на наш объект, а не на window, 2-й способ, более профессиональный, чем self
        context: this,
        dataType: 'json'
    });
};

// Добавление отзыва
Comments.prototype.add = function (idComment, text) {
    var commentsItem = {
        "id_comment": idComment,
        "text": text,
        "submit": 0
    };
    // Увеличиваем количество отзывов
    this.countComments++;
    // Добавляем отзыв в массив
    this.commentsItems.push(commentsItem);
    // Обновляем данные
    this.refresh();
};

// Удаление отзыва
Comments.prototype.del = function (idComment, text) {
    if (this.countComments < 1) { this.refresh(); return; }
    this.countComments--;
    this.commentsItems.pop();
    this.refresh();
};

// Одобрение отзыва
Comments.prototype.submit = function (idComment, text) {
    var commentsItem = {
        "id_comment": idComment,
        "text": text,
        "submit": 1
    };
    this.commentsItems[this.countComments-1] = commentsItem;
    this.refresh();
};

// Показать список
Comments.prototype.list = function () {
    console.log('Список');
};

// Перерисовка
Comments.prototype.refresh = function() {
    var commentsDataDiv = $('#comments_data');
    // Очищаем содержимое, но элемент сам не удаляем в отличии от remove
    commentsDataDiv.empty();
    commentsDataDiv.append('<p>Всего отзывов: ' + this.countComments + '</p>');

    console.log(this.commentsItems, this.countComments);

    if (this.countComments < 1) {
        $('.comments').hide();
    } else {
        $('.comments').show();
    }
};