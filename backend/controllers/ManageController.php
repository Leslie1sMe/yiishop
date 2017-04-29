<?php
/**
 * Created by PhpStorm.
 * User: Leslie
 * Date: 2017/4/28
 * Time: 1:16
 */
namespace backend\controllers;

use yii\data\Pagination;
use yii\web\Controller;
use backend\models\Admin;
use Yii;

class ManageController extends Controller{


    public function actionMailchangepass()
    {
        $time = Yii::$app->request->get("timestamp");
        $adminuser = Yii::$app->request->get("adminuser");
        $token = Yii::$app->request->get("token");


        $model = new Admin;
        $mytoken = $model->createToken($adminuser,$time);

        if ($token !== $mytoken){

            $this->redirect(['login/index']);
            Yii::$app->end();
        }
        if (time()-$time >300){

            $this->redirect(['login/index']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost){

            $post = Yii::$app->request->post();


            if ($model->changepass($post)){

            Yii::$app->session->setFlash('info','密码修改成功！');

            }
        }
        $this->layout = false;

        return $this->render("mailchangepass",['model'=>$model]);
    }

    /**
     * 管理员列表
     */
    public function actionManagers()
    {
        $this->layout="layout";
        $model = Admin::find();
        $count = $model->count();
        $pager = new Pagination(['totalCount'=>$count,'pageSize'=>1]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('managers',['managers'=>$managers,'pager'=>$pager]);
}

    /**
     * 增加用户
     */
    public function actionReg()
    {

        $this->layout="layout";
        $model  = new Admin;


        return $this->render("reg",['model'=>$model]);

    }








}