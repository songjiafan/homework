<?php include 'header.php'; ?>
    <link rel="stylesheet" href="assets/css/offline.css">
    <?php if ($list) { foreach ($list as $item) {?>
        <div class="item">
            <h3>作业内容：<?php echo $item -> title?></h3>
            <p>截止时间：<?php echo $item -> end_time?></p>
            <form action="student/do_upload" method="post" enctype="multipart/form-data">
                <input type="text" name="question_id" value="<?php echo $item -> id?>" style="opacity: 0; display: block; width: 1px; height: 1px">
                <input type="text" name="teacher_id" value="<?php echo $item -> owner_id?>" style="opacity: 0; display: block; width: 1px; height: 1px">
                <input type="file" name="userfile">
                <?php if(date("Y-m-d H:m:s") > $item->end_time){?>
                    <button type="submit" class="am-btn am-btn-warning" disabled >已截止</button>
                <?php } else { ?>
                    <button type="submit" class="am-btn am-btn-warning" style="margin-top: 20px" >确认上传</button>
                <?php }?>
            </form>
        </div>
    <?php }} ?>
    <script src="assets/js/offline.js"></script>
<?php include 'footer.php'; ?>