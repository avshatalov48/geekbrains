<?php

use yii\helpers\Html;

$this->title = 'Карта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<?

echo app\widgets\Map::widget([
                'mapHeight' => "500px",
                'mapWidth' => "80%",
                'mapX' => 55.753564,
                'mapY' => 37.621085,
                'mapZoom' => 12,
                'mapType' => "yandex#map"
]);