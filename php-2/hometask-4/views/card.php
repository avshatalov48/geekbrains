<!-- Во View мы передаем некоторый объект, она же модель
-->
<h3><?=$product->name?></h3>
<p>
    <strong>Краткое описание: </strong><?=$product->short_description?><br>
    <strong>Подробное описание: </strong><?=$product->description?><br>
    <strong>Цена: </strong><?=$product->price?>
</p>
<hr>