<?php
/**
 * Created by PhpStorm.
 * User: Leslie
 * Date: 2017/4/26
 * Time: 10:39
 */
namespace backend\controllers;
use yii\web\Controller;

class IndexController extends Controller{


    public function actionIndex()
    {

        $this->layout = "layout";
        return $this->render('index');
    }

}