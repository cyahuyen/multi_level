<?php echo form_open('', array('id' => 'transaction-form')); ?>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>Credit card</h1></td>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><div>Username: </div></td>
            <td>
                <?php echo $register_info->username ?>
            </td>
        </tr>
        <tr>
            <td><div>Firstname: </div></td>
            <td>
                <?php echo $register_info->firstname ?>
            </td>
        </tr>
        <tr>
            <td><div>Lastname: </div></td>
            <td>
                <?php echo $register_info->lastname ?>
            </td>
        </tr>
        <tr>
            <td><div>Address: </div></td>
            <td>
                <?php echo $register_info->address ?>
            </td>
        </tr>
        <tr>
            <td><div>Phone: </div></td>
            <td>
                <?php echo $register_info->phone ?>
            </td>
        </tr>
        <tr>
            <td><div>Email: </div></td>
            <td>
                <?php echo $register_info->email ?>
            </td>
        </tr>

        <tr>
            <td><div>Fee: </div></td>
            <td>
                <span class="currency" id="fees">$<?php echo $register_fees ?></span>
            </td>
        </tr>
        <tr>
            <td><div>Total: </div></td>
            <td>
                <span class="currency" id="total_fees">$<?php echo ($register_info->entry_amount + $register_fees ) ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2"><h1>Credit Card</h1></td>
                        </tr>
                    </thead>
                </table>

            </td>
        </tr>

        <tr class="">
            <td >Card Owner</td>
            <td>
                <input type="text"  name="cc_owner" id="cc_owner" value=""/> 
            </td>
        </tr>
        <tr class="">
            <td>Card Number</td>
            <td>
                <input type="text" name="card_num" id="card_num" style="width:300px">
            </td>
        </tr>
        <tr class="">
            <td>Exp Date</td>
            <td>
                <input type="text" name="exp_date" id="exp_date" style="width:300px">
            </td>
        </tr>
        <tr class="">
            <td>CVV2</td>
            <td>
                <input type="text" name="cc_cvv2" id="cc_cvv2" style="width:300px">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    <input type="submit" id="save-btn" name="save-btn" class="button" value="Confirm">&nbsp;
                    <input type="button"  onclick="location='<?php echo site_url('register') ?>'" class="button" value="Back">
                </div>
            </td>
            <td colspan="2">
                <div style="padding-left: 130px;">
                    
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>