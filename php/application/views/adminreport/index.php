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
<div class="user">
    <strong>Current Balance: </strong>$<?php echo number_format($balance->balance, 2, '.', ',') ?><br>
</div>
<div class="datalist-filter">
    <div class="datalist-search">
        <form action="" method="GET">
            <div style="float:left;padding-right:6px" class="ui-widget">
                <input type="text" class="searchresults" id="date" name="date" placeholder="Date" style="width:200px" value="<?php echo (!empty($date)) ? $date : '' ?>"/>
            </div>

        </form>
    </div>
    <script>
        $("#date").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $("#date").change(function(){
        })
    </script>
</div>
<div class="content-header">
    <div class="content-title">
        <h1>Report By Week</h1>
    </div>

</div>
<div class="user_week">
    <strong>Number of new members enrolled: </strong><?php echo $user_count_week ?><br>
    <strong>Amount paid into Gold accounts : </strong><?php echo $gold_count_week ?><br>
    <strong>Amount paid into silver accounts: </strong><?php echo $silver_count_week ?><br>
    <strong>List of referring members with number referred: </strong><?php echo $silver_total_paid_amount_week ?><br>
    <strong>Percentage of increase from previous week: </strong><?php echo '' ?><br>
    <strong>Amount of referral commission paid: </strong><?php echo '' ?><br>
    <strong>Year to date of all of above: </strong><?php echo '' ?><br>
</div>
<div class="content-header">
    <div class="content-title">
        <h1>Report By Month</h1>
    </div>

</div>
<div class="user_month">
    <strong>Total monthly new members: </strong><?php echo $user_count_month ?><br>
    <strong>Total amount paid into Gold accounts: </strong><?php echo gold_count_month ?><br>
    <strong>Total amount paid into Silver accounts: </strong><?php echo $silver_count_month ?><br>
    <strong>Total dividends paid to members: </strong><?php echo $total_dividends_paid_amount ?><br>
    <strong>Total referral commission paid to referring members: </strong><?php echo $member_count ?><br>
    <strong>Total commission paid on referred members dividend: </strong><?php echo $silver_count ?><br>
</div>
