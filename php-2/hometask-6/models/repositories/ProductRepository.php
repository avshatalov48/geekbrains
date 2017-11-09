<?php


namespace app\models\repositories;


use app\models\Product;

class ProductRepository extends Repository
{

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "product";
        $this->entityClass = Product::class;
    }
}
