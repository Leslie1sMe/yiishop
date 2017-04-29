<?php
/**
 * Created by PhpStorm.
 * User: Leslie
 * Date: 2017/4/26
 * Time: 10:39
 */

namespace backend\controllers;

    use yii\web\Controller;
    use Yii;
    use backend\models\Admin;

    class LoginController extends Controller{


        public function actionIndex()
        {
            $this->layout = false;

            $model = new Admin;

            if(Yii::$app->request->isPost){

            $post = Yii::$app->request->post();

                if ( $model->login($post)){

                    $this->redirect(['index/index']);
                    Yii::$app->end();
                }

            }
            return $this->render('index',array('model'=>$model));
        }

        /**
         * 退出动作
         */
        public function actionLogout()
        {
           Yii::$app->session->removeAll();
            if (!isset($session['admin']['isLogin'])){

                $this->redirect(['login/index']);

                Yii::$app->end();
            }
           $this->goBack();
        }

        /**
         * 找回密码
         */
        public function actionGetpass()
        {
            $model = new Admin;
            if (Yii::$app->request->isPost){

            $post = Yii::$app->request->post();

            if ($model->getpass($post)){


                Yii::$app->session->setFlash('info', '电子邮件已经发送成功，请查收');


            }

        }
           return $this->renderPartial('getpass', array('model'=>$model));

        }
}