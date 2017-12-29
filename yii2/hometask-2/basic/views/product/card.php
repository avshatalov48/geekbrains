<?php

use yii\helpers\Html;

$title = $product->name;
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product">
    <h1><?= $title ?></h1>
    <p><?= $product->short_description ?></p>
    <img src="img/products/<?= $product->photo ?>" class="img-responsive center-block">
    <?= $product->description ?>
    <h3>Цена:</h3><?= $product->price ?> руб.
</div>
<hr>
<a href="index.php?r=product">Каталог товаров</a>