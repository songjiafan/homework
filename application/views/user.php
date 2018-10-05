<?php include 'header.php'; ?>
    <button class="am-btn am-btn-default add" style="float: right">新增用户</button>

    <table class="am-table">
        <thead>
        <tr>
            <th>用户id</th>
            <th>用户名</th>
            <th>用户身份</th>
            <th>班级</th>
            <th>入学时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($list) { foreach ($list as $item) {?>
            <tr>
                <td><?php echo $item->uid?></td>
                <td><?php echo $item->username?></td>
                <td><?php if ($item->role == 0) { echo '学生';} else {echo '教师';}?>
                <td><?php echo $item->class?></td>
                <td><?php echo $item->enter_time?></td>
                <td><button class="am-btn am-btn-warning del" data-id="<?php echo $item -> id?>">删除此用户</button></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="add_user">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                <form class="am-form">
                    <div class="am-form-group">
                        <label class="am-radio-inline">
                            <input type="radio" value="0" name="role">学生
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" value="1" name="role">教师
                        </label>
                    </div>
                    <div class="am-form-group">
                        <label for="doc-ta-1">用户名</label>
                        <input type="text" id="username" placeholder="请输入用户名">
                    </div>
                    <div class="am-form-group">
                        <label for="doc-ta-1">学号or工号</label>
                        <input type="text" id="uid" placeholder="请输入学号or工号">
                    </div>

                    <div class="am-form-group">
                        <label for="doc-ta-1">班级</label>
                        <input type="text" id="class" placeholder="请输入班级">
                    </div> <div class="am-form-group">
                        <label for="doc-ta-1">入学时间or教学时间</label>
                        <input type="text" class="am-form-field enter_time" placeholder="入学时间" data-am-datepicker readonly required />
                    </div>

                </form>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
<?php include 'footer.php'; ?>