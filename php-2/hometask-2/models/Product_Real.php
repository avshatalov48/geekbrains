<?php
/*Физический товар*/

namespace app\models;

class Product_Real extends Product_Abstract
{
    public function getPrice($number) {
        $sum = $this->price * $number;
        $this->total += $sum;
        return $sum;
    }

    public function getTableName()
    {
        return "product_real";
    }
}