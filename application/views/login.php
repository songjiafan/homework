<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/amazeui.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/amazeui.flat.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/admin.css" type="text/css">
    <link rel="stylesheet" href="assets/css/login.css" type="text/css">
    <title>请登录</title>
</head>
<body>
    <section class="login-form">
        <form class="am-form" onsubmit="return false">
            <fieldset>
                <legend>请登录</legend>
                <div class="am-input-group">
                    <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                    <input type="text" class="am-form-field user_id" placeholder="请输入学号">
                </div>
                <br>
                <div class="am-input-group">
                    <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                    <input type="password" class="am-form-field pwd" placeholder="请输入密码">
                </div>
                <br>
                <div class="am-input-group button-form">
                    <button type="button" class="am-btn am-btn-default reset">重置</button>
                    <button type="button" class="am-btn am-btn-success login">登录</button>
                </div>
            </fieldset>
        </form>
    </section>
    <section>
        <div class="am-modal am-modal-confirm" tabindex="-1" id="login-confirm">
            <div class="am-modal-dialog">
                <div class="am-modal-bd">
                    <!--         此处添加后端返回值         -->
                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.ie8polyfill.min.js"></script>
    <script src="assets/js/amazeui.widgets.helper.min.js"></script>
    <script src="assets/js/handlebars.min.js"></script>
    <script src="assets/js/login/login.js"></script>
</body>
</html>