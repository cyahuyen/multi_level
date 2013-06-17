<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Referal/Commission Configuration</h1>
        </div>

    </div>
    <br><br>
    <div class="tabset">
        <table class="tabs">
            <tbody><tr>
                    <td width="100%"></td>
                </tr>
            </tbody></table>
    </div>
    <table class="datatable">
        <tbody>

            <tr>
                <td>Profit percentage of Silver</td>
                <td>
                    <input type="text" id="percentage_silver" class="" name="percentage_silver" value="<?php echo!empty($data_configs['percentage_silver']) ? $data_configs['percentage_silver'] : '' ?>" class="" style="width:240px">% (When an additional deposit is made to the silver account)
                </td>
            </tr>
            <tr>
                <td>Profit percentage of Gold</td>
                <td>
                    <input type="text" id="percentage_gold" class="" name="percentage_gold" value="<?php echo!empty($data_configs['percentage_gold']) ? $data_configs['percentage_gold'] : '' ?>" class="" style="width:240px">% (When an additional deposit is made to the gold account)

                </td>
            </tr>
            <tr>
                <td>Interest rate  of Silver</td>
                <td>
                    <input type="text" id="bonus_percentage_silver" class="" name="bonus_percentage_silver" value="<?php echo!empty($data_configs['bonus_percentage_silver']) ? $data_configs['bonus_percentage_silver'] : '' ?>" class="" style="width:240px">% 
                </td>
            </tr>
            <tr>
                <td>Interest rate  of Gold</td>
                <td>
                    <input type="text" id="bonus_percentage_gold" class="" name="bonus_percentage_gold" value="<?php echo!empty($data_configs['bonus_percentage_gold']) ? $data_configs['bonus_percentage_gold'] : '' ?>" class="" style="width:240px">%

                </td>
            </tr>
            <tr>
                <td>Referral fee for Gold</td>
                <td>
                    <input type="text" id="gold_fees" class="" name="gold_fees" value="<?php echo!empty($data_configs['gold_fees']) ? $data_configs['gold_fees'] : '' ?>" style="width:240px">$
                </td>
            </tr>
            <tr>
                <td>Referral fee for Silver</td>
                <td>
                    <input type="text" id="silver_fees" class="" name="silver_fees" value="<?php echo!empty($data_configs['silver_fees']) ? $data_configs['silver_fees'] : '' ?>" style="width:240px">$
                </td>
            </tr>

            <tr>
                <td></td>
                <td><div class="">
                        <input type="submit" value="Save" class="button" name="save-btn" id="save-btn">
                        <a class="button checkdirty" href="<?php echo site_url('adminconfig') ?>">Cancel</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>