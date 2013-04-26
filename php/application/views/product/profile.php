<?php if (($user[0]->usertype == 'StaffManager') && (!empty($productdata->id))) { ?>
    <script>
               
        $(document).ready(function(){
            $('#deactivate-btn').live('click',function(){
                if (!confirm('Confirm request to de-activate product for use?')) return false;
                var id = $(this).attr('rel');
                var e = $(this);
                $.ajax({  
                    type:"post",
                    data:{id:"<?php echo $productdata->id ?>"},
                    url:"<?php echo site_url('product/deactive') ?>",
                    success: function(data){
                        window.location = "<?php echo site_url('product/manage') ?>"
                    } 
                }); 
            });
                    
            $('#activate-btn').live('click',function(){
                if (!confirm('Confirm request to activate product for use?')) return false;
                var id = $(this).attr('rel');
                var e = $(this);
                $.ajax({  
                    type:"post",
                    data:{id:"<?php echo $productdata->id ?>"},
                    url:"<?php echo site_url('product/active') ?>",
                    success: function(data){
                        window.location = "<?php echo site_url('product/manage') ?>"
                    } 
                }); 
            });
        })
                
    </script>
<?php } ?>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>Product</h1>
        </div>
        <div class="content-actions">
            <?php if ($user[0]->usertype == 'StaffManager') { ?>
                <input id="save-btn" name="save-btn" class="button" value="Save" type="submit">
            <?php } ?>
            <a class="button" href="<?php echo site_url('product/manage') ?>" >Cancel</a>
            <?php if (($user[0]->usertype == 'StaffManager') && (!empty($productdata->id))) { ?>
                <?php if (!empty($productdata->status)) { ?> 
                    <input type="button" value="De-activate" class="button" name="deactivate-btn" id="deactivate-btn">
                <?php } else { ?>
                    <input type="button" value="Activate" class="button" name="activate-btn" id="activate-btn">
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <div class="content-body">

        <div class="tabset">
            <table class="tabs">
                <tbody><tr>
                        <td id="profile" class="tab selected" width="11%">Profile</td>
                        <td width="100%"></td>
                    </tr>
                </tbody></table>
        </div>

        <table class="datatable">
            <tbody><tr>
                    <td><div>code</div></td>
                    <td>
                        <input id="code" name="code" value="<?php echo!empty($productdata->code) ? $productdata->code : '' ?>" style="width:60px" type="text">
                        <span style="padding:8px">name</span>
                        <input id="title" name="title" value="<?php echo!empty($productdata->title) ? $productdata->title : '' ?>" class="mandatory" style="width:600px" type="text"><img title="This is a required value" src="<?php echo base_url() ?>/img/sev/required.jpg" class="mandatory">
                    </td>
                </tr>
                <tr>
                    <td><div>description</div></td>
                    <td>
                        <textarea id="description" name="description" style="width:734px;height:240px"><?php echo!empty($productdata->description) ? $productdata->description : '' ?></textarea>
                    </td>
                </tr>
            </tbody></table>
    </div>

</form>