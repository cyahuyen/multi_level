
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
            data: {searchby: search,sort:sort,asc:asc,page:page,status:status,staff_id:'<?php echo $staff_id ?>'},
            url:"<?php echo site_url('staff/historylist') ?>/"+page,
            success: function(data){
                var obj = jQuery.parseJSON(data);                                      
                $('#datalist-renderarea').html(obj.staffs);
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
            var cf = confirm('Confirm request to unassign from job?');
            if(!cf)
                return false;
            var id = $(this).attr('rel');
            var e = $(this);
            $.ajax({  
                type:"post",
                data:{id:id},
                url:"<?php echo site_url('staff/history_deactive') ?>",
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
                Staff Member
            </h1>
        </div>

    </div>

</div>

<div id="content-body-wrapper">
    <div id="content-body">
        <div class="tabset">
            <table class="tabs">
                <tbody><tr>
                        <td width="11%" class="tabx" id="" onclick="window.location = '<?php echo site_url('staff/profile/'.$staff_id) ?>';return false;">Profile</td>
                        <td width="11%" class="tabx selected" id="jobs">Job History</td>
                        <td width="100%"></td>
                    </tr>
                </tbody></table>
        </div>
        <div class="datalist">

            <div class="datalist-filter">
                <div class="datalist-search">
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" title="Search" src="<?php echo base_url() ?>img/datalist/search-icon.png"></div>
                    <div style="float:left;padding-right:6px">
                        <input type="text" style="width:200px" placeholder="Search..." id="tags" class="searchresults">
                    </div>
                    <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" title="Filter" src="<?php echo base_url() ?>img/datalist/filter-icon.png"></div>
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
                                <option value="job.created_date">Created date</option>
                                <option value="job.customer">Customer</option>
                                <option value="job.days">Days</option>
                                <option value="job.id">Job Id</option>
                                <option value="job.title">Job title</option>
                                <option value="job.locaiton">Location</option>
                                <option value="job.start">Start date</option>
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
