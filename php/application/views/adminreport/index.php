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
    <strong>Number of new members enrolled: </strong><?php echo!empty($totalUserByMonth) ? $totalUserByMonth : 0 ?><br>
    <strong>Amount paid into Gold accounts : </strong>$<?php echo!empty($totalTransactionGoldWeek) ? $totalTransactionGoldWeek : 0 ?><br>
    <strong>Amount paid into silver accounts: </strong>$<?php echo!empty($totalTransactionSilverWeek) ? $totalTransactionSilverWeek : 0 ?><br>
    <strong>Percentage of increase from previous week: </strong><?php echo $percenter ?>%<br>
    <strong>Amount of referral commission paid: </strong>$<?php echo!empty($totalTransactionRefereWeek) ? $totalTransactionRefereWeek : 0 ?><br>
    <strong>Year to date of all of above: </strong><?php echo '' ?><br>
    <strong>List of referring members with number referred: </strong>
    <?php if (!empty($listUserByWeek)) { ?>
        <div class="datalist">
            <table id="userdata">
                <thead>
                    <tr class="heading">
                        <td style="width:110px"><div>Email</div></td>
                        <td style="width:200px"><div>Full name</div></td>
                        <td style="width:80px"><div>Number Refered</div></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listUserByWeek as $user) { ?>

                        <?php if (!empty($user->referring)) { ?>
                            <?php
                            $user_data = getMainUserByMainId($user->referring);
                            $fullname = $user_data->firstname . ' ' . $user_data->lastname;
                            ?>
                            <tr class="row"> 
                                <td ><div><?php echo $user_data->email; ?></div></td>
                                <td><div><?php echo $fullname; ?></div></td>
                                <td><div><?php echo $user->total_user; ?></div></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
<div class="content-header">
    <div class="content-title">
        <h1>Report By Month</h1>
    </div>

</div>
<div class="user_month">
    <strong>Total monthly new members: </strong><?php echo!empty($totalUserByMonth) ? $totalUserByMonth : 0 ?><br>
    <strong>Total amount paid into Gold accounts: </strong>$<?php echo!empty($totalTransactionGoldMonth) ? $totalTransactionGoldMonth : 0 ?><br>
    <strong>Total amount paid into Silver accounts: </strong>$<?php echo!empty($totalTransactionSilverMonth) ? $totalTransactionSilverMonth : 0 ?><br>
    <strong>Total dividends paid to members: </strong>$<?php echo $totalTransactionAmountMemberMonth            ?><br>
    <strong>Total referral commission paid to referring members: </strong>$<?php echo!empty($totalTransactionRefereMonth) ? $totalTransactionRefereMonth : 0 ?><br>
    <strong>Total commission paid on referred members dividend: </strong><?php // echo $silver_count            ?><br>
</div>
