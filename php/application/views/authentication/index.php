<?php echo form_open('authentication'); ?>
<table class="datatable">
    <tr>
        <td><div>Sign-in Email: </div></td>
        <td>
            <input type="text" id="email" name="email" value="" style="width:200px"/>
        </td>
    </tr>
    <tr>
        <td><div>Password: </div></td>
        <td>
            <input type="password" id="password" name="password" value="" style="width:200px"/>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href="<?php echo site_url('register/forgot') ?>">(if you forgot password ?)</a>
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
    