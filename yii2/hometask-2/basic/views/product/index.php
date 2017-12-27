<?php

use yii\helpers\Html;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product">
    <h1><?= Html::encode($this->title) ?></h1>

	<p><?=$short_description?></p>
	<img src="<?=$photo?>" class="img-responsive center-block">
	<?=$description?>
	<h3>Цена:</h3><?=$price?>

</div>