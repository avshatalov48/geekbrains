<?php

namespace app\controllers;
//use app\models\repositories\ProductRepository;
//use app\services\Request;

class ServiceController extends Controller
{
    public function actionIndex()
    {
        $this->actionError404();
    }

    public function actionError404()
    {
//        $id = (new Request())->getParams()['id'];
//        $product = $this->getRepository()->getOne($id);
        $this->useLayout = false;
        $product = (object) array('name'=>'Ошибка 404', 'description'=>'Страница не найдена');
        echo $this->render("card", ['product' => $product]);
    }

//    private function getRepository(){
//        return new ProductRepository();
//    }
}