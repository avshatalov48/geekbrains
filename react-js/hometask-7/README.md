# GeekBrains. ReactJS. Профессиональная frontend-разработка.
Преподаватель: Игорь Филимонов.

## Урок 7. Концепция Flux на примере использования Redux.
Что такое Flux; FluxDispatcher; EventEmitter; Store; что такое Redux и для чего он нам нужен; Reducers; Redux EventEmitter и Store.

### Домашнее задание

1. Настроить приложение в соответствии с п.1 - п.6 руководства по использованию redux.

2. Реализовать страницу ленты блогов с применением redux (http://jsonplaceholder.typicode.com/posts).

3. Для пользователей нашего блога, требуется загружать их данные из интернета по ссылке (jsonplaceholder.typicode.com/users).

4. (*) При клике на пользователя должен отображаться список его постов (http://jsonplaceholder.typicode.com/posts?userId=1 у которых userId равен id пользователя). Попробуйте реализовать это в виде split view (то есть слева пользователи справа их посты).

5. (*) При клике на каждый пост должны показываться комментарии к посту (http://jsonplaceholder.typicode.com/posts/1/comments)

Если не хотите или не получается сделать вариант с загрузкой из интернета, сделайте json-файлы, которые будут загружаться в state нашего приложения вместо загрузки (либо сразу, то есть в начальном состоянии, либо при помощи считывания при обработке action в редьюсере).

#### Для работы Вам потребуются следующие npm пакеты:

- redux - https://www.npmjs.com/package/redux (непосредственно redux с его функциями createStore, combineReduxers и applyMiddleware)

- react-redux - https://www.npmjs.com/package/react-redux( добавляем элемент Provider в наше приложение, а также функцию connect)

- redux-thunk - https://www.npmjs.com/package/redux-thunk (middleware для возможности диспетчирезации функций)

- redux-logger - https://www.npmjs.com/package/redux-logger (middleware для логирования состояний)

- redux-promise-middleware - https://www.npmjs.com/package/redux-promise-middleware (middleware для
создания асинхронных диспетчеризируемых функций)

#### идет в секцию пакетов devDependencies

- babel-transform-decorators-legacy - https://www.npmjs.com/package/babel-plugin-transform-decorators-legacy (для возможности
обрабатывать декораторы при сборке babel)