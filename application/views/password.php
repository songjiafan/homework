<?php include 'header.php'; ?>
    <form class="am-form" onsubmit="return false" style="width: 40%;margin: 50px">
        <fieldset>
            <legend>修改密码</legend>
            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input type="password" class="am-form-field old_pwd" placeholder="请输入老密码">
            </div>
            <br>
            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input type="password" class="am-form-field first_pwd" placeholder="请输入新密码">
            </div>
            <br>
            <div class="am-input-group">
                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input type="password" class="am-form-field second_pwd" placeholder="请再次输入新密码">
            </div>
            <br>
            <div class="am-input-group button-form">
                <button type="button" class="am-btn am-btn-default reset">重置</button>
                <button type="button" class="am-btn am-btn-success enter">确认</button>
            </div>
        </fieldset>
    </form>
    <script src="assets/js/password.js"></script>
<?php include 'footer.php'; ?>