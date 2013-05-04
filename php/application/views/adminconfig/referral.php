<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Transaction Referal config</h1>
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
                <td>Reffering Percentage </td>
                <td>
                    %<input type="text" id="referring_percentage" class="mandatory" name="referring_percentage" value="<?php echo!empty($data_configs['referring_percentage']) ? $data_configs['referring_percentage'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Interest Race </td>
                <td>
                    %<input type="text" id="interest_race" class="mandatory" name="interest_race" value="<?php echo!empty($data_configs['interest_race']) ? $data_configs['interest_race'] : '' ?>" class="" style="width:240px">
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