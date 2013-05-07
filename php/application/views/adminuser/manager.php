
<script type="text/javascript">
    function isEmpty(str) {
        return (!str || 0 === str.length);
    }
    function search(page) {
        var search = $('#tags').val(); 
        var status = $('#datalist-filter-type').val();
        var sort = $('#datalist-sort-order').val();
        var asc = $('#datalist-sort-asc:checked').val();
        
        if(isEmpty(page)){
            var page = 0;
        }
        $.ajax({  
            type:"post",
            data: {searchby: search,sort:sort,asc:asc,page:page,status:status},
            url:"<?php echo site_url('adminuser/userlist') ?>/"+page,
            success: function(data){
                var obj = jQuery.parseJSON(data);                                      
                $('#datalist-renderarea').html(obj.users);
                $(".datalist-navigation").html(obj.links);  
                     
                $(".datalist-navigation").show();
                    
                    
                ;
            } 
        }); 
    }
    
    $('.nav-page a').live('click',function(){
        search($(this).text());
        return false;
    })
    
        
    $(document).ready(function(){
        search();
        $("#tags").live('keyup', function() { 
            search()
        });
        $('#datalist-filter-type').live('change', function() { 
            search()
        });
//        $('.activatedeactivate').live('click',function(){
//            var id = $(this).attr('rel');
//            var e = $(this);
//            $.ajax({  
//                type:"post",
//                data:{id:id},
//                url:"<?php echo site_url('user/deactive') ?>",
//                success: function(data){
//                    e.parents('tr').remove();
//                } 
//            }); 
//        })
        $('.deactive').live('click',function(){
            var cf = confirm('Confirm request to de-activate user?');
            if(!cf)
                return false;
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({  
                type:"post",
                data:{id:id},
                url:"<?php echo site_url('adminuser/deactive') ?>",
                success: function(data){
                    search();
                    showmessage('info', 'User de-activated', 'The user has now been de-activated')
                } 
            }); 
        })
        $('.active').live('click',function(){
            var cf = confirm('Confirm request to re-activate user?');
            if(!cf)
                return false;
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({  
                type:"post",
                data:{id:id},
                url:"<?php echo site_url('user/active') ?>",
                success: function(data){
                    search();
                    showmessage('info', 'User re-activated', 'The user has now been re-activated')
                } 
            }); 
        })
    });
</script>
<div id="content-header">


    <div class="content-header">
        <div class="content-title">
            <h1>Manage Users</h1>
        </div>
        <div class="content-actions">
            <div class="content-action">
                <div class="clear"><a onclick="window.location='<?php echo site_url('/user/profile'); ?>'" href="javascript:void(0);"><img alt="Save Continue" src="<?php echo base_url(); ?>img/actions/add.png"></a></div>
                <div class="clear"><span>Add</span></div>
            </div>
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
                        <input type="text" class="searchresults" id="tags" placeholder="Search..." style="width:200px" value="<?php echo (!empty($userlist['searchby']))?$userlist['searchby']:'' ?>"/>
                    </div>
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" title="Filter" src="<?php echo base_url() ?>/img/datalist/filter-icon.png"></div>
                    <div style="float:left;padding-right:6px">
                        <select id="datalist-filter-type">
                            <option value="all" <?php echo (!empty($userlist['status']) && $userlist['status'] == 'all')?'selected':'' ?>>Show both active and inactive users</option>
                            <option <?php echo (!isset($userlist['status']) || $userlist['status'] == '1')?'selected':'' ?> value="1">Active users only</option>
                            <option value="0" <?php echo (empty($userlist['status']))?'selected':'' ?>>Inactive users only</option>
                        </select>
                    </div>
                </div>
                <div class="datalist-sort">
                    <span>Order by<span style="padding:4px">
                            <select id="datalist-sort-order"  onchange="search()"> 
                                <option <?php echo (!empty($userlist['sort']) && $userlist['sort'] == 'fullname')?'selected':'' ?> value="fullname">Person name</option>
                                <option <?php echo (!empty($userlist['sort']) && $userlist['sort'] == 'email')?'selected':'' ?> value="email">Email</option>
                                <option <?php echo (!empty($userlist['sort']) && $userlist['sort'] == 'usertype')?'selected':'' ?>  value="usertype">User type</option>
                            </select>
                            <span>
                                <input type="checkbox" id="datalist-sort-asc" value="1" onchange="search()" <?php echo (!empty($userlist['asc']))?'checked':'' ?>><label for="datalist-sort-asc" style="padding-left:4px">ascending</label>						
                            </span>
                        </span></span>
                </div>
            </div>

            <div id="datalist-renderarea">

            </div>

            <div class="datalist-navigation" >

            </div>


        </div>

    </div>
</div>			
