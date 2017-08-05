import React from 'react';

export default class Menu extends React.Component {
    render() {
        let items = this.props.items.map((item, index) => {
            return (
                <li role="presentation" key={index} className={item.class}>
                    <a href={item.link}>{item.title}</a>
                </li>
            );
        });

        return (
            <div>
                {this.props.children}
                <div className="page-header">
                    <h1>
                        {this.props.title}
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