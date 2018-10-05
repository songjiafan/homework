<?php include 'header.php'; ?>

    <table class="am-table">
        <thead>
        <tr>
            <th>套题id</th>
            <th>文件</th>
            <th>下载</th>
            <th>写评语</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($list) { foreach ($list as $v) {?>
            <tr>
                <td><?php echo $v -> id?></td>
                <td><?php echo $v->filename?></td>
                <td><a class="am-btn am-btn-success" href="<?php echo 'question/download?filename='.$v->filename ?>" data-id="<?php echo $v->id?>">下载</a></td>
            <td><button class="am-btn am-btn-warning correct2" href="<?php echo 'question/download?filename='.$v->filename ?>" data-id="<?php echo $v->id?>">打分</button></td>
            </tr>
            <div class="am-modal am-modal-prompt" tabindex="-1" id="correct_modal_<?php echo $v -> id?>">
                <div class="am-modal-dialog">
                    <div class="am-modal-bd">
                        评论：<input type="text" class="offline_<?php echo $v->id?>">
                    </div>
                    <div class="am-modal-footer">
                        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                        <span class="am-modal-btn" data-am-modal-confirm>提交</span>
                    </div>
                </div>
            </div>
        <?php }} ?>
        </tbody>
    </table>
    <script src="assets/js/correct.js"></script>
<?php include 'footer.php'; ?>