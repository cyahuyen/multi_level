<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Transaction Fee Configuration</h1>
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
                <td>Opening Fee </td>
                <td>
                    $<input type="text" id="open_fee" class="mandatory" name="open_fee" value="<?php echo!empty($data_configs['open_fee']) ? $data_configs['open_fee'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Cash Transaction Fee </td>
                <td>
                    $<input type="text" id="transaction_fee" class="mandatory" name="transaction_fee" value="<?php echo!empty($data_configs['transaction_fee']) ? $data_configs['transaction_fee'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Minimum Enrolment Entry Amount </td>
                <td>
                    $<input type="text" id="min_enrolment_entry_amount" class="mandatory" name="min_enrolment_entry_amount" value="<?php echo!empty($data_configs['min_enrolment_entry_amount']) ? $data_configs['min_enrolment_entry_amount'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Maximum Enrolment Entry Amount </td>
                <td>
                   $<input type="text" id="max_enrolment_entry_amount" class="mandatory" name="max_enrolment_entry_amount" value="<?php echo!empty($data_configs['max_enrolment_entry_amount']) ? $data_configs['max_enrolment_entry_amount'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Maximum Monthly Amount for Silver</td>
                <td>
                   $<input type="text" id="max_enrolment_silver_amount" class="mandatory" name="max_enrolment_silver_amount" value="<?php echo!empty($data_configs['max_enrolment_silver_amount']) ? $data_configs['max_enrolment_silver_amount'] : '' ?>" class="" style="width:240px">
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