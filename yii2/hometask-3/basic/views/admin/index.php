<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php

    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
//        возьмем для примера, шаблон View от DetailView
        'itemView' => 'view',
// при необходимости передаем переменные внутрь шаблона
        'viewParams' => ['hideBr' => true]
    ]);

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
// Фильтрация, сортировка
        'filterModel' => $searchModel,
        'columns' => [
// Колонка с порядковым номером
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'category_id',
            'name',
            'photo',
            'short_description',
            //'description:ntext',
            //'price',
            [
                'class' => 'yii\grid\CheckboxColumn'
                // you may configure additional properties here
            ],
            ['class' => 'yii\grid\ActionColumn',
//                вывод только определенных действий
                'template' => '{view} {update} {delete}',
// переопределение действий кнопок
                'buttons' => ['update' => function ($url, $model, $key) {
                    echo "Обновить!";
                }],
            ]
        ]]); ?>
</div>