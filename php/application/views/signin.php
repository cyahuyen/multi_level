<div class="content-header">
    <div class="content-title">
        <h1>Sign-in</h1>
    </div>
    <div class="content-actions">
    </div>
</div>

<div class="content-body">

    <?php echo form_open('authentication/signin'); ?>
    <table class="datatable">
        <tr>
            <td><div>sign-in name</div></td>
            <td>
                <input type="text" id="username" name="username" value="" style="width:200px"/>
            </td>
        </tr>
        <tr>
            <td><div>password</div></td>
            <td>
                <input type="password" id="password" name="password" value="" style="width:200px"/>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="signin-btn" name="signin-btn" class="button" value="Sign-in"/>
            </td>
        </tr>
    </table>
    <?php echo form_close(); ?>
    <?php echo form_open('authentication/resetpassword'); ?>
    <table class="datatable">
        <tr>
            <td>
                <div id="resetPassword" class="collapsible">
                    <div class="header">
                        <img src="<?php echo base_url(); ?>img/arrow_exp.png"/>Forgotten Your Password?
                    </div>
                    <div class="body">
                        <table class="datatable" style="padding-left:0">
                            <tr>
                                <td colspan="2"><div>Enter your sign-in name below and your password will be reset and emailed to you</div></td>
                            </tr>
                            <tr>
                                <td><div>sign-in name</div></td>
                                <td>
                                    <input type="text" id="passwordreset" name="passwordreset" value="" style="width:200px"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" id="reset-btn" name="reset-btn" class="button" value="Reset Password"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>											
            </td>
        </tr>
    </table>
    <?php echo form_close(); ?>

</div>
