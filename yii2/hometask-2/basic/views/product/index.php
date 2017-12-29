<?php

use yii\helpers\Html;

$title = "Каталог товаров";
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

echo "<h1>$title</h1><hr>";

foreach ($product as $item) {
    ?>
    <div class="product">
        <a href="index.php?r=product/card/&id=<?= $item->id ?>"><?= $item->name ?> (<?= $item->price ?> руб.)</a>
    </div>
    <hr>
<? } ?>