<?php if ((!empty($staffdata->id))) { ?>
    <script>
        $(document).ready(function(){
            $('#deactivate-btn').live('click',function(){
                if (!confirm('Confirm request to de-activate staff for use?')) return false;
                var id = $(this).attr('rel');
                var e = $(this);
                $.ajax({  
                    type:"post",
                    data:{id:"<?php echo $staffdata->id ?>"},
                    url:"<?php echo site_url('staff/deactive') ?>",
                    success: function(data){
                        window.location = "<?php echo site_url('staff/manage') ?>"
                    } 
                }); 
            });
                                
            $('#activate-btn').live('click',function(){
                if (!confirm('Confirm request to activate staff for use?')) return false;
                var id = $(this).attr('rel');
                var e = $(this);
                $.ajax({  
                    type:"post",
                    data:{id:"<?php echo $staffdata->id ?>"},
                    url:"<?php echo site_url('staff/active') ?>",
                    success: function(data){
                        window.location = "<?php echo site_url('staff/manage') ?>"
                    } 
                }); 
            });
        })
                            
    </script>
<?php } ?>
<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>Staff Member</h1>
        </div>
        <div class="content-actions">
            <input id="save-btn" name="save-btn" class="button" value="Save" type="submit">
            <a class="button" href="<?php echo site_url('staff/manage') ?>" >Cancel</a>
            <?php if ((!empty($staffdata->id))) { ?>
                <?php if (!empty($staffdata->status)) { ?> 
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
                        <td class="tab selected" width="11%">Profile</td>
                        <?php if (!empty($staffdata->id)) { ?>
                            <td class="tab" width="11%" ><a href="<?php echo site_url('staff/history/' . $staffdata->id) ?>">Job History</a></td>
                        <?php } ?>
                        <td width="100%"></td>
                    </tr>
                </tbody></table>
        </div>

        <table class="datatable">
            <tbody><tr>
                    <td><div>staff id</div></td>
                    <td>
                        <input id="id" name="id" value="<?php echo!empty($staffdata->id) ? $staffdata->id : '' ?>" readonly="readonly" style="width:60px" type="text">
                        <span style="padding:8px">name</span>
                        <input id="name" name="name" value="<?php echo!empty($staffdata->name) ? $staffdata->name : '' ?>" class="mandatory" style="width:440px" type="text"><img title="This is a required value" src="<?php echo base_url() ?>/img/sev/required.jpg" class="mandatory">
                        <span style="padding:8px">d.o.b.</span>
                        <input id="dob" name="dob" value="<?php echo!empty($staffdata->dob) ? (date('d/m/Y', strtotime(str_replace('/', '-', $staffdata->dob)))) : '' ?>" style="width:102px" type="text">
                        <script>$("#dob").datepicker({ dateFormat: "dd/mm/yy", changeMonth: true, changeYear: true, yearRange: '-100:+0' });</script>
                    </td>
                </tr>
                <tr>
                    <td><div>gender</div></td>
                    <td>
                        <select id="gender" name="gender" style="width:80px">
                            <option value="male" <?php echo (!empty($staffdata->gender) && ($staffdata->gender == 'male')) ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?php echo (!empty($staffdata->gender) && ($staffdata->gender == 'female')) ? 'selected' : '' ?>>Female</option>
                        </select>
                        <span style="padding:8px">marital status</span>
                        <select id="marital" name="marital">
                            <option value=""></option>
                            <option value="divorced" <?php echo (!empty($staffdata->marital) && ($staffdata->marital == 'divorced')) ? 'selected' : '' ?>>Divorced</option>
                            <option value="relationship" <?php echo (!empty($staffdata->marital) && ($staffdata->marital == 'relationship')) ? 'selected' : '' ?>>In a relationship</option>
                            <option value="married" <?php echo (!empty($staffdata->marital) && ($staffdata->marital == 'married')) ? 'selected' : '' ?>>Married</option>
                            <option value="separated" <?php echo (!empty($staffdata->marital) && ($staffdata->marital == 'separated')) ? 'selected' : '' ?>>Separated</option>
                            <option value="single" <?php echo (!empty($staffdata->marital) && ($staffdata->marital == 'single')) ? 'selected' : '' ?>>Single</option>
                        </select>
                        <span style="padding:8px 8px">partner</span>
                        <input id="partner" name="partner" value="<?php echo!empty($staffdata->partner) ? $staffdata->partner : '' ?>" style="width:400px" type="text">
                    </td>
                </tr>
                <tr>
                    <td><div>phone</div></td>
                    <td>
                        <input id="phone" name="phone" value="<?php echo!empty($staffdata->phone) ? $staffdata->phone : '' ?>" style="width:160px" type="text">
                        <span style="padding:8px">mobile</span>
                        <input id="mobile" name="mobile" value="<?php echo!empty($staffdata->mobile) ? $staffdata->mobile : '' ?>" style="width:160px" type="text">
                    </td>
                </tr>
                <tr>
                    <td><div>email</div></td>
                    <td>
                        <input id="email" name="email" value="<?php echo!empty($staffdata->email) ? $staffdata->email : '' ?>" style="width:400px" type="text">
                    </td>
                </tr>
                <tr>
                    <td><div>address</div></td>
                    <td>
                        <textarea id="details" name="details" style="width:400px;height:120px"><?php echo!empty($staffdata->details) ? $staffdata->details : '' ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</form>