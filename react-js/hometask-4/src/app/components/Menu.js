import React from 'react';

export default class Menu extends React.Component {

    constructor(){
        super(...arguments);
        this.state = {
            // Параметры пункта меню - Блог
            title: 'Блог',
            focused: 2
        };
    }

    clickMenu(index, title) {
        this.setState({
            focused: index,
            title: title
        });
    }

    render() {

        let items = this.props.items.map((item, index) => {
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