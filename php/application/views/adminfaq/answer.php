<div id="content-body-wrapper">
    <div id="content-body">
        <div id="question-header">
            <h1 itemprop="name">
                <?php echo $question->title ?>
            </h1>

        </div>

        <div itemprop="description" class="post-text">
            <?php echo $question->content ?>
        </div>
        <div id="answers">
            <div class="subheader answers-subheader">
                <h2>
                    Answer
                </h2>

            </div>
            <div class="post-text">
                <form action="" method="post">
                    <table class="datatable">
                        <tbody>

                            <tr>
                                <td>
                                    <textarea name="answer_content" id="answer_content"><?php echo!empty($answer[0]->answer_content) ? $answer[0]->answer_content : '' ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="button" type="submit" value="Answer"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
       
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]

    });

</script>