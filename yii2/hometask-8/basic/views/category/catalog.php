<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='product-index'>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
//    $this->renderDynamic('return var_dump(Yii::$app->request->get());');
    echo "<hr><b>Проверка кэширования:</b>" .
//        "<br>" . $this->renderDynamic('return Yii::$app->request->get();') .
        "<br>static: " . date("H:i:s") .
        "<br>dynamic: " . $this->renderDynamic('return date("H:i:s");') . "<hr>";
    ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'firstPageLabel' => 'Первая',
            'lastPageLabel' => 'Последняя',
            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
        ],
        'itemView' => function ($model) {
            return "<hr>
            <div class='product'>
                <a href='" . Yii::getAlias('@web') . "/product/category/?category_id={$model->id}'>{$model->name}</a>
            </div>";
        },
    ]);
    ?>

</div>