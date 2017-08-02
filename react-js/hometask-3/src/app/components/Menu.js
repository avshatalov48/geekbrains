import React from 'react';

export default class Menu extends React.Component
{
    render(){
        // вывод props в консоль
        console.log(this.props);

        // проброска пунктов меню в массиве через props
        // каждый элемент должен обладать уникальным ключем - key - он не отображается в HTML
        let items = this.props.items.map((item, index) => {
            return <li key={index}>{item}</li>;
        });

        return (
            <div>
                {this.props.children}
                <p>{this.props.description}</p>
                <ul>
                    {items}
                </ul>
                {this.props.title}
            </div>
        );
    }
}

//export default Menu; //Способ 1