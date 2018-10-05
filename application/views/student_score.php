<?php include 'header.php'; ?>

    <table class="am-table">
        <thead>
        <tr>
            <th>套题id</th>
            <th>我的选择答案</th>
            <th>客观题得分</th>
            <th>我的主观题答案</th>
            <th>主观题得分</th>
            <th>总分</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($list) { foreach ($list as $item) {?>
            <tr>
                <td><?php echo $item->question_id?></td>
                <td><?php echo $item->select?></td>
                <td><?php echo $item->select_score?></td>
                <td><?php echo $item->subjective?></td>
                <td><?php echo $item->subjective_first_score?>,<?php echo $item->subjective_second_score?></td>
                <td><?php echo $item->subjective_first_score + $item->subjective_second_score + $item->select_score?></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>

    <script src="assets/js/question.js"></script>
<?php include 'footer.php'; ?>