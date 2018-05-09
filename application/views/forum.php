<?php include 'header.php'; ?>
<head>
    <link rel="stylesheet" href="assets/css/forum.css">
</head>
<section id="container">
    <div class="am-g">
        <div class="am-u-sm-8">
            <?php if ($forumList) { foreach ($forumList as $item) {?>
                <div class="forum-see">
                    <a href="forum/content?forum_id=<?php echo $item -> id?>">
                        <h3><?php echo $item -> title?><h3/>
                    </a>
                    <p>发布人：<?php echo $item -> author_username?></p>
                    <p>发布时间：<?php echo $item -> create_time?></p>
                    <p>评论数：<?php echo $item -> count?></p>
                    <?php if($admin){ ?><button class="del_forum am-btn am-btn-warning am-btn-xs" type="button" data-id="<?php echo $item -> id?>">删除此贴</button><?php }?>
                </div>
            <?php }}?>
        </div>
        <div class="am-u-sm-4">
            <ul class="am-list">
                <a href="" onclick="return false;"><li class="nav_ul" id="new_note">发布帖子</li></a>
<!--                <a href="forum?comment=1"><li class="nav_ul">我评论过的帖子</li></a>-->
            </ul>
        </div>
    </div>

    <div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                <form class="am-form">
                <div class="am-form-group">
                    <label for="doc-ipt-pwd-1">标题</label>
                    <input type="text" id="title" placeholder="请输入标题">
                </div>
                <div class="am-form-group">
                    <label for="doc-ta-1">内容</label>
                    <textarea rows="5" id="content" placeholder="请输入帖子内容"></textarea>
                </div>
                </form>
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>提交</span>
            </div>
        </div>
    </div>
</section>
    <div class="am-modal am-modal-confirm" tabindex="-1" id="del-forum-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
                是否删除此篇帖子
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-confirm" tabindex="-1" id="forum-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">

            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
    <script src="assets/js/forum.js"></script>
<?php include 'footer.php'; ?>