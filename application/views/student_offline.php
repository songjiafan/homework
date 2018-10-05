<?php include 'header.php'; ?>
    <table class="am-table">
        <thead>
        <tr>
            <th>套题id</th>
            <th>文件名</th>
            <th>批语</th>
            <th>教师</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($list) { foreach ($list as $item) {?>
            <tr>
                <td><?php echo $item->id?></td>
                <td><?php echo $item->filename?></td>
                <td><?php echo $item->forum?></td>
                <td><?php echo $item->teacher_name?></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>
    <script src="assets/js/offline.js"></script>
<?php include 'footer.php'; ?>