import React from 'react';

export default class Modal extends React.Component {
    constructor(){
        super(...arguments);
    }

    // componentDidMount() - Вызывается сразу после того, как происходит инициализация компонента
    componentDidMount(){
        $("#myModalBox").modal('show');
    }

    render() {
        return (
            <div id='myModalBox' className='modal fade'>
                <div className='modal-dialog'>
                    <div className='modal-content'>
                        <div className='modal-header'>
                            <button type='button' className='close' data-dismiss='modal' aria-hidden='true'>×</button>
                            <h4 className='modal-title'>Блог</h4>
                        </div>
                        <div className='modal-body'>
                            Приветствуем вас на нашем блоге!
                        </div>
                        <div className='modal-footer'>
                            <button type='button' className='btn btn-primary' data-dismiss='modal'>Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
