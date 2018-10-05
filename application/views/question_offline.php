<?php include 'header.php'; ?>
    <button class="am-btn am-btn-default add1" style="float: right">生成作业</button>

    <table class="am-table">
        <thead>
        <tr>
            <th>套题id</th>
            <th>套题名称</th>
            <th>答题结束时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($list) { foreach ($list as $item) {?>
            <tr>
                <td><?php echo $item->id?></td>
                <td><?php echo $item->title?></td>
                <td><?php echo $item->end_time?></td>
                <td><button class="am-btn am-btn-warning del" data-id="<?php echo $item -> id?>">删除</button></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="add_offline_teacher">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                <form class="am-form">
                    <div class="am-form-group">
                        <label for="doc-ta-1">套题名称</label>
                        <textarea rows="2" id="question_title" placeholder="请输入套题名称"></textarea>
                    </div>
                    <div class="am-form-group">
                        <div class="am-form-group">
                            <input type="text" class="am-form-field end_time" placeholder="答题结束时间" data-am-datepicker readonly required />
                        </div>
                    </div>
                </form>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
    <script src="assets/js/offline.js"></script>
<?php include 'footer.php'; ?>