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
                <td>Profit percentage of Gold</td>
                <td colspan="5">
                    <input type="text" id="percentage_gold" class="" name="percentage_gold" value="<?php echo!empty($data_configs['percentage_gold']) ? $data_configs['percentage_gold'] : '' ?>" class="" style="width:240px">% (When an additional deposit is made to the gold account)

                </td>
            </tr>
            <tr>
                <td>Interest rate  of Silver</td>
                <td colspan="5">
                    <input type="text" id="bonus_percentage_silver" class="" name="bonus_percentage_silver" value="<?php echo!empty($data_configs['bonus_percentage_silver']) ? $data_configs['bonus_percentage_silver'] : '' ?>" class="" style="width:240px">% 
                </td>
            </tr>
            <tr>
                <td>Interest rate  of Gold</td>
                <td colspan="5"> 
                    <input type="text" id="bonus_percentage_gold" class="" name="bonus_percentage_gold" value="<?php echo!empty($data_configs['bonus_percentage_gold']) ? $data_configs['bonus_percentage_gold'] : '' ?>" class="" style="width:240px">%

                </td>
            </tr>
            <tr>
                <td>Percent referral fees for sliver</td>
                <td colspan="5">
                    <input type="text" id="referral_fees" class="" name="percent_referral_fees" value="<?php echo!empty($data_configs['percent_referral_fees']) ? $data_configs['percent_referral_fees'] : '' ?>" style="width:240px">%
                </td>
            </tr>
            <tr>
                <td>Amount referral fees for sliver</td>
                <td colspan="5">
                    <input type="text" id="referral_fees" class="" name="referral_fees" value="<?php echo!empty($data_configs['referral_fees']) ? $data_configs['referral_fees'] : '' ?>" style="width:240px">$
                </td>
            </tr>
            <tr>
                <td>Amount % of referral bonus default</td>
                <td colspan="5">
                    <input type="text" id="referral_bonus_default" class="" name="referral_bonus_default" value="<?php echo!empty($data_configs['referral_bonus_default']) ? $data_configs['referral_bonus_default'] : '' ?>" style="width:240px">$
                </td>
            </tr>
            <?php for ($i = 1; $i <= 6; $i++) { ?>
                <tr>
                    <td><?php echo ($i == 1) ? 'Amount % of referral bonus' : '' ?></td>
                    <td width="50">
                        <input type="text" id="" class="" name="referral_bonus[<?php echo $i ?>][min]" value="<?php echo!empty($data_configs['referral_bonus'][$i]['min']) ? $data_configs['referral_bonus'][$i]['min'] : '' ?>" style="width:75px">
                    </td>
                    <td width="20" align="left">To</td>
                    <td width="50">
                        <input type="text" id="" class="" name="referral_bonus[<?php echo $i ?>][max]" value="<?php echo!empty($data_configs['referral_bonus'][$i]['max']) ? $data_configs['referral_bonus'][$i]['max'] : '' ?>" style="width:75px">
                    </td>
                    <td width="20" align="center"> - </td>
                    <td width="500">
                        <input type="text" id="" class="" name="referral_bonus[<?php echo $i ?>][refere]" value="<?php echo!empty($data_configs['referral_bonus'][$i]['refere']) ? $data_configs['referral_bonus'][$i]['refere'] : '' ?>" style="width:75px">%
                    </td>
                </tr>
            <?php } ?>

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