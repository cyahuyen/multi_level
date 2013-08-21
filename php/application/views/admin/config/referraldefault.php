
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>View/Edit Referral Default Config</h1>
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
                <td>Default Referral User</td>
                <td>
                    <input type="text" id="default_referral_user" class="" name="default_referral_user" value="<?php echo!empty($data_configs['default_referral_user']) ? $data_configs['default_referral_user'] : '' ?>" class="" style="width:240px">
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

<script>
    $(document).ready(function(){
        $("#default_referral_user").autocomplete({
            delay: 100,
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('admin/ajax_search?part=') ?>" + request.term,
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item, key) {
                            return {
                                label: item,
                                value: key
                            }
                        }));
                        return false
                    }
                });
            },
            select: function(event, ui) {
                $("#suburbs_id").val(ui.item.value);
            },
            focus: function(event, ui) {
                return false;
            }
        });
    })
</script>