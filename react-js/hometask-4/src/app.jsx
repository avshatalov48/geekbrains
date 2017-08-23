import React from 'react';
import ReactDOM from 'react-dom';

import Modal from './app/components/Modal';
import Menu from './app/components/Menu';
import Articles from './app/components/Articles';
import Login from './app/components/Login';

const app = document.getElementById('app');


class App extends React.Component {
    render() {

        return (
                <div>
                    <div className="container">
                        <div className="row">
                            <Menu />
                        </div>
                    </div>
                    <div className="container">
                        <div className="row">
                            <Articles />
                        </div>
                    </div>
                    <div className="container">
                        <div className="row">
                            <div className="col-xs-4" />
                            <div className="col-xs-4">
                                <Login />
                            </div>
                            <div className="col-xs-4" />
                        </div>
                    </div>
                    {/* Окно приветствия */}
                    <Modal />
                </div>
        );
    }
}


ReactDOM.render(
    <App />,
    app
);