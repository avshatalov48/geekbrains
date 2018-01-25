<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <? /* $form->field($model, 'category_id')->textInput() */ ?>

    <?= $form->field($model, 'category_id')->dropdownList(
    Category::find()->select(['name', 'id'])->indexBy('id')->column(),
    ['prompt'=>Yii::t('app_product', 'categorySelect')]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <? /* $form->field($model, 'photo')->textInput(['maxlength' => true]) */ ?>

    <!-- Не работает подстановка значения из БД! ['value' => $model->photo] -->
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <? /* $form->field($model, 'create_date')->textInput() */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
