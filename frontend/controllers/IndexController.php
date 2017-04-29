<?php

namespace frontend\controllers;

use yii\web\Controller;

class IndexController extends Controller{

    public function actionIndex()

    {
        //渲染模板
        $this->layout = false;
        return $this->render('index');


    }

}