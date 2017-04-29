<?php
/**
 * Created by PhpStorm.
 * User: Leslie
 * Date: 2017/4/28
 * Time: 4:33
 */
use yii\helpers\Url;
?>
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>管理员列表</h3>
                <div class="span10 pull-right">
                    <input type="text" class="span5 search" placeholder="Type a user's name..." />

                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->


                    <a href="<?php echo Url::to(['manager/reg'])?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        增加新用户
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr >
                        <th class="span2 sortable">
                            管理员id
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>管理员账号
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>管理员邮箱
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>最后登录时间
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>最后登录ip
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>添加时间
                        </th>
                        <th class="span1 sortable align-center">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($managers as $manager):?>
                        <tr class="first">
                            <td><?php echo $manager['adminid']; ?></td>
                            <td><?php echo $manager['adminuser']; ?></td>
                            <td><?php echo $manager['adminemail']; ?></td>
                            <td><?php echo date("Y:m:d H:i:s",$manager->logintime) ?></td>
                            <td><?php echo long2ip($manager['loginip']) ?></td>
                            <td><?php echo date("Y:m:d H:i:s",$manager->createtime) ?></td>

                            <td><a href="<?php echo Url::to(['manager/del'])?>">删除</a></td>

                        </tr>

                    <?php endforeach?>


                    </tbody>
                </table>
            </div>
            <div class="pagination pull-right">
                <ul>
                    <li><a href="#">&#8249;</a></li>
                    <li><a class="active" href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&#8250;</a></li>
                </ul>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
<!-- end main container -->
