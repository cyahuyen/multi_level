
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Allied Wallet QuickPay</h1>
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
                <td>Title</td>
                <td>
                    <input type="text" id="title" class="mandatory" name="title" value="<?php echo!empty($data_configs['title']) ? $data_configs['title'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>MerchantID</td>
                <td>
                    <input type="text" id="MerchantID" class="mandatory" name="MerchantID" value="<?php echo!empty($data_configs['MerchantID']) ? $data_configs['MerchantID'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>SiteID</td>
                <td>
                    <input type="text" id="SiteID" class="mandatory" name="SiteID" value="<?php echo!empty($data_configs['SiteID']) ? $data_configs['SiteID'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>CurrencyID</td>
                <td>
                    <select name="aw_currency">
                        <option <?php echo (!empty($data_configs['aw_currency']) && ($data_configs['aw_currency'] == 'USD')) ? 'selected' : '' ?> value="USD">US Dollars</option>
                        <option <?php echo (!empty($data_configs['aw_currency']) && ($data_configs['aw_currency'] == 'GBP')) ? 'selected' : '' ?> value="GBP">British Pounds</option>
                        <option <?php echo (!empty($data_configs['aw_currency']) && ($data_configs['aw_currency'] == 'EUR')) ? 'selected' : '' ?> value="EUR">Euros</option>
                        <option <?php echo (!empty($data_configs['aw_currency']) && ($data_configs['aw_currency'] == 'CAD')) ? 'selected' : '' ?> value="CAD">Canadian Dollars</option>
                    </select>
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