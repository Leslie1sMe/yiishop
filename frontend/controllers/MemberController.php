<?php

namespace frontend\controllers;


use yii\web\Controller;

class MemberController extends Controller{

    public function actionAuth()

    {
        //渲染模板
        $this->layout = false;
        return $this->render('auth');


    }

}