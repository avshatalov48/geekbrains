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
Form.prototype.validate = function () {
    document.getElementById('form__input-name').value = '1';
    document.getElementById('form__input-phone').value = '1';
    document.getElementById('form__input-email').value = '1';
    document.getElementById('form__text').value = '1';

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
    var formNew = new Form();
    console.log(formNew);
    // formNew.validate();
};