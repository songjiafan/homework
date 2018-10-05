<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url(); ?>">
    <link rel="stylesheet" href="assets/css/amazeui.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/amazeui.flat.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/admin.css" type="text/css">
    <link rel="stylesheet" href="assets/css/index.css" type="text/css">
    <title>欢迎来到教学管理系统</title>

</head>
<body>

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/amazeui.min.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<script src="assets/js/amazeui.widgets.helper.min.js"></script>
<script src="assets/js/handlebars.min.js"></script>
<header class="am-topbar">
    <h1 class="am-topbar-brand">
        <a href="welcome">作业管理系统</a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav">
            <li><a href="welcome">首页</a></li>
            <?php if ($role == 1 && !$admin) {?>
                <!--      教师账户渲染          -->
                <li><a href="correct/file">文件上传</a></li>
                <li><a href="question/index">线上题库</a></li>
                <li><a href="question/offline">线下作业</a></li>
                <li><a href="correct">线上作业批复</a></li>
                <li><a href="question/offline_history">线下作业批改</a></li>
                <li><a href="forum/index">留言板</a></li>
                <li><a href="password">修改密码</a></li>
            <?php } else if ($role == 0 && !$admin) {?>
                <!--      学生账户渲染          -->
                <li><a href="student/index">线上答题</a></li>
                <li><a href="student/score">线上作业得分</a></li>
                <li><a href="student/offline">线下作业</a></li>
                <li><a href="student/offline_history">线下批语</a></li>
                <li><a href="forum/index">留言板</a></li>
                <li><a href="password">修改密码</a></li>
            <?php } else {?>
                <!--      管理员账户渲染          -->
                <li><a href="admin/user">用户管理</a></li>
                <li><a href="question/index">问卷调查管理</a></li>
                <li><a href="question/offline">收集园地管理</a></li>
                <li><a href="forum/index">留言板管理</a></li>
            <?php }?>
        </ul>

        <div class="am-topbar-right">
            <div class="am-dropdown" data-am-dropdown="{boundary: '.am-topbar'}">
                <p class="am-topbar-brand">
                    <?php echo $username?>
                </p>
            </div>
            <div class="am-topbar-right">
                <a href="login/logout" class="am-btn am-btn-primary am-topbar-btn am-btn-sm">退出</a>
            </div>
        </div>
    </div>
</header>
