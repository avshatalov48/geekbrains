<?php

include "../services/Autoloader.php";

spl_autoload_register([new \services\Autoloader(), 'loadClass']);

$product = new \models\Product();

var_dump($product);

function foo(\Interfaces\IModel $object){
    echo $object->getTableName();
}