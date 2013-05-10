
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Credit Card Config</h1>
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
                <td>API Login ID</td>
                <td>
                    <input type="text" id="login_id" class="mandatory" name="login_id" value="<?php echo!empty($data_configs['login_id']) ? $data_configs['login_id'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>API Transaction</td>
                <td>
                    <input type="text" id="transaction" class="mandatory" name="transaction" value="<?php echo!empty($data_configs['transaction']) ? $data_configs['transaction'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Transaction Method:</td>
                <td><select name="authorizenet_aim_method">
                        <option <?php echo (!empty($data_configs['authorizenet_aim_method']) && ($data_configs['authorizenet_aim_method'] == 'authorization'))?'selected':''  ?> value="authorization">Authorization</option>
                        <option <?php echo (!empty($data_configs['authorizenet_aim_method']) && ($data_configs['authorizenet_aim_method'] == 'capture'))?'selected':''  ?> value="capture">Capture</option>
                    </select></td>
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