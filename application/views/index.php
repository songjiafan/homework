<?php include 'header.php'; ?>
<section id="container">
    <link type="text/css" rel="stylesheet" href="assets/css/date.css">
    <link type="text/css" rel="stylesheet" href="assets/css/index.css">
    <?php echo date("Y-m-d H:m:s")?>
    <section class="img_content">
        <h3>校园风采</h3>
        <div class="am-slider am-slider-default" data-am-flexslider>
            <ul class="am-slides">
                <li><img src="assets/img/bing-1.jpg" /></li>
                <li><img src="assets/img/bing-2.jpg" /></li>
                <li><img src="assets/img/bing-3.jpg" /></li>
                <li><img src="assets/img/bing-4.jpg" /></li>
            </ul>
        </div>
    </section>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
    <div class="am-cf" style="width: 80%">
        <div class="am-fl">
            <div data-am-widget="list_news" class="am-list-news am-list-news-default" style="width: 45%;position: absolute;left: 0">
                <!--列表标题-->
                <div class="am-list-news-hd am-cf">
                    <!--带更多链接-->
                    <h2>作业信息通知</h2>
                </div>

                <div class="am-list-news-bd">
                    <ul class="am-list">
                        <?php if ($list) { foreach ($list as $item) {?>
                            <li class="am-g am-list-item-dated">
                                <a href="<?php if ( empty($item->select_answer)) {echo 'student/offline';} else { echo "student/index";}?>" class="am-list-item-hd ">&nbsp;&nbsp;&nbsp;<?php echo $item->title?> (<?php if ( empty($item->select_answer)) {echo '主观题';} else { echo "客观题";}?>)</a>
                                <span class="am-list-date">截止时间：<?php echo $item->end_time?></span>
                            </li>
                        <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="am-fr">
            <div data-am-widget="list_news" class="am-list-news am-list-news-default" style="width: 45%;position: absolute;right: 0">
                <!--列表标题-->
                <div class="am-list-news-hd am-cf">
                    <!--带更多链接-->
                    <h2>学生能量补给站</h2>
                </div>

                <div class="am-list-news-bd">
                    <ul class="am-list">
                        <?php if($fileList){foreach ($fileList as $item) {?>
                            <li class="am-g am-list-item-dated">
                                <a href="<?php echo 'question/download?filename='.$item->filename ?>"><?php echo $item->filename?></a>
                                <span class="am-list-date">上传时间：<?php echo $item->upload_time?></span>
                                <?php if ($admin) {?>
                                <a class="am-btn am-btn-warning" href="admin/del_file?id=<?php echo $item->id?>">删除</a>
                                <?php }?>
                            </li>
                        <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>



<!--    <section class="date_content" style=" position: relative; position: absolute; left: 100px; top: 500px;">-->
<!--        <h3>日期</h3>-->
<!--        <div class="box">-->
<!--            <section class="date">-->
<!--                <div class="head">-->
<!--                    <div class="prev">上一月</div>-->
<!--                    <div class="tomon"><span class="year"></span>年 <span class="month"></span>月</div>-->
<!--                    <div class="next">下一月</div>-->
<!--                </div>-->
<!--                <ol><li>周日</li><li>周一</li><li>周二</li><li>周三</li><li>周四</li><li>周五</li><li>周六</li></ol>-->
<!--                <ul>-->
<!--                    <li>日期</li><li>日期</li><li>日期</li><li>日期</li><li>日期</li><li>日期</li><li>日期</li>-->
<!--                    <li>日期</li><li>日期</li><li>日期</li><li>日期</li>-->
<!--                </ul>-->
<!--            </section>-->
<!--        </div>-->
<!--    </section>-->
<!--    网上找到日历组件 这里有坑 太依赖浮动定位 amazeui也有点挫 和这个冲突导致位置混乱-->

</section>
    <script type="text/javascript" src="assets/js/date.js"></script>
<?php include 'footer.php'; ?>