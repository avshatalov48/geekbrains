let data = require('./data');
// Добавлен модуль, который преобразует регистр к UpperCase
let uCase = require('./ucase');
let developer = require('./module');

developer(uCase(data.surname), uCase(data.name), uCase(data.patronymic));

exports.developer = developer;