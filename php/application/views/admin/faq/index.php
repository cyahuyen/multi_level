<div id="content-header">
    <div class="content-header">
        <div class="content-title">
            <h1>Manage Faq</h1>
        </div>

    </div>
</div>

<div id="content-body-wrapper">
    <div id="content-body">
        <div class="datalist">

            <div class="datalist-search">
                <div style="float:left">
                    <select id="datalist-type" onchange="search()">
                        <option value="all">All</option>
                        <option value="0" <?php echo (isset($faqlist['admin_status']) && $faqlist['admin_status'] == '0') ? 'selected' : '' ?>>Unanswered</option>
                        <option value="1" <?php echo (isset($faqlist['admin_status']) && $faqlist['admin_status'] == '1') ? 'selected' : '' ?> >Answered</option>
                    </select>
                </div>
            </div>

            <div class="datalist-filter">


                <div class="datalist-sort">
                    <span>Order by
                        <span style="padding:4px">
                            <select id="datalist-sort-order"  onchange="search()"> 
                                <option <?php echo (!empty($faqlist['sort']) && $faqlist['sort'] == 'created') ? 'selected' : '' ?> value="created">Created</option>
                                <option <?php echo (!empty($faqlist['sort']) && $faqlist['sort'] == 'title') ? 'selected' : '' ?> value="title">Title</option>
                            </select>
                            <span>
                                <input type="checkbox" id="datalist-sort-asc" value="1" onchange="search()" <?php echo (!empty($faqlist['asc'])) ? 'checked' : '' ?>><label for="datalist-sort-asc" style="padding-left:4px">ascending</label>						
                            </span>
                        </span>
                    </span>
                </div>
            </div>

            <div id="datalist-renderarea">

            </div>

            <div class="datalist-navigation" >

            </div>


        </div>

    </div>
</div>			


<script type="text/javascript">
    function isEmpty(str) {
        return (!str || 0 === str.length);
    }
    function search(page) {
        var status = $('#datalist-type').val();
        var sort = $('#datalist-sort-order').val();
        var asc = $('#datalist-sort-asc:checked').val();
        if (isEmpty(page)) {
            var page = "<?php echo admin_url('faq/questionlist') ?>";
        }
        
        $.ajax({
            type: "post",
            data: {sort: sort, asc: asc, page: page, status: status},
            url: page,
            dataType: 'json',
            success: function(obj) {
                $('#datalist-renderarea').html(obj.questions);
                $(".datalist-navigation").html(obj.links);

                $(".datalist-navigation").show();

            }
        });
    }

    $('.nav-page a,.nav-button a').live('click', function() {
        search($(this).attr('href'));
        return false;
    })
   
    $(document).ready(function() {
        search();
    });
</script>