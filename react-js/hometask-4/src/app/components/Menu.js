import React from 'react';

export default class Menu extends React.Component {

    constructor(){
        super(...arguments);
        this.state = {
            // Содержимое пунктов меню
            menu: [],
            // Параметры пункта меню - Блог
            title: 'Блог',
            focused: 2
        };
    }

    // componentWillMount() - Вызывается один раз на клиенте и сервере, непосредственно перед началом рендеринга. Если вызвать setState внутри этого метода, render() будет видеть обновлённое состояние и будет выполнять его только один раз, несмотря на изменение состояния.

    componentWillMount(){
        let _this = this;
        let xhr = new XMLHttpRequest();
        xhr.open( 'GET', './json/menu.json', true);
        xhr.send();

        xhr.onreadystatechange = function() {
            if (xhr.readyState != 4) return;

            if (xhr.status != 200) {
                console.log('JSON: Error', xhr.status, xhr.statusText);
            } else {
                let getMenu = JSON.parse(xhr.responseText);
                _this.setState({
                    menu: getMenu.itemsMenu
                });
                console.log('JSON: Good', xhr.status, xhr.statusText);
            }
        };

    }

    clickMenu(index, title) {
        this.setState({
            focused: index,
            title: title
        });
    }

    render() {
        let items = this.state.menu.map((item, index) => {
            let style = '';
            if (this.state.focused == index) {
                style='active';
            }
            return (
                <li role="presentation" key={index} className={style} onClick={this.clickMenu.bind(this,index,item.title)}>
                    <a href={item.link}>{item.title}</a>
                </li>
            );
        });

        return (
            <div className="col-xs-12">
                <div className="page-header">
                    <h1>
                        {this.state.title}
                    </h1>
                </div>
                <ul className="nav nav-pills">
                    {items}
                </ul>
                <hr />
            </div>
        );
    }
}