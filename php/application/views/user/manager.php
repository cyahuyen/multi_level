
<script type="text/javascript">
    function isEmpty(str) {
        return (!str || 0 === str.length);
    }
    function search(page) {
        var search = $('#tags').val();           
        var sort = $('#datalist-sort-order').val();
        var asc = $('#datalist-sort-asc:checked').val();
        
        if(isEmpty(page)){
            var page = 0;
        }
        $.ajax({  
            type:"post",
            data: {searchby: search,sort:sort,asc:asc,page:page},
            url:"<?php echo site_url('user/userlist') ?>/"+page,
            success: function(data){
                var obj = jQuery.parseJSON(data);                                      
                $('#datalist-renderarea').html(obj.users);
                $(".datalist-navigation").html(obj.links);  
                     
                $(".datalist-navigation").show();
                    
                    
                ;
            } 
        }); 
    }
    
    $('.nav-page a,.nav-button a').live('click',function(){
        search($(this).attr('href'));
        return false;
    })
    
        
    $(document).ready(function(){
        search();
        $("#tags").live('keyup', function() { 
            search()
        });
        
        $('.activatedeactivate').live('click',function(){
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({  
                type:"post",
                data:{id:id},
                url:"<?php echo site_url('user/deactive') ?>",
                success: function(data){
                    e.parents('tr').remove();
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
                        <input type="text" class="searchresults" id="tags" placeholder="Search..." style="width:200px"/>
                    </div>
                </div>
                <div class="datalist-sort">
                    <span>Order by<span style="padding:4px">
                            <select id="datalist-sort-order"  onchange="search()"> 
                                <option value="user_data.fullname">Person name</option>
                                <option value="user.email">Email</option>
                                <option  value="user.usertype">User type</option>
                            </select>
                            <span>
                                <input type="checkbox" id="datalist-sort-asc" value="1" onchange="search()"><label for="datalist-sort-asc" style="padding-left:4px">ascending</label>						
                            </span>
                        </span></span>
                </div>
            </div>

            <div id="datalist-renderarea">

            </div>

            <div class="datalist-navigation" >
                <?php echo $links ?>
            </div>


        </div>

    </div>
</div>			
