<?php
/*Физический товар*/

namespace app\models;

class Product_Real extends Product_Abstract
{
    public function getPrice() {
        return 0;
    }

    public function getTableName()
    {
        return "product_real";
    }
}