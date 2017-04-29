<?php
use yii\bootstrap\activeForm;
use yii\helpers\html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>In客商城 - 后台管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- bootstrap -->
    <link href="assets/admin/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/admin/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="assets/admin/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="assets/admin/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="assets/admin/css/lib/font-awesome.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="assets/admin/css/compiled/signin.css" type="text/css" media="screen" />

    <!-- open sans font -->


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>


<div class="row-fluid login-wrapper">
    <a class="brand" href="index.html"></a>
<?php $form = ActiveForm::begin([
    'fieldConfig'=>[
        'template'=>'{input}{error}',

    ],

]);?>
    <div class="span4 box">
        <div class="content-wrap">
            <h6>Inc商城管理后台</h6>
            <?php echo $form->field($model,'adminuser')->textInput(['class'=>'span12','placeholder'=>"管理员账号"]);?>
            <?php echo $form->field($model,'adminpass')->passwordInput(['class'=>'span12','placeholder'=>"管理员密码"]);?>
            <a href="<?php echo Url::to(['login/getpass']);?>" class="forgot">忘记密码？</a>

            <?php echo $form->field($model,'rememberMe')->checkbox([
                'id'=>'remember-me',
                'template'=>'<div class="remember">{input}<label for="remember-me">记住我</label></div>']);?>


            <?php echo Html::submitButton('登录',['class'=>"btn-glow primary login"])?>
        </div>
    </div>
<?php activeForm::end();?>

</div>

<!-- scripts -->
<script src="assets/admin/js/jquery-latest.js"></script>
<script src="assets/admin/js/bootstrap.min.js"></script>
<script src="assets/admin/js/theme.js"></script>

<!-- pre load bg imgs -->
<script type="text/javascript">
    $(function () {
        // bg switcher
        var $btns = $(".bg-switch .bg");
        $btns.click(function (e) {
            e.preventDefault();
            $btns.removeClass("active");
            $(this).addClass("active");
            var bg = $(this).data("img");

            $("html").css("background-image", "url('img/bgs/" + bg + "')");
        });

    });
</script>

</body>
</html>