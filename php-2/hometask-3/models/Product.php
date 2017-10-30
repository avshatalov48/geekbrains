<?php
namespace app\models;

class Product extends Model
{
    public $id;
    public $category_id;
    public $name;
    public $photo;
    public $short_description;
    public $description;
    public $price;

    public function __construct($id = null, $category_id = null, $name = null, $photo = null, $short_description = null, $description = null, $price = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->category_id = $category_id;
        $this->name = $name;
        $this->photo = $photo;
        $this->short_description = $short_description;
        $this->description = $description;
        $this->price = $price;
    }

    public function getTableName()
    {
        return "product";
    }
}