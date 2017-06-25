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

// Обработка текста формы
Form.prototype.correction = function () {
    var value = this.value;

    // 1 задание - Меняем все двойные кавычки на одинарные
    // value = value.replace(/'/g,'"');

    // Замена символа " в начале строки
    value = value.replace(/^'/gm,'\"');
    // Замена символа " перед и после пробела
    value = value.replace(/\b'\s/gm,'\" ');
    value = value.replace(/\s'\b/gm,' \"');
    // Замена символа " перед точкой и запятой
    value = value.replace(/\b'\./gm,'\".');
    value = value.replace(/\b'\,/gm,'\",');
    return value;
};

// Загрузка текста из файла JSON через AJAX
window.onload = function () {
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

// Отслеживание Submit формы
document.getElementById('form').onsubmit = function (e) {
    e.preventDefault();
    var textArea = document.getElementById('form__text'),
        formNew = new Form('formId', 'formClass', textArea.value);
    textArea.value = formNew.correction();
};