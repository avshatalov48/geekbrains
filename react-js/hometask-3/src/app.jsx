import React from 'react';
import ReactDOM from 'react-dom';

import Menu from './app/components/Menu';

const app = document.getElementById('app');

// наименования пунктов меню
let itemsMenu = [
    "О нас",
    "Услуги",
    "Блог",
    "Контакты",
];

let my_news = [
    {
        author: 'Саша Печкин',
        text: 'В четверг, четвертого числа...'
    },
    {
        author: 'Просто Вася',
        text: 'Считаю, что $ должен стоить 35 рублей!'
    },
    {
        author: 'Гость',
        text: 'Бесплатно. Скачать. Лучший сайт - http://localhost:3000'
    }
];


class News extends React.Component {
    render() {
        return (
            <div className="news">
                К сожалению, новостей нет.
            </div>
        );
    }
}


class Comments extends React.Component {
    render() {
        return (
            <div className="comments">
                Нет новостей - комментировать нечего
            </div>
        );
    }
}


class App extends React.Component {
    render() {

        // var data = this.props.data;
        // var newsTemplate = data.map(function(item, index) {
        //     return (
        //         <div key={index}>
        //             <p className="news__author">{item.author}:</p>
        //             <p className="news__text">{item.text}</p>
        //         </div>
        //     )
        // });

        return (
            <div className="app">

                <div className="container">
                    <div className="row">
                        <div className="col-xs-12">
                            <Menu items={itemsMenu} description="Компонент 'Меню' на reactJS"
                                  title="Один уровень вложенности">
                                <h1>Наше меню</h1>
                                <p>Передается через компонент Menu</p>
                            </Menu>
                        </div>
                    </div>
                </div>



                <div className="news">
                    {/*{newsTemplate}*/}
                </div>

                Всем привет, я компонент App! Я умею отображать новости.
                <News data={my_news}/> {/*добавили свойство data */}
                <Comments />
            </div>
        );
    }
}


ReactDOM.render(
    <App />,
    app
);