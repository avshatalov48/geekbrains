<?php

$form = \yii\widgets\ActiveForm::begin([
    'id' => 'callback_form',
    'options' => [
//        Чтобы форма отправляла файлы
//        'enctype' => 'multipart/form-data'
    ]
]);

// Привязываем элементы к модели
echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'phone')->textInput();
echo $form->field($model, 'email')->textInput();
echo $form->field($model, 'reason')->textArea();
echo $form->field($model, 'city')->dropDownList($cities);

// Кнопка отправить
echo \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-success']);

\yii\widgets\ActiveForm::end;

//\app\widgets\HelloWidget::begin([
//    'message' => 'Не нажимай!!!',
//    'template' => ''
//]);

//echo "wfwdfsdf";

//\app\widgets\HelloWidget::end();

echo \app\widgets\HelloWidget::widget([
    'message' => 'Не нажимай!!!'
]);
