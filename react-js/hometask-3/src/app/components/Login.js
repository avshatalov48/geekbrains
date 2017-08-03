import React from 'react';

export default class Login extends React.Component
{
    render(){
        return (
            <div>
                <hr></hr>
                <input type="text" class="form-control" placeholder="Логин" aria-describedby="basic-addon1"></input>
                <input type="text" class="form-control" placeholder="Пароль" aria-describedby="basic-addon2"></input>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">Войти</button>
                    <button type="button" class="btn btn-default">Регистрация</button>
                </div>
                <hr></hr>
            </div>
        );
    }
}