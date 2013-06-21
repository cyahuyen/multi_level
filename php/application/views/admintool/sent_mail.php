<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>Sent Mail</h1>
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
                <td>User</td>
                <td>
                    <input type="text" style="width:240px" class="mandatory" value="" name="user" id="user">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="user_list">

                    </div>
                </td>
            </tr>

            <tr>
                <td>Subject</td>
                <td>
                    <input type="text" style="width:240px" class="mandatory" value="" name="subject" id="subject"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                </td>
            </tr>

            <tr>
                <td>Content</td>
                <td>
                    <textarea   name="content"></textarea>
                </td>
            </tr>
            <tr>
                <td>Slug</td>
                <td>
                    {{fullname}} : User Fullname
                </td>
            </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        // General options
        mode: "textareas",
        width: "500",
        height: "300"
	
    });
    
    $(document).ready(function() {
        
        $("#user").autocomplete({
            delay: 100,
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('admintool/user_ajax?term=') ?>" + request.term,
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item, key) {
                            return {
                                label: item,
                                value: key
                            }
                        }));
                        return false
                    }
                });
            },
            select: function(event, ui) {
            
                
                var html = '<div class="user_mng" id="user_' + ui.item.value+ '">';
                html += '<input type="hidden" name="user_list[]" value="'+ui.item.value+'">';
                html += '<span class="user_elm">'+ui.item.value+'</span>';
                html += '<img src="<?php echo base_url() ?>/img/actions/deactivate.png" width="16" class="user_remove"/>'
                html += '</div>';
                $('.user_list').append(html);
            },
            focus: function(event, ui) {
                return false;
            }
        });
        
        $('.user_remove').live('click',function(){
            $(this).parent().remove();
        })
    });
</script>