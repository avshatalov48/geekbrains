function Container() {
    this.id = '';
    this.className = '';
    this.htmlCode = '';
    this.value = '';
}

Container.prototype.render = function () {
    return this.htmlCode;
};

function Form(myId, myClass, myValue) {
    Container.call(this);
    this.id = myId;
    this.className = myClass;
    this.value = myValue;
}

Form.prototype = Object.create(Container.prototype);
Form.prototype.constructor = Form;

Form.prototype.render = function () {
    return this.value;
};

// Обработка текста формы регулярным выражением
Form.prototype.correction = function () {
    var reg, value = this.value;

    // 1 задание - Меняем все двойные кавычки на одинарные
    // value = value.replace(/'/g,'"');

    // Замена символа " после пробела и ";"
    value = value.replace(/[\s|;]'\b/gm,' \"');
    // Замена символа " - перед пробелом и ";" | в начале строки | в конце строки | перед точкой и запятой |
    value = value.replace(/\b'(?=[\s|;])|^'|'$|\b'(?=[\.|\,])/gm,'\"');

    return value;
};

// Загрузка текста из файла JSON через AJAX
document.getElementById('form__button-load').onclick = function () {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './js-2_3-1+2.json', true);
    xhr.send();

    xhr.onreadystatechange = function () {
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
            console.log('Error', xhr.status, xhr.statusText);
        } else {
            var fileJson = JSON.parse(xhr.responseText),
                formNew = new Form('formId', 'formClass', fileJson.text);
            document.getElementById('form__text').value = formNew.render();
        }
    }
};

// Отслеживание события "submit" формы
document.getElementById('form').onsubmit = function (e) {
    e.preventDefault();
    var textArea = document.getElementById('form__text'),
        formNew = new Form('formId', 'formClass', textArea.value);
    textArea.value = formNew.correction();
};