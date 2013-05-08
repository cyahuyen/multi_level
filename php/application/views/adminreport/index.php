<?php
/**
 * Description of index
 *
 * @author ngoalongkt
 */
?>


<div id="content-header">


    <div class="content-header">
        <div class="content-title">
            <h1>Report</h1>
        </div>

    </div>

</div>

<div id="content-body-wrapper">
    <div id="content-body">
        <div class="datalist">

        </div>
    </div>
</div>

<div class="datalist-filter">
    <div class="datalist-search">
        <form action="" method="GET">
        <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img src="<?php echo base_url(); ?>img/search-icon.png" style="width:16px;height:16px"/></div>
        <div style="float:left;padding-right:6px" class="ui-widget">
            <input type="text" class="searchresults" id="start_date" name="start_date" placeholder="Start Date" style="width:200px" value="<?php echo (!empty($search['start_date'])) ? $search['start_date'] : '' ?>"/>
        </div>
        <div style="float:left;padding-top:4px;padding-left:4px;padding-right:8px;"><img style="width:16px;height:16px" title="Filter" src="<?php echo base_url() ?>/img/datalist/filter-icon.png"></div>
        <div style="float:left;padding-right:6px" class="ui-widget">
            <input type="text" class="searchresults" id="end_date" name="end_date" placeholder="End Date" style="width:200px" value="<?php echo (!empty($search['end_date'])) ? $search['end_date'] : '' ?>"/>
        </div>
        <div style="float:left;padding-right:6px" class="ui-widget">
            <input type="submit" class="" id="" value="Search"/>
        </div>
        
        </form>
    </div>
    <script>
        $("#start_date").datepicker({dateFormat: "yy-mm-dd"});
        $("#end_date").datepicker({dateFormat: "yy-mm-dd"});
    </script>
</div>
