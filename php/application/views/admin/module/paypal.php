<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Paypal Payment config</h1>
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
                <td>Business Email</td>
                <td>
                    <input type="text" id="business" class="mandatory" name="business" value="<?php echo!empty($data_configs['business']) ? $data_configs['business'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Item Name</td>
                <td>
                    <input type="text" id="item_name" class="" name="item_name" value="<?php echo!empty($data_configs['item_name']) ? $data_configs['item_name'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Currency Code</td>
                <td>
                    <input type="text" id="currency_code" class="mandatory" name="currency_code" value="<?php echo!empty($data_configs['currency_code']) ? $data_configs['currency_code'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>

            <tr>
                <td>Sandbox</td>
                <td>
                    <input type="checkbox" id="sandbox" name="sandbox" value="1" <?php echo (!empty($data_configs['sandbox']) && ($data_configs['sandbox'] == '1')) ? 'checked' : '' ?> class="" > Active
                </td>
            </tr>
            <tr>
                <td>Active</td>
                <td>
                    <input type="checkbox" id="active" name="active" value="1" <?php echo (!empty($data_configs['active']) && ($data_configs['active'] == '1')) ? 'checked' : '' ?> class="" > Active
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