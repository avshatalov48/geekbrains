<?php

include "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$product = new \app\models\Product_Digital();

var_dump($product);

function foo(\app\Interfaces\IModel $object){
    echo $object->getTableName();
}