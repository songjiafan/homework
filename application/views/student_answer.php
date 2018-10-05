<?php include 'header.php'; ?>
    <form class="am-form-inline" role="form" onsubmit="return false">
        <div class="am-form-group">
            <input type="text" class="am-form-field title" placeholder="输入套题名称">
        </div>

        <button type="submit" class="am-btn am-btn-default search-answer">查询</button>
    </form>
    <table class="am-table">
        <thead>
        <tr>
            <th>套题id</th>
            <th>套题名称</th>
            <th>答题开始时间</th>
            <th>答题结束时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($list) { foreach ($list as $item) {?>
            <tr>
                <td><?php echo $item->id?></td>
                <td><?php echo $item->title?></td>
                <td><?php echo $item->start_time?></td>
                <td><?php echo $item->end_time?></td>
                <td><button class="am-btn am-btn-warning answer" <?php if (date("Y-m-d H:m:s") < $item->start_time || date("Y-m-d H:m:s") > $item->end_time) { echo "disabled"; }?> data-id="<?php echo $item -> id?>">答题</button></td>
            </tr>
            <div class="am-modal am-modal-prompt" tabindex="-1" id="add_question_<?php echo $item->id?>">
                <div class="am-modal-dialog">
                    <div class="am-modal-bd">
                        <form class="am-form">
                        <?php $arr = explode('|', $item->select_question); foreach (explode(';', $item->select_content) as $k => $v) {?>
                                <div class="am-form-group">
                                    <label for="doc-ta-1">选择题<?php echo $k + 1?></label>
                                    <p><?php echo $v ?></p>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-radio-inline">
                                        <input type="radio" value="A" name="<?php echo $k ?>">A:
                                        <span><?php echo explode(';', $arr[$k])[0] ?></span>
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" value="B" name="<?php echo $k ?>">B:
                                        <span><?php echo explode(';', $arr[$k])[1] ?></span>
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" value="C" name="<?php echo $k ?>">C:
                                        <span><?php echo explode(';', $arr[$k])[2] ?></span>
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" value="D" name="<?php echo $k?>">D:
                                        <span><?php echo explode(';', $arr[$k])[3] ?></span>
                                    </label>
                                </div>
                            <?php }?>
                            <?php foreach (explode(';', $item->content_question) as $k => $v) {?>
                                <div class="am-form-group">
                                    <label for="doc-ta-1">简答题<?php echo $k + 1?></label>
                                    <p><?php echo $v?></p>
                                    <textarea rows="2" id="question_title_<?php echo $item->id?>_<?php echo $k ?>" placeholder="请输入答案"></textarea>
                                </div>
                            <?php }?>
                        </form>
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


    <script src="assets/js/question.js"></script>
<?php include 'footer.php'; ?>