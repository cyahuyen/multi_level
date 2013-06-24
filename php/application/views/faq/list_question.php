<?php foreach ($questions as $question) { ?>
    <li>
        <h3><?php echo $question->title ?></h3>
        <div class="excerpt">
            <?php if (strlen(strip_tags($question->content)) > 200) { ?>
                <?php echo utf8_substr(strip_tags($question->content), 0, 200) ?> ...
            <?php } else { ?>
                <?php echo strip_tags($question->content) ?>
            <?php } ?>
        </div>
        <div class="edit-question">
            <?php if ($question->admin_status == 0) { ?>
                <a href="#">Waiting answer</a> 
            <?php } else { ?>
                <a href="<?php echo site_url('faq/answer/' . $question->id) ?>">View Answer</a> 
            <?php } ?>
        </div>
        <div class="clb"></div>
    </li>
<?php } ?>