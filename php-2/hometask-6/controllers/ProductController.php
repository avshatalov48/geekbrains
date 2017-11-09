<?php

namespace app\controllers;
use app\models\repositories\ProductRepository;
use app\services\Request;

class ProductController extends Controller
{
    public function actionIndex()
    {
        echo "Catalog";
    }

    public function actionCard()
    {
        $id = (new Request())->getParams()['id'];
        $product = $this->getRepository()->getOne($id);
        $this->useLayout = false;
        echo $this->render("card", ['product' => $product]);
    }

    private function getRepository(){
        return new ProductRepository();
    }
}