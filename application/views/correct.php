<?php include 'header.php'; ?>

    <table class="am-table">
        <thead>
        <tr>
            <th>套题id</th>
            <th>客观题得分</th>
            <th>主观题</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($list) { foreach ($list as $k => $v) {?>
            <tr>
                <td><?php echo $v->question_id?></td>
                <td><?php echo $v->select_score?></td>
                <td><?php echo $v->subjective?></td>
                <td><button class="am-btn am-btn-success correct" data-id="<?php echo $v -> id?>">打分</button></td>
            </tr>
            <div class="am-modal am-modal-prompt" tabindex="-1" id="correct_modal_<?php echo $v -> id?>">
                <div class="am-modal-dialog">
                    <div class="am-modal-bd">
                        <p>问题1：<?php $arr = explode(';', $content[$k]); echo $arr[0]; ?></p>
                        <p>该生答案：<?php $a = $v -> subjective; $arr1 = explode(';', $a); echo $arr1[0]?></p>
                        得分：<input type="text" class="first_<?php echo $v->id?>" placeholder="每题满分25分">
                        <p>问题2：<?php $arr = explode(';', $content[$k]); echo $arr[1]; ?></p>
                        <p>该生答案：<?php $a = $v -> subjective; $arr2 = explode(';', $a); echo $arr2[1]?></p>
                        得分：<input type="text" class="second_<?php echo $v->id?>" placeholder="每题满分25分">
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