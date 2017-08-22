module.exports = function (surname, name, patronymic, date) {
   let root = document.getElementById('root'),
   	paragraph = document.createElement('p');
   	paragraph.innerHTML = '<b>Фамилия</b>: ' + surname + '<br><b>Имя</b>: ' + name + '<br><b>Отчество</b>: ' + patronymic;
	root.appendChild(paragraph);
    root.addEventListener('click', date, false);
};