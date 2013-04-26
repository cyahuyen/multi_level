
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
            url:"<?php echo site_url('product/productlist') ?>/"+page,
            success: function(data){
                var obj = jQuery.parseJSON(data);                                      
                $('#datalist-renderarea').html(obj.products);
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
        $('#datalist-sort-order').live('change', function() { 
            search()
        });
        $('#datalist-sort-asc').live('click', function() { 
            search()
        });
        
        $('.deactive').live('click',function(){
            var cf = confirm('Confirm request to de-activate product for use?');
            if(!cf)
                return false;
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({  
                type:"post",
                data:{id:id},
                url:"<?php echo site_url('staff/deactive') ?>",
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
            <h1>
                Manage Products
            </h1>
        </div>
        <?php if (($user[0]->usertype == 'StaffManager')) { ?>
            <div class="content-actions">
                <div class="content-actions">
                    <a href="<?php echo site_url('product/profile') ?>" class="button">Add Product</a>
                </div>
            </div>
        <?php } ?>
    </div>

</div>

<div id="content-body-wrapper">
    <div id="content-body">
        <div class="datalist">

            <div class="datalist-filter">
                <div class="datalist-search">
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" title="Search" src="<?php echo base_url() ?>/img/datalist/search-icon.png"></div>
                    <div style="float:left;padding-right:6px">
                        <input type="text" style="width:200px" placeholder="Search..." id="tags" class="searchresults">
                    </div>
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" title="Filter" src="<?php echo base_url() ?>/img/datalist/filter-icon.png"></div>
                    <div style="float:left;padding-right:6px">
                        <select id="datalist-filter-type">
                            <option value="all">Show both active and inactive products</option>
                            <option selected="selected" value="1">Active products only</option>
                            <option value="0">Inactive products only</option>
                        </select>
                    </div>
                </div>
                <div class="datalist-sort">
                    <span>Order by<span style="padding:4px">
                            <select id="datalist-sort-order">
                                <option selected="selected" value="title">Name</option>
                                <option value="code">Product Code</option>
                            </select>
                            <span>
                                <input type="checkbox" checked="checked" id="datalist-sort-asc"><label style="padding-left:4px" for="datalist-sort-asc">ascending</label>						
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
