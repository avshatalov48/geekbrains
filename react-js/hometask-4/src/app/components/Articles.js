import React from 'react';

export default class Articles extends React.Component {
    constructor(){
        super(...arguments);
        this.state = {
            hideArticle: [],
            fullText: []
        };
    }

    clickHide(index) {
        let newState = this.state.hideArticle;

        if (newState.indexOf(index) == -1) {
            newState.push(index);
            this.setState({
                hideArticle: newState
            });
        }
        // console.log(this.state.hideArticle, index);
    }

    clickFullText(index) {
        let newState = this.state.fullText,
            item = newState.indexOf(index);

        if (item == -1) {
            newState.push(index);
        } else {
            newState.splice(item, 1);
        }

        this.setState({
            fullText: newState
        });
    }

    render() {
        let items = this.props.items.map((item, index) => {
            let style = {},
            text = item.text.substr(0, 100) + '...';
            if (this.state.fullText.indexOf(index) != -1) {
                text = item.text;
            }
            if (this.state.hideArticle.indexOf(index) != -1) {
                style={ display:'none' };
            }
            return (
                <div className="col-xs-4" key={index}>
                    <div className="thumbnail" style={style}>
                        <img src={item.image} alt={item.title}/>
                        <div className="caption">
                            <h3>{item.title}</h3>
                            <p className="text-justify">{text}</p>
                            <p className="text-right"><i>Автор: {item.author}</i></p>
                            <div className="btn-group" role="group">
                                <button type="button" className="btn btn-default" onClick={this.clickFullText.bind(this, index)}>Подробнее</button>
                                <button type="button" className="btn btn-default" onClick={this.clickHide.bind(this, index)}>Скрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            );
        });

        return (
            <div>
                {items}
            </div>
        );
    }
}