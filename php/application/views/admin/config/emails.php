<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Email Configuration</h1>
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
                <td>Protocol</td>
                <td>
                    <select name="protocol" id="protocol" style="width:160px" >
                        <option value="mail" <?php echo (!empty($data_configs['protocol']) && ($data_configs['protocol'] == 'mail')) ? 'selected' : '' ?>>Mail</option>
                        <option value="smtp" <?php echo (!empty($data_configs['protocol']) && ($data_configs['protocol'] == 'smtp')) ? 'selected' : '' ?>>SMTP</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Config Mail Parameter</td>
                <td>
                    <input type="text" id="mail_parameter" name="mail_parameter" value="<?php echo!empty($data_configs['mail_parameter']) ? $data_configs['mail_parameter'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>SMTP Host:</td>
                <td>
                    <input type="text" id="smtp_host" name="smtp_host" value="<?php echo!empty($data_configs['smtp_host']) ? $data_configs['smtp_host'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>SMTP Username:</td>
                <td>
                    <input type="text" id="smtp_user" name="smtp_user" value="<?php echo!empty($data_configs['smtp_user']) ? $data_configs['smtp_user'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>

            <tr>
                <td>SMTP Password:</td>
                <td>
                    <input type="text" id="smtp_pass" name="smtp_pass" value="<?php echo!empty($data_configs['smtp_pass']) ? $data_configs['smtp_pass'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>SMTP Port:</td>
                <td>
                    <input type="text" id="smtp_port" name="smtp_port" value="<?php echo!empty($data_configs['smtp_port']) ? $data_configs['smtp_port'] : '25' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>SMTP Timeout:</td>
                <td>
                    <input type="text" id="smtp_timeout" name="smtp_timeout" value="<?php echo!empty($data_configs['smtp_timeout']) ? $data_configs['smtp_timeout'] : '' ?>" class="" style="width:240px">
                </td>
            </tr>
            <tr>
                <td>Admin email address:</td>
                <td>
                    <input type="text" id="email_admin" name="email_admin" value="<?php echo!empty($data_configs['email_admin']) ? $data_configs['email_admin'] : '' ?>" class="" style="width:240px">
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