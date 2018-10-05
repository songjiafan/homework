<?php include 'header.php'; ?>
    <form class="am-form-inline"  onsubmit="return false" role="form" style="float: left">
        <div class="am-form-group">
            <input type="text" class="am-form-field title" placeholder="输入套题名称">
        </div>

        <button type="submit" class="am-btn am-btn-default search">查询</button>
    </form>
    <button class="am-btn am-btn-default add" style="float: right">添加套题</button>

    <table class="am-table">
        <thead>
        <tr>
            <th>套题id</th>
            <th>套题名称</th>
            <th>客观题</th>
            <th>客观题答案</th>
            <th>主观题</th>
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
            <td><?php echo $item->select_content?>
            </td>
            <td><?php foreach (explode(';', $item->select_answer) as $selectAnswer){ ?>
                <p><?php echo $selectAnswer; }?></p>
            </td>
            <td><?php echo $item->content_question?></td>
            <td><?php echo $item->start_time?></td>
            <td><?php echo $item->end_time?></td>
            <td><button class="am-btn am-btn-warning del" data-id="<?php echo $item -> id?>">删除</button></td>
        </tr>
        <?php }} ?>
        </tbody>
    </table>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="add_question">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                <form class="am-form">
                    <div class="am-form-group">
                        <label for="doc-ta-1">套题名称</label>
                        <textarea rows="2" id="question_title" placeholder="请输入套题名称"></textarea>
                    </div>
                    <div class="am-form-group">
                        <input type="text" class="am-form-field start_time" placeholder="答题开始时间" data-am-datepicker readonly required />
                    </div>
                    <div class="am-form-group">
                        <input type="text" class="am-form-field end_time" placeholder="答题结束时间" data-am-datepicker readonly required />
                    </div>
                    <?php for ($x = 0; $x < 10; $x++) {?>
                        <div class="am-form-group">
                            <label for="doc-ta-1">选择题<?php echo $x + 1?></label>
                            <textarea rows="2" id="select_content_<?php echo $x?>" placeholder="请输入题干 题干里不要使用英文分号';' 选项不要使用 | 和 英文逗号两种标点符号"></textarea>
                        </div>
                    <div class="am-form-group">
                        <label class="am-radio-inline">
                            <input type="radio" class="select" value="A" name="<?php echo $x?>">A
                            <input type="text" class="select-answer-<?php echo $x ?>-A">
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" class="select" value="B" name="<?php echo $x?>">B
                            <input type="text" class="select-answer-<?php echo $x ?>-B">
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" class="select" value="C" name="<?php echo $x?>">C
                            <input type="text" class="select-answer-<?php echo $x ?>-C">
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" class="select" value="D" name="<?php echo $x?>">D
                            <input type="text" class="select-answer-<?php echo $x ?>-D">
                        </label>
                    </div>
                    <?php }?>
                    <?php for ($x = 0; $x < 2; $x++) {?>
                        <div class="am-form-group">
                            <label for="doc-ta-1">简答题<?php echo $x + 1?></label>
                            <textarea rows="2" id="question_title_<?php echo $x?>" placeholder="请输入题干"></textarea>
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
    <script src="assets/js/question.js"></script>
<?php include 'footer.php'; ?>