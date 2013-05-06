<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Time config</h1>
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
                <td><div>Time</div> </td>
                <td>(day) <input type="text" id="time_format" class="mandatory" name="time_format" value="<?php echo!empty($data_configs['time_format']) ? $data_configs['time_format'] : '' ?>" class="" style="width:240px"></td>
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