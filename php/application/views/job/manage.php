
<script type="text/javascript">
    function isEmpty(str) {
        return (!str || 0 === str.length);
    }
    function search(page) {
        var search = $('#tags').val();           
        var sort = $('#datalist-sort-order').val();
        var asc = $('#datalist-sort-asc:checked').val();
        var status = $('#datalist-filter-type').val(); 
        if(isEmpty(page)){
            var page = 0;
        }
        $.ajax({  
            type:"post",
            data: {searchby: search,sort:sort,asc:asc,page:page,status:status},
            url:"<?php echo site_url('job/joblist') ?>/"+page,
            success: function(data){
                var obj = jQuery.parseJSON(data);                                      
                $('#datalist-renderarea').html(obj.jobs);
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
        
        $('.deactivate').live('click',function(){
            var cf = confirm('Confirm request to close job?');
            if(!cf)
                return false;
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({  
                type:"post",
                data:{id:id},
                url:"<?php echo site_url('job/deactive') ?>",
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
            <h1>Manage Jobs</h1>
        </div>
        <?php if (in_array($user[0]->usertype, array('StaffManager'))){ ?>
        <div class="content-actions">
            <div class="content-actions">
                <div class="content-actions">
                    <a href="<?php echo site_url('job/profile') ?>" class="button">Add Job</a>
                </div>
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
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img src="<?php echo base_url(); ?>img/search-icon.png" style="width:16px;height:16px"/></div>
                    <div style="float:left;padding-right:6px" class="ui-widget">
                        <input type="text" class="searchresults" id="tags" placeholder="Search..." style="width:200px"/>
                    </div>
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" title="Filter" src="<?php echo base_url() ?>/img/datalist/filter-icon.png"></div>
                    <div style="float:left;padding-right:6px">
                        <select id="datalist-filter-type">
                            <option value="all">Show both open and closed jobs</option>
                            <option selected="selected" value="open">Open jobs only</option>
                            <option value="closed">Closed jobs only</option>
                        </select>
                    </div>
                </div>

                <div class="datalist-sort">
                    <span>Order by<span style="padding:4px">
                            <select id="datalist-sort-order">
                                <option value="created_date">Created date</option>
                                <option value="customer">Customer</option>
                                <option value="days">Days</option>
                                <option value="id">Job Id</option>
                                <option value="title">Job title</option>
                                <option value="locaiton">Location</option>
                                <option value="start_date">Start date</option>
                            </select>
                            <span>
                                <input type="checkbox" id="datalist-sort-asc"><label style="padding-left:4px" for="datalist-sort-asc">ascending</label>						
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
