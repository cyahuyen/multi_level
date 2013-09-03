<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<div class="content">
    <div class="content-header">

        <div class="content-title">
            <h1>Transaction History</h1>
            <?php if(!empty($user)){ ?>
            <p>(Transaction History of user: <?php echo $user->username ?> )</p>
            <?php } ?>
        </div>


    </div>
    <div class="content-body">
        <div class="datalist">
            <div class="datalist-filter">
                <div class="datalist-search">
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" src="http://multilevel.lc/img/search-icon.png"></div>
                    <div class="ui-widget" style="float:left;padding-right:6px">
                        <input type="text" value="" style="width:200px" placeholder="Search..." id="tags" class="searchresults">
                    </div>
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img src="http://multilevel.lc//img/datalist/filter-icon.png" title="Filter" style="width:16px;height:16px"></div>
                    <div style="float:left;padding-right:6px">
                        <select id="datalist-filter-type" >
                            <option value="">-- Select All --</option>
                            <option value="register">register</option>
                            <option value="refere" >refere</option>
                            <option value="deposit" >deposit</option>
                            <option value="bonus" >bonus</option>
                            <option value="withdrawal" >withdrawal</option>
                        </select>
                    </div>

                </div>
                <div class="datalist-sort">
                    <span>Order by<span style="padding:50px">
                            <select onchange="search()" id="datalist-sort-order"> 
                                <option value="user.acount_number">Acount Number</option>
                                <option value="transaction.created">Date</option>
                            </select>
                            <span>
                                <input type="checkbox" onchange="search()" value="1" id="datalist-sort-asc"><label style="padding-left:4px" for="datalist-sort-asc">ascending</label>						
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


<script type="text/javascript">
    function isEmpty(str) {
        return (!str || 0 === str.length);
    }
    function search(page) {
        var search = $('#tags').val();           
        var type = $('#datalist-filter-type').val();
        var sort = $('#datalist-sort-order').val();
        var asc = $('#datalist-sort-asc:checked').val();
        var user_id = '<?php echo $user_id ?>'
        if(isEmpty(page)){
            var page = '<?php echo admin_url('transfer/listtransfer') ?>';
        }
        $.ajax({  
            type:"post",
            data: {searchby: search,sort:sort,type:type,asc:asc,page:page,user_id:user_id},
            url: page,
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
    $('#datalist-filter-type').live('change',function(){
        search();
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
                url:"<?php echo admin_url('user/deactive') ?>",
                success: function(data){
                    e.parents('tr').remove();
                } 
            }); 
        })
    });
</script>