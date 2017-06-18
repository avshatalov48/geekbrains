// Переменные классов по БЭМ
var itemClassName = 'menu__list-items',
    itemAnchorsClassName = 'menu__list-items-anchors';    

// Базовый класс, от которого всё наследуется
function Container() {
    this.id = '';
    this.className = '';
    this.htmlCode = '';
}

// Метод, который будет выводить HTML код
Container.prototype.render = function () {
    return this.htmlCode;
};

// Класс - Меню
function Menu(menuId, menuClass, menuItems) {
    // Наследование от Container
    Container.call(this);
    this.id = menuId;
    this.className = menuClass;
    this.items = menuItems;
}

// Полноценное наследование от Container
Menu.prototype = Object.create(Container.prototype);
// Обратно возвращаем стёртый конструктор
Menu.prototype.constructor = Menu;

// Генерация кода всего меню
Menu.prototype.render = function () {
    var res = '<ul id="' + this.id + '" class="' + this.className + '">';
    // Перебираем items
    for (var item in this.items) {
        // Проверяем пункт ли этого меню или нет, instanceof - принадлежит ли классу
        if (this.items[item] instanceof MenuItem) {
            res += this.items[item].render();
        }
    }
    res += '</ul>';
    return res;
};

// Вставка HTML кода меню в элемент с конкретным id
Menu.prototype.insert = function (id) {
    document.getElementById(id).innerHTML = menu.render();
};

// Удаление пункта меню
Menu.prototype.removeItem = function (item) {
    document.getElementById(item.id).parentNode.removeChild(item);
};

// Класс - Пункты меню
function MenuItem(itemId, itemHref, itemName) {
    // Наследование от контейнера
    Container.call(this);
    this.id = itemId;
    this.className = itemClassName;
    this.href = itemHref;
    this.hrefClassName = itemAnchorsClassName;
    this.name = itemName;
}

// Полноценное наследование от Container
MenuItem.prototype = Object.create(Container.prototype);
// Обратно возвращаем стёртый конструктор
MenuItem.prototype.constructor = MenuItem;

// Отрисовка пункта меню
MenuItem.prototype.render = function () {
    var menuItemHtml = '<li id="' + this.id
        + '" class="' + this.className
        + '"><a href="' + this.href
        + '" class="' + this.hrefClassName
        + '">' + this.name + '</a></li>';
    return menuItemHtml;
};

// Наполнение меню
var menu = new Menu('menu__list-id', 'menu__list', [
    new MenuItem('google', '#', 'Google'),
    new MenuItem('yandex', '#', 'Yandex'),
    new MenuItem('mailru', '#', 'Mail.ru'),
    new MenuItem('rambler', '#', 'Rambler'),
    new MenuItem('yahooo', '#', 'Yahoo'),
    new MenuItem('facebook', '#', 'FaceBook'),
    new MenuItem('twitter', '#', 'Twitter'),
])

// Вставка меню после загрузки <body>
var body = document.querySelector('body');
body.onload = menu.insert('menu');

// Обработка по клику
body.onclick = function (e) {
    var event = e.target;

    // клик по ссылке меню (имитация)
    if (event.className == itemAnchorsClassName) {
        event.parentNode.click();
    }
    // клик по пункту меню
    if (event.className == itemClassName) {
        menu.removeItem(event);
    }
};