<div id="content-body-wrapper">
    <div id="content-body">
        <form action="" method="post">
            <div class="content-header">
                <div class="content-title">
                    <h1>Add/Edit Questions</h1>
                </div>
            </div>
            <br><br>
            <table class="datatable">
                <tbody>

                    <tr>
                        <td>Question</td>
                        <td>
                            <input type="text" style="width:240px" class="mandatory" value="<?php echo!empty($question->title) ? $question->title : '' ?>" name="title" id="title"><img class="mandatory" src="http://multilevel.lc//img/sev/required.jpg" title="This is a required value">
                        </td>
                    </tr>

                    <tr>
                        <td>Content</td>
                        <td>
                            <textarea name="content" id="content"><?php echo!empty($question->content) ? $question->content : '' ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="button" type="submit" value="Question"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <br><br>
        <div class="content-header">
            <div class="content-title">
                <h1>Questions</h1>
            </div>
        </div>
        <br><br>
        <ul class="questions">

        </ul>

        <div class="clb"></div>

        <div class="datalist-navigation" >

        </div>
        <div class="clb"></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        // General options
        mode: "textareas",
        width: "300",
        height: "200"
	
    });
    
    $(document).ready(function(){
        load_question();                    
    })
    
    function load_question(page){
        if(page == undefined){
            page= 0;
        }
        $.ajax({
            url: "<?php echo site_url('faq/list_question') ?>/"+page,
            dataType: 'json',
            type: "post",
            success: function(json) {
                console.debug(json.question);
                $('.questions').html(json.questions)
                $(".datalist-navigation").html(json.links);
            }
        });
    }
</script>