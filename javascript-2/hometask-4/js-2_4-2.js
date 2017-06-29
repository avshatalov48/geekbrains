function Container() {
    this.id = '';
    this.className = '';
    this.htmlCode = '';
    this.name = '';
    this.phone = '';
    this.email = '';
    this.text = '';
}

Container.prototype.render = function () {
    return this.htmlCode;
};

function Form(myId, myClass, myName, myPhone, myEmail, myText) {
    Container.call(this);
    this.id = myId;
    this.className = myClass;
    this.name = myName;
    this.phone = myPhone;
    this.email = myEmail;
    this.text = myText;
}

Form.prototype = Object.create(Container.prototype);
Form.prototype.constructor = Form;

// Вставка значений в поля формы
Form.prototype.fill = function () {
    document.getElementById('form__input-name').value = this.name;
    document.getElementById('form__input-phone').value = this.phone;
    document.getElementById('form__input-email').value = this.email;
    document.getElementById('form__text').value = this.text;
};

// Проверка полей формы на соответствие
Form.prototype.validate = function (myIds, myTypes) {
    for (var i in myTypes) {
        var myType = myTypes[i],
            myId = 'form__input-' + myType,
            field = document.getElementById(myId),
            message = document.getElementById('form__message-' + myType),
            reg = /./;

        switch (myType) {
            case "name":
                // Имя
                reg = /^[A-zА-я]+$/;
                break;
            case "phone":
                // +7(000)000-0000
                reg = /^\+[7|8]{1}\([0-9]{3}\)[0-9]{3}-[0-9]{4}$/;
                break;
            case "email":
                // mymail@mail.ru, или my.mail@mail.ru, или my-mail@mail.ru
                reg = /^([A-zА-я0-9_-]+\.)*[A-zА-я0-9_-]+@[A-zА-я0-9_-]+(\.[A-zА-я0-9_-]+)*\.[A-zА-я]{2,6}$/;
                break;
        }

        if (field.value.search(reg) == -1) {
            field.style.borderColor = '#c750ac';
            message.innerHTML = 'Проверьте правильность заполнения поля!';
        } else {
            field.style.borderColor = '#85c799';
            message.innerHTML = '';
        }

    }
};

// Загрузка информации в поля формы из файла JSON через AJAX
document.getElementById('form__button-load').onclick = function () {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './js-2_4-2_data.json', true);
    xhr.send();

    xhr.onreadystatechange = function () {
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
            console.log('Error', xhr.status, xhr.statusText);
        } else {
            var fileJson = JSON.parse(xhr.responseText),
                formNew = new Form('formId', 'formClass', fileJson.name, fileJson.phone, fileJson.email, fileJson.text);
            formNew.fill();
        }
    }
};

// Отслеживание события "submit" формы
document.getElementById('form').onsubmit = function (e) {
    e.preventDefault();
    var formNew = new Form('formId', 'formClass', document.getElementById('form__input-name').value,
        document.getElementById('form__input-phone').value,
        document.getElementById('form__input-email').value,
        document.getElementById('form__text').value);
    formNew.validate('form__input', ['name', 'phone', 'email']);
};