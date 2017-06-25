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

Form.prototype.fill = function () {
    document.getElementById('form__input-name').value = this.name;
    document.getElementById('form__input-phone').value = this.phone;
    document.getElementById('form__input-email').value = this.email;
    document.getElementById('form__text').value = this.text;
};

// Обработка текста формы регулярным выражением
Form.prototype.validate = function (myId, myType) {

    var field = document.getElementById(myId),
        message = document.getElementById('form__message'),
        reg = /./g;

    switch (myType) {
        case "name":
            reg = /[a-zA-Za-яА-Я]/g;
            break;
        case "phone":
            // +7(000)000-0000
            break;
        case "email":
            // mymail@mail.ru, или my.mail@mail.ru, или my-mail@mail.ru
            break;
    }

    console.log(field.value, reg, reg.test(field.value));

    if (reg.test(field.value) == false) {
        field.style.borderColor = 'red';
        message.display = 'block';
        message.innerHTML = 'Проверьте правильность заполнения полей!';
    } else {
        message.display = 'none';
    }


    // document.getElementById(myId).value = myType;



    // this.name = myName;
    // this.phone = document.getElementById('form__input-phone').value;
    // this.email = document.getElementById('form__input-email').value;
    // this.text = document.getElementById('form__text').value;

    // var reg, value = this.value;
    //
    // // 1 задание - Меняем все двойные кавычки на одинарные
    // // value = value.replace(/'/g,'"');
    //
    // // Замена символа " после пробела и ";"
    // value = value.replace(/[\s|;]'\b/gm,' \"');
    // // Замена символа " - перед пробелом и ";" | в начале строки | в конце строки | перед точкой и запятой |
    // value = value.replace(/\b'(?=[\s|;])|^'|'$|\b'(?=[\.|\,])/gm,'\"');
    //
    // return value;
};

// Загрузка текста из файла JSON через AJAX
document.getElementById('form__button-load').onclick = function () {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './js-2_3-3.json', true);
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
    formNew.validate('form__input-name', 'name');
    formNew.validate('form__input-phone', 'phone');
    formNew.validate('form__input-email', 'email');
    // console.log(formNew);
};