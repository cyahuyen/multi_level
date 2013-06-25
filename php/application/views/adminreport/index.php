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
                <input type="submit" value="Search" class="button"/> 
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


<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Week</a></li>
        <li><a href="#tabs-2">Month</a></li>
    </ul>
    <div id="tabs-1">
        <h2> From <?php echo $date_week[0] .' TO '. $date_week[1]; ?></h2>
        <div class="toogger">
            <a href="javascript:void(0)"><strong>Number of new members enrolled: </strong><?php echo!empty($totalUserByWeek) ? $totalUserByWeek : 0 ?><br></a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Email</div></td>
                                <td style="width:200px"><div>Full name</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listAllUserByWeek as $user) { ?>

                                <tr class="row"> 
                                    <td ><div><?php echo $user->email; ?></div></td>
                                    <td><div><?php echo $user->firstname . ' ' . $user->lastname; ?></div></td>
                                    <td><div><?php echo $user->created_on; ?></div></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Amount paid into Gold accounts : </strong>$<?php echo!empty($totalTransactionGoldWeek) ? $totalTransactionGoldWeek : 0 ?><br>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Acount Number</div></td>
                                <td style="width:200px"><div>Fees</div></td>
                                <td style="width:80px"><div>Total</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTransactionGoldWeek as $transaction) { ?>

                                <?php if (!empty($user->referring)) { ?>

                                    <tr class="row"> 
                                        <td ><div><?php echo $transaction->acount_number; ?></div></td>
                                        <td><div>$<?php echo $transaction->fees ?></div></td>
                                        <td><div>$<?php echo $transaction->total; ?></div></td>
                                        <td><div><?php echo $transaction->created; ?></div></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Amount paid into silver accounts: </strong>$<?php echo!empty($totalTransactionSilverWeek) ? $totalTransactionSilverWeek : 0 ?><br>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Acount Number</div></td>
                                <td style="width:200px"><div>Fees</div></td>
                                <td style="width:80px"><div>Total</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTransactionSilverWeek as $transaction) { ?>

                                <?php if (!empty($user->referring)) { ?>

                                    <tr class="row"> 
                                        <td ><div><?php echo $transaction->acount_number; ?></div></td>
                                        <td><div>$<?php echo $transaction->fees ?></div></td>
                                        <td><div>$<?php echo $transaction->total; ?></div></td>
                                        <td><div><?php echo $transaction->created; ?></div></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Percentage of increase from previous week: </strong><?php echo $percenter ?>%<br>
            </a>
            <div class="description">
                Amount paid into currentweek: $<?php echo!empty($totalTransactionAmountMemberWeek) ? $totalTransactionAmountMemberWeek : 0 ?><br>
                Amount paid into previous week: $<?php echo!empty($totalTransactionAmountMemberLastWeek) ? $totalTransactionAmountMemberLastWeek : 0 ?><br>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Amount of referral commission paid: </strong>$<?php echo!empty($totalTransactionRefereWeek) ? $totalTransactionRefereWeek : 0 ?><br>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Acount Number</div></td>
                                <td style="width:200px"><div>Fees</div></td>
                                <td style="width:80px"><div>Total</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTransactionRefereWeek as $transaction) { ?>

                                <?php if (!empty($user->referring)) { ?>

                                    <tr class="row"> 
                                        <td ><div><?php echo $transaction->acount_number; ?></div></td>
                                        <td><div>$<?php echo $transaction->fees ?></div></td>
                                        <td><div>$<?php echo $transaction->total; ?></div></td>
                                        <td><div><?php echo $transaction->created; ?></div></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>List of referring members with number referred: </strong>
            </a>


        </div>
        <?php if (!empty($listAllUserByMonth)) { ?>
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
    <div id="tabs-2">
         <h2> From <?php echo $date_month[0] .' TO '. $date_month[1]; ?></h2>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Total monthly new members: </strong><?php echo!empty($totalUserByMonth) ? $totalUserByMonth : 0 ?><br>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Email</div></td>
                                <td style="width:200px"><div>Full name</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listAllUserByMonth as $user) { ?>
                                <tr class="row"> 
                                    <td ><div><?php echo $user->email; ?></div></td>
                                    <td><div><?php echo $user->firstname . ' ' . $user->lastname; ?></div></td>
                                    <td><div><?php echo $user->created_on; ?></div></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Total amount paid into Gold accounts: </strong>$<?php echo!empty($totalTransactionGoldMonth) ? $totalTransactionGoldMonth : 0 ?><br>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Acount Number</div></td>
                                <td style="width:200px"><div>Fees</div></td>
                                <td style="width:80px"><div>Total</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTransactionGoldMonth as $transaction) { ?>

                                <?php if (!empty($user->referring)) { ?>

                                    <tr class="row"> 
                                        <td ><div><?php echo $transaction->acount_number; ?></div></td>
                                        <td><div>$<?php echo $transaction->fees ?></div></td>
                                        <td><div>$<?php echo $transaction->total; ?></div></td>
                                        <td><div><?php echo $transaction->created; ?></div></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Total amount paid into Silver accounts: </strong>$<?php echo!empty($totalTransactionSilverMonth) ? $totalTransactionSilverMonth : 0 ?><br>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Acount Number</div></td>
                                <td style="width:200px"><div>Fees</div></td>
                                <td style="width:80px"><div>Total</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTransactionSilverMonth as $transaction) { ?>

                                <?php if (!empty($user->referring)) { ?>

                                    <tr class="row"> 
                                        <td ><div><?php echo $transaction->acount_number; ?></div></td>
                                        <td><div>$<?php echo $transaction->fees ?></div></td>
                                        <td><div>$<?php echo $transaction->total; ?></div></td>
                                        <td><div><?php echo $transaction->created; ?></div></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Total dividends paid to members: </strong>$<?php echo $totalTransactionAmountMemberMonth ?><br>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Acount Number</div></td>
                                <td style="width:200px"><div>Fees</div></td>
                                <td style="width:80px"><div>Total</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTransactionAmountMemberMonth as $transaction) { ?>

                                <?php if (!empty($user->referring)) { ?>

                                    <tr class="row"> 
                                        <td ><div><?php echo $transaction->acount_number; ?></div></td>
                                        <td><div>$<?php echo $transaction->fees ?></div></td>
                                        <td><div>$<?php echo $transaction->total; ?></div></td>
                                        <td><div><?php echo $transaction->created; ?></div></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Total referral commission paid to referring members: </strong>$<?php echo!empty($totalTransactionRefereMonth) ? $totalTransactionRefereMonth : 0 ?>
            </a>
            <div class="description">
                <div class="datalist">
                    <table id="userdata">
                        <thead>
                            <tr class="heading">
                                <td style="width:110px"><div>Acount Number</div></td>
                                <td style="width:200px"><div>Fees</div></td>
                                <td style="width:80px"><div>Total</div></td>
                                <td style="width:80px"><div>Created</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTransactionRefereMonth as $transaction) { ?>

                                <?php if (!empty($user->referring)) { ?>

                                    <tr class="row"> 
                                        <td ><div><?php echo $transaction->acount_number; ?></div></td>
                                        <td><div>$<?php echo $transaction->fees ?></div></td>
                                        <td><div>$<?php echo $transaction->total; ?></div></td>
                                        <td><div><?php echo $transaction->created; ?></div></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="toogger">
            <a href="javascript:void(0)">
                <strong>Total commission paid on referred members dividend: </strong><?php // echo $silver_count                                    ?><br>
                <div class="description">

                </div>
        </div>
    </div>

</div>

<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
    $(document).ready(function(){
        $('.toogger a').live('click',function(){
            $(this).parent().children('.description').toggle('slow');
        })
    })
</script>