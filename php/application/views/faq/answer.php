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
                <?php echo!empty($answer[0]->answer_content) ? $answer[0]->answer_content : '' ?>
            </div>
        </div>
    </div>
</div>