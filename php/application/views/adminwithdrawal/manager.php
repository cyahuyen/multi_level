
<script type="text/javascript">
    function isEmpty(str) {
        return (!str || 0 === str.length);
    }
    function search(page) {
        var search = $('#tags').val();
        var sort = $('#datalist-sort-order').val();
        var payment_status = $('#datalist-filter-type').val();
        var asc = $('#datalist-sort-asc:checked').val();

        if (isEmpty(page)) {
            var page = "<?php echo site_url('adminwithdrawal/withdrawallist') ?>";
        }
        $.ajax({
            type: "post",
            data: {searchby: search, sort: sort, asc: asc, page: page,  payment_status:payment_status},
            url: page,
            success: function(data) {
                var obj = jQuery.parseJSON(data);
                $('#datalist-renderarea').html(obj.wallists);
                $(".datalist-navigation").html(obj.links);

                $(".datalist-navigation").show();


                ;
            }
        });
    }

    $('.nav-page a,.nav-button a').live('click', function() {
        search($(this).attr('href'));
        return false;
    })


    $(document).ready(function() {
        search();
        $("#tags").live('keyup', function() {
            search()
        });
        $('#datalist-filter-type').live('change', function() {
            search()
        });
        $('.deactive').live('click', function() {
            var cf = confirm('Confirm request to de-activate email?');
            if (!cf)
                return false;
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({
                type: "post",
                data: {id: id},
                url: "<?php echo site_url('adminemail/deactive') ?>",
                success: function(data) {
                    search();
                    showmessage('info', 'User de-activated', 'The email has now been de-activated')
                }
            });
        })
        $('.active').live('click', function() {
            var cf = confirm('Confirm request to re-activate email?');
            if (!cf)
                return false;
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({
                type: "post",
                data: {id: id},
                url: "<?php echo site_url('adminemail/active') ?>",
                success: function(data) {
                    search();
                    showmessage('info', 'User re-activated', 'The email has now been re-activated')
                }
            });
        })
    });
</script>
<div id="content-header">
    <div class="content-header">
        <div class="content-title">
            <h1>Manage Withdrawal</h1>
        </div>
    </div>
</div>

<div id="content-body-wrapper">
    <div id="content-body">
        <div class="datalist">

            <div class="datalist-filter">
                <div class="datalist-search">
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img src="<?php echo base_url(); ?>img/search-icon.png" style="width:16px;height:16px"/></div>
                    <div style="float:left;padding-right:6px" class="ui-widget">
                        <input type="text" class="searchresults" id="tags" placeholder="Search..." style="width:200px" value="<?php echo (!empty($emaillist['searchby'])) ? $emaillist['searchby'] : '' ?>"/>
                    </div>
                    <div style="float:left;padding-right:6px">
                        <select id="datalist-filter-type">
                            <option value="all">All Withdrawal Request</option>
                            <option selected="" value="0">Processing</option>
                            <option value="1">Paid</option>
                            <option value="2">Canceled</option>
                        </select>
                    </div>
                </div>
                <div class="datalist-sort">
                    <span>Order by<span style="padding:4px">
                            <select id="datalist-sort-order"  onchange="search()"> 
                                <option value="user.acount_number">Account number</option>
                                <option value="payment_history.created">Created</option>
                            </select>
                            <span>
                                <input type="checkbox" id="datalist-sort-asc" value="1" onchange="search()" <?php echo (!empty($emaillist['asc'])) ? 'checked' : '' ?>><label for="datalist-sort-asc" style="padding-left:4px">ascending</label>						
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
