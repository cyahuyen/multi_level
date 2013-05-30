<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Withdrawal Configuration</h1>
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
                <td>Days Space Withdrawal Of Gold</td>
                <td>
                    <input type="text" id="days_space_gold" class="" name="days_space_gold" value="<?php echo!empty($data_configs['days_space_gold']) ? $data_configs['days_space_gold'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Days Space Withdrawal Of Silver</td>
                <td>
                    <input type="text" id="days_space_silver" class="" name="days_space_silver" value="<?php echo!empty($data_configs['days_space_silver']) ? $data_configs['days_space_silver'] : '' ?>" class="" style="width:240px">

                </td>
            </tr>
            <tr>
                <td>Min Amount of Gold</td>
                <td>
                    <input type="text" id="min_of_gold" class="" name="min_of_gold" value="<?php echo!empty($data_configs['min_of_gold']) ? $data_configs['min_of_gold'] : '' ?>" class="" style="width:240px">$

                </td>
            </tr>
            <tr>
                <td>Min Amount of Silver</td>
                <td>
                    <input type="text" id="min_of_silver" class="" name="min_of_silver" value="<?php echo!empty($data_configs['min_of_silver']) ? $data_configs['min_of_silver'] : '' ?>" class="" style="width:240px">$
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