// Глобальные переменные
var
    nameElement = document.getElementById('form__name'),
    birthdayElement = document.getElementById('form__birthday'),
    phoneElement = document.getElementById('form__phone'),
    emailElement = document.getElementById('form__email'),
    textElement = document.getElementById('form__text'),
    townElement = document.getElementById('form__town'),
    check = false; // Переменная проверки правильности заполнения формы

function Container() {
    this.id = '';
    this.className = '';
    this.htmlCode = '';
}

Container.prototype.render = function() {
    return this.htmlCode;
};

function Form(myId, myClass, myName, myBirthday, myPhone, myEmail, myText, myTown) {
    Container.call(this);
    this.id = myId;
    this.className = myClass;
    this.name = myName;
    this.birthday = myBirthday;
    this.phone = myPhone;
    this.email = myEmail;
    this.text = myText;
    this.town = myTown;
}

Form.prototype = Object.create(Container.prototype);
Form.prototype.constructor = Form;

// Вставка значений в поля формы
Form.prototype.fill = function() {
    nameElement.value = this.name;
    birthdayElement.value = this.birthday;
    phoneElement.value = this.phone;
    emailElement.value = this.email;
    textElement.value = this.text;
    townElement.value = this.town;
};

// Проверка полей формы на соответствие
Form.prototype.validate = function(myIds, myTypes) {
    for (var i in myTypes) {
        var myType = myTypes[i],
            myId = 'form__' + myType,
            field = document.getElementById(myId),
            message = document.getElementById('form__message-' + myType),
            reg = /./;

        switch (myType) {
            case "name":
                // Имя, минимум 2 буквы
                reg = /^([A-zА-я]+){2}$/;
                break;
            case "birthday":
                // Дата ДД.ММ.ГГГГ
                reg = /^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/;
                break;
            case "phone":
                // +7|8(000)000-0000
                reg = /^\+[7|8]{1}\([0-9]{3}\)[0-9]{3}-[0-9]{4}$/;
                break;
            case "email":
                // mymail@mail.ru, или my.mail@mail.ru, или my-mail@mail.ru
                reg = /^([A-zА-я0-9_-]+\.)*[A-zА-я0-9_-]+@[A-zА-я0-9_-]+(\.[A-zА-я0-9_-]+)*\.[A-zА-я]{2,6}$/;
                break;
            case "town":
                // Город
                reg = /^([A-zА-я-\s]+){2}$/;
                break;
            case "text":
                // Текст, минимум 10 символов
                reg = /.{10}/;
                break;
        }

        if (field.value.search(reg) == -1) {
            check = false;
            field.style.borderColor = '#c750ac';
            $('#'+field.id).effect("bounce", { times: 3 }, "slow");
            message.innerHTML = 'Проверьте правильность заполнения поля!';
            $('#'+message.id).effect("bounce", { times: 3 }, "slow");
        } else {
            field.style.borderColor = '#85c799';
            message.innerHTML = '';
        }

    }
};

// Загрузка информации в поля формы из файла JSON через AJAX
document.getElementById('form__button-load').onclick = function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './json/data.json', true);
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
            console.log('Error', xhr.status, xhr.statusText);
        } else {
            var fileJson = JSON.parse(xhr.responseText),
                formNew = new Form('formId', 'formClass',
                fileJson.name,
                fileJson.birthday,
                fileJson.phone,
                fileJson.email,
                fileJson.text,
                fileJson.town);
            formNew.fill();
        }
    }
};

// Отслеживание события "submit" формы
document.getElementById('form').onsubmit = function(e) {
    check = true;
    var formNew = new Form('formId', 'formClass',
        nameElement.value,
        birthdayElement.value,
        phoneElement.value,
        emailElement.value,
        textElement.value,
        townElement.value);
    formNew.validate('form__input', ['name', 'birthday', 'phone', 'email', 'text', 'town']);
    (!check) ? e.preventDefault() : alert('Форма успешно отправлена!');
};

// Загрузка списка городов из файла JSON в массив для автозаполнения через jQuery UI
window.onload = function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './json/towns.json', true);
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
            console.log('Console: Error', xhr.status, xhr.statusText);
        } else {
            var myItems = JSON.parse(xhr.responseText);
            $('#form__town').autocomplete({
                source: myItems.town,
                // Определяет минимальное число символов, ввод которых будет инициировать отображение раскрывающегося списка элементов автозаполнения. Значение по умолчанию — 1
                minLength: 3
            })

        }
    }

    // Дата рождения
    $.datepicker.setDefaults($.datepicker.regional["ru"]);
    $('#form__birthday').datepicker({
        dateFormat: 'dd.mm.yy',
        dayNamesMin: ['ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'],
        monthNames: [ 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' ],
        yearRange: '1900:2017',
        changeYear: true,
        firstDay: 1
    });

    // Маски для полей
    // https://github.com/digitalBush/jquery.maskedinput
    $("#form__birthday").mask('99.99.9999', {placeholder: 'дд.мм.гггг' });
    $("#form__phone").mask('+7(999)999-9999', {placeholder: '+7(000)000-0000' });

};