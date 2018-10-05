
<?php include 'header.php'; ?>
<button class="am-btn am-btn-warning new" style="float: right;margin: 10px">新增留言</button>
<?php if ($list) { foreach ($list as $item) {?>
    <article class="am-comment" style="margin-bottom: 20px; width: 50%">
        <div class="am-comment-main">
            <header class="am-comment-hd">
                <div class="am-comment-meta">
                    <a href="#link-to-user" class="am-comment-author"><?php echo $item -> name?></a>
                    评论于 <time><?php echo $item -> time?></time>
                </div>
            </header>
            <button class="am-btn am-btn-success reply" data-uid="<?php echo $item->uid?>" data-id="<?php echo $item->id?>" style="float: right; margin-top: 10px; margin-right: 20px">回复</button>
            <?php if($admin){?>
                <a class="am-btn am-btn-danger" href="forum/del?id=<?php echo $item->id ?>" style="float: right; margin-top: 10px; margin-right: 20px">删除</a>
            <?php }?>
            <div class="am-comment-bd">
                <?php if (!empty($item -> reply_name)) {echo '回复 '.$item -> reply_name.'：';}?><?php echo $item -> content?>
            </div>

        </div>
    </article>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="reply_<?php echo $item->id?>">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                <form class="am-form">
                    <div class="am-form-group">
                        <label for="doc-ta-1">评论</label>
                        <input type="text" class="content_<?php echo $item->id?>">
                    </div>
                </form>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
<?php }} ?>
<div class="am-modal am-modal-prompt" tabindex="-1" id="reply_new">
    <div class="am-modal-dialog">
        <div class="am-modal-bd">
            <form class="am-form">
                <div class="am-form-group">
                    <label for="doc-ta-1">留言</label>
                    <input type="text" class="content_new">
                </div>
            </form>
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-cancel>取消</span>
            <span class="am-modal-btn" data-am-modal-confirm>提交</span>
        </div>
    </div>
</div>
<script src="assets/js/forum.js"></script>
<?php include 'footer.php'; ?>