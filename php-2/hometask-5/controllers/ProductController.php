<?php

namespace app\controllers;


use app\models\DataGetter;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    public function actionIndex()
    {
        echo "Catalog";
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = $this->getRepository()->getOne($id);
        //$this->useLayout = false;
        echo $this->render("card", ['product' => $product]);
    }

    private function getRepository(){
        return new ProductRepository();
    }
}