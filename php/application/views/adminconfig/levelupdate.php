<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>

<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Level Configuration</h1>
        </div>
        
        <table class="tabs">
            <tbody><tr>
                    <td width="100%"></td>
                </tr>
            </tbody></table>
    </div>
    <table class="datatable">
        <tbody>

            <tr>
                <td>Control number of referrals required to achieve new level</td>
                <td>
                    <input type="text" id="level_update" name="level_update" value="<?php echo!empty($data_configs['level_update']) ? $data_configs['level_update'] : '' ?>" class="" style="width:240px">
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

</div>
</form>