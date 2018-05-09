<?php include 'header.php'; ?>
    <head>
        <link rel="stylesheet" href="assets/css/forum.css">
    </head>
    <section id="container" data-id="<?php echo $forumData -> id?>">
        <section>
            <article class="forum-content">
                <p class="title"><?php echo $forumData -> title?></p>
                <hr>
                <div class="content"><?php echo $forumData -> content?></div>
            </article>
            <button id="new_comment" class="am-btn am-btn-secondary">写评论</button>
        </section>
        <?php if(($commentData)){ foreach ($commentData as $item) {?>
        <section>

            <article class="am-comment comment-box"> <!-- 评论容器 -->
                <div class="am-comment-main"> <!-- 评论内容容器 -->
                    <header class="am-comment-hd">
                        <div class="am-comment-meta"> <!-- 评论元数据 -->
                            <a href="#link-to-user" class="am-comment-author"><?php echo $item -> author_username?></a> <!-- 评论者 -->
                            评论于 <?php echo $item -> create_time?>
                        </div>
                    </header>
                    <div class="am-comment-bd">
                        <?php echo $item -> content?>
                        <?php if($admin){ ?><button class="del_comment am-btn am-btn-warning am-btn-xs" type="button" data-id="<?php echo $item -> id?>">删除此条评论</button><?php }?>
                    </div> <!-- 评论内容 -->
                </div>
            </article>
        </section>
        <?php } }?>





        <div class="am-modal am-modal-prompt" tabindex="-1" id="comment-prompt">
            <div class="am-modal-dialog">
                <div class="am-modal-bd">
                    <form class="am-form">

                        <div class="am-form-group">
                            <label for="doc-ta-1">评论内容</label>
                            <textarea rows="5" id="comment-content" placeholder="请输入评论内容"></textarea>
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
    <div class="am-modal am-modal-confirm" tabindex="-1" id="forum-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">

            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <div class="am-modal am-modal-confirm" tabindex="-1" id="del-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-bd del-message">

            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>
    <script src="assets/js/forum.js"></script>
<?php include 'footer.php'; ?>