<?php
/*Товар на вес*/

namespace app\models;

class Product_Weight extends Product_Real
{
    public function getTableName()
    {
        return "product_weight";
    }
}