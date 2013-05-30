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
        </div>
        <div style="">
            <div class="flr">
                <?php $search = $this->input->get('search') ?>
                <form action="">
                    <div style="float:left;padding-right:6px" class="ui-widget">
                        Type: &nbsp;
                        <select id="datalist-filter-type" name="search">
                            <option value="">-- Select All --</option>
                            <option value="register" <?php echo ($search == 'register')?'selected':'' ?>>register</option>
                            <option value="refere" <?php echo ($search == 'refere')?'selected':'' ?>>refere</option>
                            <option value="deposit" <?php echo ($search == 'deposit')?'selected':'' ?>>deposit</option>
                            <option value="bonus" <?php echo ($search == 'bonus')?'selected':'' ?>>bonus</option>
                        </select>
                    </div>
                    <input type="submit" value="Search" class="button" id="Search">
                </form>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="datalist">
            <div id="datalist-renderarea">
                <table>
                    <tbody>
                        <tr class="heading">
                            <td style="width:140px"><div>Acount number</div></td>
                            <td style="width:80px"><div>Fee</div></td>
                            <td style="width:80px"><div>Total</div></td>
                            <td style="width:80px"><div>Type</div></td>
                            <td style="width:80px"><div>Source</div></td>
                            <td style="width:80px"><div>Status</div></td>
                            <td style="width:120px"><div>Date</div></td>
                        </tr>
                        <?php if ($transfers) { ?>
                            <?php foreach ($transfers as $history) { ?>
                                <tr class="row">
                                    <td><div><?php echo $history['username']; ?></div></td>
                                    <td style="text-align: right"><div><?php echo number_format($history['fees'], 2, '.', ','); ?></div></td>
                                    <td style="text-align: right"><div><?php echo number_format($history['total'], 2, '.', ','); ?></div></td>
                                    <td><div><?php echo $history['transaction_type']; ?></div></td>
                                    <td><div><?php echo $history['transaction_source']; ?></div></td>
                                    <td><div><?php echo $history['payment_status']; ?></div></td>
                                    <td><div><?php echo $history['created']; ?></div></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="pagination"><?php echo $links; ?></div>
            </div>
        </div>
    </div>