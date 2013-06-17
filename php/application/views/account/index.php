<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<table class="datatable">
    <thead>
        <tr>
            <td colspan="2"><h1>My Account</h1></td>
        </tr>
    </thead>
    <tbody>
        <?php if ($inforcheck->usertype == 2 || $inforcheck->usertype == 1) { ?>
            <tr>
                <td><div style="font-weight: bold;color: #000;">User Type: </div></td>
                <td><div style="font-weight: bold;color: red;padding-left: 50px;padding-top: 5px;"><?php echo $usertype; ?></div></td>
                <td><div style="font-weight: bold;color: #000;">Amount: </div></td>
                <td><div style="font-weight: bold;color: red;padding-left: 50px;padding-top: 5px;">$<?php echo number_format($amout, 2, '.', ','); ?> </div></td>
            </tr>
            
        <?php } else { ?>
            <tr>
                <td><div style="font-weight: bold;color: #000;">UserType: </div></td>
                <td><div style="font-weight: bold;color: red;padding-left: 50px;padding-top: 5px;"><?php echo $usertype; ?></div></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2"><div><a href="<?php echo site_url('account/edit') ?>">Edit Account</a> </div></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2"><div><a href="<?php echo site_url('account/changepassword') ?>">Change Password</a> </div></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2"><div><a href="<?php echo site_url('account/refered') ?>">Refered Members</a> </div></td>
            <td colspan="2"></td>
        </tr>
    </tbody>
</table>
