function Container(id) {
    this.id = id;
    this.className = '';
    this.htmlCode = '';
}

Container.prototype.render = function () {
    return this.htmlCode;
};

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

            // Количество отзывов
            this.countComments = data.comments.length;

            commentsData.append('<p>Всего отзывов: ' + this.countComments + '</p>');
            commentsData.appendTo(appendId);

            // Перебираем JSON и добавляем в массив
            for (var item in data.comments) {
                this.commentsItems.push(data.comments[item]);
            }
        },
        context: this,
        dataType: 'json'
    });
};

// Добавление отзыва
Comments.prototype.add = function (idComment, text, userMessage) {
    var commentsItem = {
        "id_comment": idComment,
        "text": text,
        "submit": false
    };
    // Увеличиваем количество отзывов
    this.countComments++;
    // Добавляем отзыв в массив
    this.commentsItems.push(commentsItem);
    // Обновляем данные
    this.refresh();
    if (!!userMessage) alert (userMessage);
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
        "submit": true
    };
    this.commentsItems[this.countComments-1] = commentsItem;
    this.refresh();
};

// Показать все отзывы
Comments.prototype.list = function () {
    $('#comments__list').remove();

    var commentsDiv = $('<div />', {
        id: 'comments__list',
        html: '<br><hr><br>СПИСОК ВСЕХ ОТЗЫВОВ:<br> '
    });

    for (var item in this.commentsItems) {
       var comment = this.commentsItems[item],
       commentsItemsDiv = $('<div />', {
            html: '<p>Отзыв №' + comment.id_comment + '</p>'
            + '<p>Текст: <span class="comments-text-list">' + comment.text + '</span></p>'
            + '<p>Отзыв одобрен: ' + comment.submit + '</p><br>'
        });
        commentsItemsDiv.appendTo(commentsDiv);
    }

    commentsDiv.appendTo('body');
};

// Перерисовка
Comments.prototype.refresh = function() {
    var commentsDataDiv = $('#comments_data');
    commentsDataDiv.empty();
    commentsDataDiv.append('<p>Всего отзывов: ' + this.countComments + '</p>');

    // Вывод в консоль для самопроверки
    console.log(this.commentsItems, this.countComments);

    if (this.countComments < 1) {
        $('.comments').hide();
    } else {
        $('.comments').show();
    }
};

// Загрузка документа
$(document).ready(function() {
    var comments = new Comments();
    comments.render('#comments__wrapper');

    // Кнопка - Добавить
    $('.comments-add').on('click', function() {
        var idComment = parseInt($(this).attr('id').split('_')[1]);
        var text = $(this).parent().parent().find('.comments-text').text();
        comments.add(idComment, text, 'Ваш отзыв был передан на модерацию');
    });

    // Кнопка - Удалить
    $('.comments-delete').on('click', function() {
        var idComment = parseInt($(this).attr('id').split('_')[1]);
        var text = $(this).parent().parent().find('.comments-text').text();
        comments.del(idComment, text);
    });

    // Кнопка - Одобрить
    $('.comments-submit').on('click', function() {
        var idComment = parseInt($(this).attr('id').split('_')[1]);
        var text = $(this).parent().parent().find('.comments-text').text();
        comments.submit(idComment, text);
    });

    // Кнопка - Показать все отзывы
    $('.comments-list').on('click', function() {
        comments.list();
    });
});