import React from 'react';

export default class Articles extends React.Component
{
    render(){
        let items = this.props.items.map((item, index) => {
            return (
                <div className="col-xs-4" key={index}>
                    <div class="thumbnail">
                    <img src={item.image} alt={item.title}></img>
                      <div class="caption">
                        <h3>{item.title}</h3>
                        <p class="text-justify">{item.text}</p>
                        <p class="text-right"><i>Автор: {item.author}</i></p>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default">Коммент.</button>
                                <button type="button" class="btn btn-default">Редак.</button>
                                <button type="button" class="btn btn-default">Удалить</button>
                            </div>
                      </div>
                    </div>
                </div>
                );
        });


        return (
            <div>
                {this.props.children}
                <div>
                    {items}
                </div>
            </div>
        );
    }
}