<?php include 'header.php'; ?>
    <head>
        <link rel="stylesheet" href="assets/css/operation.css">
    </head>
    <section id="container">
    <?php if (!empty($forumList)) { foreach ($forumList as $item) {?>
        <div class="forum-operation">
            <p><span class="forum-label">标题：</span><?php echo $item -> title?></p>
            <p><span class="forum-label">内容：</span><?php echo $item -> content?></p>
            <p><span class="forum-label">作者：</span><?php echo $item -> author_username?></p>
            <a href="operation/check_forum?status=1&id=<?php echo $item -> id?>" type="button" class="am-btn am-btn-success am-btn-xs btn-operation">合格</a>
            <a href="operation/check_forum?status=2&id=<?php echo $item -> id?>" type="button" class="am-btn am-btn-warning am-btn-xs btn-operation2">不合格</a>
        </div>
    <?php } }?>
    <?php if (!empty($commentList)) { foreach ($commentList as $item) {?>
        <div class="comment-operation">
            <p><span class="forum-label">帖子标题：</span><?php echo $item->title?></p>
            <p><span class="forum-label">评论内容：</span><?php echo $item->content?></p>
            <p><span class="forum-label">评论人：</span><?php echo $item->author_username?></p>
            <a href="operation/check_comment?status=1&id=<?php echo $item -> id?>" type="button" class="am-btn am-btn-success am-btn-xs btn-operation">合格</a>
            <a href="operation/check_comment?status=2&id=<?php echo $item -> id?>" type="button" class="am-btn am-btn-warning am-btn-xs btn-operation2">不合格</a>
        </div>
    <?php } }?>
    </section>

    <script src="assets/js/operation.js"></script>
<?php include 'footer.php'; ?>