import React from 'react';

export default class Login extends React.Component {
    render() {
        return (
            <div>
                <hr />
                <input type="text" className="form-control" placeholder="Логин" aria-describedby="basic-addon1"/>
                <input type="text" className="form-control" placeholder="Пароль" aria-describedby="basic-addon2"/>
                <div className="btn-group" role="group">
                    <button type="button" className="btn btn-default">Войти</button>
                    <button type="button" className="btn btn-default">Регистрация</button>
                </div>
                <hr />
            </div>
        );
    }
}