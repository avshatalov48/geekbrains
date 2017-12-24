<?php

// index.php?r=product
namespace app\controllers;

use yii\web\Controller;

class ProductController extends Controller {
	// отключение использование Layout
	public $layout = false;

	public function actionIndex() {
		return $this->render('index', ['title'=>'Yii2', 'content'=>'Lesson 1']);
	}
}