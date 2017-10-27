<?php
/*Абстрактный товар*/

namespace app\models;

abstract class Product_Abstract extends Model
{
    public $article;
    public $category;
    public $title;
    public $description;
    public $size;
    public $weight;
    public $price;
    public $guarantee;
    public $country;
    public $count;

    public function __construct($article = null, $category = null, $title = null, $description = null, $size = null, $weight = null, $price = null, $guarantee = null, $country = null, $count = null)
    {
        parent::__construct();
        $this->article = $article;
        $this->category = $category;
        $this->title = $title;
        $this->description = $description;
        $this->size = $size;
        $this->weight = $weight;
        $this->price = $price;
        $this->guarantee = $guarantee;
        $this->country = $country;
        $this->count = $count;
    }

    abstract public function getPrice();

    public function getSale(){
        return "Доход с продаж: {$this->getPrice()}";
    }

}