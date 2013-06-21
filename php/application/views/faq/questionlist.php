<table id="userdata">
    <thead>
        <tr class="heading">
            <td style="width:300px"><div>Question</div></td>
            <td style="width:300px"><div>Content</div></td>
            <td style="width:80px"><div>User</div></td>
            <td style="width:50px"><div>Status</div></td>
            <td style="width:50px"><div>Action</div></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question) { ?>
            <tr class="row" id="row_<?php echo $question->user_id; ?>"> 
                <td ><div><?php echo $question->title; ?></div></td>
                <td ><div><?php echo utf8_substr(strip_tags($question->content), 0, 100) ?> ...</div></td>
                <td ><div><?php echo $question->firstname . ' ' . $question->lastname; ?></div></td>
                <td ><div><?php echo ($question->admin_status == 0) ? 'Unanswered' : 'Answered' ?></div></td>
                <td >
                    <a href="<?php echo site_url('adminfaq/answer/' . $question->id) ?>">Answer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
