<?php
$loginUser = $this-> session -> userdata('loginUser') -> username;
?>
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
        <a href="#">教学管理系统</a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav">
            <li><a href="welcome">首页</a></li>
            <li><a href="#">课程简介</a></li>
            <li><a href="#">电子教案</a></li>
            <li><a href="#">教学课件</a></li>
            <li><a href="#">测试题库</a></li>
            <li><a href="forum">课程论坛</a></li>
            <?php if ($admin) {?>
                <li><a href="operation">后台管理</a></li>
            <?php }?>
        </ul>

        <div class="am-topbar-right">
            <div class="am-dropdown" data-am-dropdown="{boundary: '.am-topbar'}">
                <p class="am-topbar-brand">
                    <?php echo $loginUser?>
                </p>
            </div>
            <div class="am-topbar-right">
                <a href="login/logout" class="am-btn am-btn-primary am-topbar-btn am-btn-sm">退出</a>
            </div>
        </div>
    </div>
</header>
