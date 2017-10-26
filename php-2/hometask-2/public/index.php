<?php
include "../services/Autoloader.php";

spl_autoload_register([new Autoloader(), 'loadClass']);

require("../Interfaces/IModel.php");
require("../services/Db.php");

$product = new Product();

var_dump($product);


function foo(IModel $object){
    echo $object->getTableName();
}