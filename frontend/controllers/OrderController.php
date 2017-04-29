<?php

namespace frontend\controllers;

use yii\web\Controller;

class OrderController extends Controller{

    public function actionCheck()

    {
        //渲染模板
        $this->layout = false;
        return $this->render('check');


    }

    public function actionIndex()

    {
        //渲染模板
        $this->layout = false;
        return $this->render('index');


    }
}