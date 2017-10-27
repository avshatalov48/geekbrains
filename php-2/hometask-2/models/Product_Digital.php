<?php
/*Цифровой товар*/

namespace app\models;

class Product_Digital extends Product_Real
{
    public function getPrice($number) {
        $sum = parent::getPrice($number)/2;
        $this->total -= $sum;
        return $sum;
    }

    public function getTableName()
    {
        return "product_digital";
    }
}