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
        // Получаем id продукта
        $id = $_GET['id'];
        $product = Product::getOne($id);
        // Отобразить без Layout, например, для Ajax запроса и т.д.
        $this->useLayout = false;
        // Передаем во View - Шаблон и параметры
        echo $this->render("card", ['product' => $product]);
    }
}