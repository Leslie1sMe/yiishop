<?php
/**
 * Created by PhpStorm.
 * User: Leslie
 * Date: 2017/4/27
 * Time: 13:38
 */
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Admin extends ActiveRecord{

    public static function tableName()
    {
        return '{{%admin}}';
    }
    /**
     * 数组的返回
     */
    public function rules()
    {
        return [
            ['adminuser', 'required', 'message' => '管理员账号不能为空', 'on' => ['login', 'getpass', 'changepass', 'adminadd', 'changeemail']],
            ['adminpass', 'required', 'message' => '管理员密码不能为空', 'on' => ['login', 'changepass', 'adminadd', 'changeemail']],
            ['rememberMe', 'boolean', 'on' => 'login'],
            ['adminpass', 'validatePass', 'on' => ['login', 'changeemail']],
            ['adminemail', 'required', 'message' => '电子邮箱不能为空', 'on' => ['getpass', 'adminadd', 'changeemail']],
            ['adminemail', 'email', 'message' => '电子邮箱格式不正确', 'on' => ['getpass', 'adminadd', 'changeemail']],
            ['adminemail', 'unique', 'message' => '电子邮箱已被注册', 'on' => ['adminadd', 'changeemail']],
            ['adminuser', 'unique', 'message' => '管理员已被注册', 'on' => 'adminadd'],
            ['adminemail', 'validateEmail', 'on' => 'getpass'],
            ['repass', 'required', 'message' => '确认密码不能为空', 'on' => ['changepass', 'adminadd']],
            ['repass', 'compare', 'compareAttribute' => 'adminpass', 'message' => '两次密码输入不一致', 'on' => ['changepass', 'adminadd']],
        ];
    }

    /**
     * 密码验证
     */
    public function validatePass()
    {
        if (!$this->hasErrors()){
            $data = self::find()->where('adminuser = :user and adminpass = :pass',[":user"=> $this->adminuser,":pass" => md5($this->adminpass)])->one();
        }
        if (is_null($data)){

            $this->addError('adminpass','用户名或者密码错误');

        }
    }
    /**
     * 验证登录
     */
    public $rememberMe;
    public $repass;
    public function login($data)
    {
       if ($this->load($data)&& $this->validate()) {
           //存入session
           $lifetime = $this->rememberMe? 24*3600:0;
           $session = Yii::$app->session;
           session_set_cookie_params($lifetime);

           $session['admin'] = [

               'adminuser'=> $this->adminuser,

                'isLogin' =>1,
           ];
           $this->updateAll(['logintime'=> time(),'loginip' => ip2long(Yii::$app->request->userIP)], 'adminuser= :user',[':user' => $this->adminuser]);


        return (bool)$session['admin']['isLogin'];
    }
        return false;
    }


    /**
     * 邮箱验证
     */

    public function validateEmail()
    {
        if(!$this->hasErrors()){

            $data = self::find()->where('adminuser =:user and adminemail =:email',[":user" =>$this->adminuser,":email" => $this->adminemail])->one();

            if (is_null($data)){

                $this->addError('adminemail',"用户名与邮箱不匹配！");
            }

        }
    }

    /**
     * @param $data
     * 找回密码
     */
    public function getpass($data)
    {
        $this->scenario = "getpass";

        if($this->load($data)&& $this->validate()){

            $time = time();
            $token = $this->createToken($data['Admin']['adminuser'], $time);

            $mailer = Yii::$app->mailer->compose('getpass', ['adminuser' => $data['Admin']['adminuser'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("inkebiji@163.com");
            $mailer->setTo($data['Admin']['adminemail']);
            $mailer->setSubject("In客笔记-找回密码");
            if ($mailer->send()) {
                return true;
            }

        }
            return false;


    }


    /**T
     *创建token
     */
    public function createToken($adminuser,$time)
    {
        return md5(md5($adminuser).base64_encode(Yii::$app->request->userIP).md5($time));
    }
    /**
     * 密码修改
     */
    public function changepass($data)
    {
        $this->scenario="changepass";

        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminemail' => $this->adminemail], 'adminuser = :user', [':user' => $this->adminuser]);
        }
        return false;
    }


    public function addManager($data)
    {
        if ($this->load($data) && $this->validate()) {





       }

    }
}