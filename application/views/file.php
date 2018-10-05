<?php include 'header.php'; ?>
    <form class="am-form" action="correct/do_upload" method="post" enctype="multipart/form-data" style="width: 40%;margin: 50px">
        <fieldset>
            <legend>修改密码</legend>
            <div class="am-input-group">
                <input type="file" name="userfile" class="am-form-field old_pwd" placeholder="上传文件">
            </div>
            <br>
            <div class="am-input-group button-form">
                <button type="submit" class="am-btn am-btn-success ">确认</button>
            </div>
        </fieldset>
    </form>
<?php include 'footer.php'; ?>