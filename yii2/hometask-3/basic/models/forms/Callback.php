<?php

namespace app\models\forms;

use yii\base\Model;


class CallbackForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $reason;

//    Валидация
    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['email', 'reason', 'city'], 'safe']
        ]
    }

//    Смена подписей к форме
    public function attributeLabels()
    {
        return [
            'name' => 'Имя'
        ];
    }

//    Подгрузка значений для списка city - формы
    public static function getCities()
    {
        return [
            '1' => 'Москва',
            '2' => 'Воронеж',
            '3' => 'Липецк'
        ];
    }

}