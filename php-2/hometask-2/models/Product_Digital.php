<?php
/*Цифровой товар*/

namespace app\models;

class Product_Digital extends Product_Abstract
{
    public function getPrice()
    {
        return 0;
    }

    public function getTableName()
    {
        return "product_digital";
    }
}