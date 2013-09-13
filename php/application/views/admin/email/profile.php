<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	// General options
        mode: "textareas",
        width: "500",
        height: "300",
        plugins: "link"
	
});
</script>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <?php if (!empty($emaildata->id)) { ?>
                <h1>View/Edit Email</h1>
            <?php } else { ?>
                <h1>Add Email</h1>
            <?php } ?>
        </div>
        <div class="content-actions">
            <input type="submit" value="Save" class="button" name="save-btn" id="save-btn">
            <a class="button checkdirty" href="<?php echo site_url('adminemail/manager') ?>">Cancel</a>
        </div>
    </div>
    <br><br>
    <table class="datatable">
        <tbody>
            
            <tr>
                <td>Code</td>
                <td>
                    <input type="text" style="width:240px" class="mandatory" value="<?php echo!empty($emaildata->code) ? $emaildata->code : '' ?>" name="code" id="code"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>
            

            <tr>
                <td>Subject</td>
                <td>
                    <input type="text" style="width:240px" class="mandatory" value="<?php echo!empty($emaildata->subject) ? $emaildata->subject : '' ?>" name="subject" id="subject"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>
            
            <tr>
                <td>Content</td>
                <td>
                    <textarea   name="content"><?php echo!empty($emaildata->content) ? $emaildata->content : '' ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Slug</td>
                <td>
                    <textarea name="slug"><?php echo!empty($emaildata->slug) ? $emaildata->slug : '' ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
</form>