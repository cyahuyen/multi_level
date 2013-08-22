
<div class="entry"> 
    <div style="clear: both;text-align: center;width: 60%;margin: 0px auto;">
        <h2 style="padding-bottom: 20px;color: #017AC3">Welcome to www.safeco-op.com</h2>
        <div style="text-align: left;">
            <?php echo form_open('authentication'); ?>
            <table class="datatable" style="text-align: center;" >
                <tr>
                    <td style="text-align: right; width: 165px;"><div>Sign-in Email: </div></td>
                    <td style="text-align: left">
                        <input type="text" id="username" name="username" value="" style="width:200px;"/>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right"><div>Password: </div></td>
                    <td style="text-align: left">
                        <input type="password" id="password" name="password" value="" style="width:200px;"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: left">
                        <a href="<?php echo site_url('register/forgot') ?>">(if you forgot password ?)</a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: left">
                        <input type="submit" id="signin-btn" name="signin-btn" class="button" value="Sign-in"/>
                    </td>
                </tr>
            </table>
            <?php echo form_close(); ?>

            <!--You came to the right place for authoritative answers to your questions and reliable guidance in making decisions about MLM participation and/or help with recovery. This information is based on the most extensive research ever done on MLM compensation plans and profitability, on distinguishing characteristics separating legitimate direct selling from pyramid or chain selling, and on the deceptions used to sell recruitment-driven MLMs, or product-based pyramid schemes.-->
        </div>
        <!--<div><img src="<?php echo base_url() ?>/img/how-to-mlm.png" title="How to mlm"/></div>-->
    </div>
</div>