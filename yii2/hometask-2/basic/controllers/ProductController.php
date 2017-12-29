<?php
namespace app\controllers;

use app\models\Product;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $product = Product::find()->all();
        return $this->render('index', ['product' => $product]);
    }

    public function actionCard($id)
    {
        $product = Product::findOne($id);
        return $this->render('card', ['product' => $product]);
    }
}