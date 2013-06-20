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
                            <input type="text" style="width:240px" class="mandatory" value="" name="question" id="question"><img class="mandatory" src="http://multilevel.lc//img/sev/required.jpg" title="This is a required value">
                        </td>
                    </tr>

                    <tr>
                        <td>Content</td>
                        <td>
                            <textarea name="content" id="content"></textarea>
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
            <li>
                <h3><a href="#" class="question-hyperlink">The Definitive C++ Book Guide and List</a></h3>
                <div class="excerpt">
                    This question attempts to collect the few pearls among the dozens of bad C++ books that are released every year.

                    Unlike many other programming languages, which are often picked up on the go from ...
                </div>
                <div class="edit-question">
                    <a href="/questions/tagged/html">Edit</a>
                    <a href="/questions/tagged/regex">View Answer</a> 
                </div>
            </li>
        </ul>
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
</script>