<?php

// Добавляем имя класса к Controller, чтобы понимать, что речь идет именно об этом компоненте

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{
    // Action выполняемый по default
    public function actionIndex()
    {
        echo "Catalog";
    }

    // В связке с моделью
    public function actionCard()
    {
        // Отобразить без Layout (false), например, для Ajax запроса и т.д.
        $this->useLayout = false;
        // Получаем id продукта
        $id = $_GET['id'];

        if ($id) {
            $product = Product::getOne($id);
            echo $this->render("card", ['product' => $product]);
        } else {
            $products = Product::getAll();
            foreach ($products as $product ) {
                echo $this->render("card", ['product' => $product]);
            }
        }

    }

}