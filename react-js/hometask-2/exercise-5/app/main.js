// Данные
let data = require('./data');
// Преобразование регистра
let uCase = require('./ucase');
// Получение и вывод даты
let date = require('./date');
// Вывод в DOM
let developer = require('./module');

developer(uCase(data.surname), uCase(data.name), uCase(data.patronymic), date);

exports.developer = developer;