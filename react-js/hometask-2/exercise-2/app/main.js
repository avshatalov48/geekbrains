let data = require('./data');
let developer = require('./module');

developer(data.surname, data.name, data.patronymic);

exports.developer = developer;