<?php
/**
 * Created by PhpStorm.
 * User: Leslie
 * Date: 2017/4/26
 * Time: 4:38
 */

namespace frontend\controllers;

use yii\web\Controller;

class ProductController extends Controller{

    public $layout = false;
    public function actionIndex()
    {

       return $this->render('index');
    }

    public function actionDetail()
    {

        return $this->render('detail');
    }
}