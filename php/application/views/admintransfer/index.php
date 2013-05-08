<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<div class="content">
    <div class="content-header">
        <div class="content-title">
            <h1>History Transaction</h1>
        </div>
    </div>
    <div class="content-body">
        <div class="datalist">
            <div id="datalist-renderarea">
                <table>
                    <tbody>
                        <tr class="heading">
                            <td style="width:40px"><div>UserName</div></td>
                            <td style="width:140px"><div>Fees</div></td>
                            <td style="width:120px"><div>Total</div></td>
                            <td style="width:80px"><div>Payment Type</div></td>
                            <td style="width:80px"><div>Source</div></td>
                            <td style="width:80px"><div>Status</div></td>
                            <td style="width:120px"><div>Created Date</div></td>
                        </tr>
                        <?php if ($transfers) { ?>
                            <?php foreach ($transfers as $history) { ?>
                                <tr class="row">
                                    <td><div><?php echo $history['fullname']; ?></div></td>
                                    <td><div><?php echo $history['fees']; ?></div></td>
                                    <td><div><?php echo $history['total']; ?></div></td>
                                    <td><div><?php echo $history['transaction_type']; ?></div></td>
                                    <td><div><?php echo $history['transaction_source']; ?></div></td>
                                    <td><div><?php echo $history['payment_status']; ?></div></td>
                                    <td><div><?php echo $history['created']; ?></div></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</div>