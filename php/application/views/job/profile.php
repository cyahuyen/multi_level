<form action="" method="post">
    <div class="content-header">
        <div class="content-title">
            <h1>Job</h1>
        </div>
        <div class="content-actions">
            <input type="submit" value="Save" class="button" name="save-btn" id="save-btn">
            <a href="<?php echo site_url('job/manage') ?>" class="button">Cancel</a>
            <?php if ($jobdata->status == 'open') { ?>
                <input type="button"  value="Close" class="button" name="close-btn" id="close-btn">
            <?php } else { ?>
                <input type="button"  value="Open" class="button" name="open-btn" id="open-btn">
            <?php } ?>
        </div>
    </div>

    <div class="content-body">

        <div class="tabset">
            <table class="tabs">
                <tbody><tr>
                        <td width="11%" class="tab selected" id="profile">Profile</td>
                        <td width="100%"></td>
                    </tr>
                </tbody></table>
        </div>

        <table class="datatable">
            <tbody><tr>
                    <td><div>job</div></td>
                    <td>
                        <input type="text" style="width:60px" readonly="readonly" value="<?php echo!empty($jobdata->id) ? $jobdata->id : '' ?>" id="id" name="id" >
                        <input type="text" style="width:700px" class="mandatory" value="<?php echo!empty($jobdata->title) ? $jobdata->title : '' ?>" name="title" id="title"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                    </td>
                </tr>
                <tr>
                    <td><div>customer</div></td>
                    <td>
                        <input type="text" style="width:480px" class="mandatory" value="<?php echo!empty($jobdata->customer) ? $jobdata->customer : '' ?>" id="customer" name="customer"><img class="mandatory" src="<?php echo base_url() ?>/img/sev/required.jpg" title="This is a required value">
                        <span style="padding:8px 8px">start date</span>

                        <input type="text" style="width:91px" value="<?php echo!empty($jobdata->start_date) ? (date('d/m/Y', strtotime(str_replace('/', '-', $jobdata->start_date)))) : '' ?>" id="start_date"  name="start_date">
                        <span style="padding:8px 8px">days</span>
                        <input type="text" style="width:40px" value="<?php echo!empty($jobdata->days) ? $jobdata->days : '' ?>" id="days" name="days">
                        <script>$("#start_date").datepicker({ dateFormat: "dd/mm/yy" });</script>
                    </td>
                </tr>
                <tr>
                    <td><div>location</div></td>
                    <td>
                        <input type="text" style="width:480px" value="<?php echo!empty($jobdata->location) ? $jobdata->location : '' ?>" name="location" id="location">
                    </td>
                </tr>
                <tr>
                    <td><div>details</div></td>
                    <td>
                        <textarea style="width:760px;height:240px" id="details" name="details"><?php echo!empty($jobdata->details) ? $jobdata->details : '' ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="collapsible" id="job-assignedstaff">
                            <div class="header">
                                <img src="<?php echo base_url() ?>/img/arrow_exp.png">Assigned Staff
                            </div>
                            <div style="margin-left:0;padding-left:0" class="body">
                                <table class="datatable">
                                    <tbody><tr>
                                            <td><div>available staff</div></td>
                                            <td>
                                                <select style="width:200px" id="job-assignstaff-available">

                                                    <?php if (!empty($allStaffs)) { ?>
                                                        <?php foreach ($allStaffs as $staff) { ?>
                                                            <option value="<?php echo $staff->id ?>"><?php echo $staff->name ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <input type="button" value="Assign" class="button" id="job-assignedstaff-assign">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div>assigned staff</div></td>
                                            <td>
                                                <div class="datalist">

                                                    <table>
                                                        <tbody id="datalist-staff">
                                                            <tr class="heading">
                                                                <td style="width:220px"><div>Name</div></td>
                                                                <td style="width:80px"><div>Phone</div></td>
                                                                <td style="width:80px"><div>Mobile</div></td>
                                                                <td style="width:100px"><div>Email</div></td>
                                                                <td style="width:40px"><div>Actions</div></td>
                                                            </tr>
                                                            <?php if (!empty($listStaffs)) { ?>
                                                                <?php foreach ($listStaffs as $staff) { ?>
                                                                    <tr class="row">
                                                                        <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'">
                                                                            <input type="hidden" name="staff_id[]" value="<?php echo $staff->id ?>">
                                                                            <div><?php echo $staff->name ?></div>
                                                                        </td>
                                                                        <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->mobile ?></div></td>
                                                                        <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->phone ?></div></td>
                                                                        <td onclick="window.location='<?php echo site_url('staff/profile/' . $staff->id) ?>'"><div><?php echo $staff->email ?></div></td>
                                                                        <td>
                                                                            <div>
                                                                                <a onclick="if (!confirm('Confirm request to unassign staff member?')) { return false; }else{$(this).parent().parent().parent().remove();return false;}" href="javascript:void(0)">
                                                                                    <img title="Unassign" alt="Unassign" src="<?php echo base_url() ?>/img/actions/deactivate.png">
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tbody></table>

                                                </div>
                                            </td>
                                        </tr>
                                    </tbody></table>
                            </div>
                        </div>											
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="collapsible" id="job-products">
                            <div class="header">
                                <img src="<?php echo base_url() ?>/img/arrow_exp.png">Product Allocation
                            </div>
                            <div style="margin-left:0;padding-left:0" class="body">

                                <table class="datatable">
                                    <tbody >
                                        <tr>
                                            <td><div>product</div></td>
                                            <td>
                                                <select style="width:200px" id="job-products-product">
                                                    <?php if (!empty($allProducts)) { ?>
                                                        <?php foreach ($allProducts as $product) { ?>
                                                            <option value="<?php echo $product->id ?>"><?php echo $product->title ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <input type="button" value="Add" class="button" id="job-products-add">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><div>on site</div></td>
                                            <td>

                                                <div class="datalist">

                                                    <table style="max-width:600px">
                                                        <tbody id="datalist-product"><tr class="heading">
                                                                <td style="width:400px"><div>Product</div></td>
                                                                <td style="width:80px"><div>Code</div></td>
                                                                <td style="width:40px"><div>Sent</div></td>
                                                                <td style="width:40px"><div>Used</div></td>
                                                                <td style="width:40px"><div>Actions</div></td>
                                                            </tr>
                                                            <?php if (!empty($listProducts)) { ?>
                                                                <?php foreach ($listProducts as $product) { ?>
                                                                    <tr class="row">
                                                                        <td>
                                                                            <input type="hidden" name="product[<?php echo $product->id ?>][id]" value="<?php echo $product->id ?>">
                                                                            <div><input type="text" style="width:90%" name="product[<?php echo $product->id ?>][title]" value="<?php echo $product->title ?>" readonly="readonly" id="product-name-pc935"></div>
                                                                        </td>
                                                                        <td><div><input type="text" style="width:90%" name="product[<?php echo $product->id ?>][code]" value="<?php echo $product->code ?>" readonly="readonly" id="product-code-pc935"></div></td>
                                                                        <td><div><input type="text" style="width:90%" name="product[<?php echo $product->id ?>][sent]" value="<?php echo $product->sent ?>" id="product-sent-pc935"></div></td>
                                                                        <td><div><input type="text" style="width:90%" name="product[<?php echo $product->id ?>][used]" value="<?php echo $product->used ?>" id="product-used-pc935"></div></td>
                                                                        <td><div>
                                                                                <a onclick="if (!confirm('Confirm request to remove product?')) { return false; }else{$(this).parent().parent().parent().remove();return false;}" href="javascript:void(0)">
                                                                                    <img title="Remove" alt="Remove" src="<?php echo base_url() ?>/img/actions/deactivate.png">
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>											
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>
<script>
    $(document).ready(function(){
<?php if (!empty($jobdata->id)) { ?>
            $('#close-btn').live('click',function(){
                if (!confirm('Confirm request to close job?')) return false;
                var e = $(this);
                $.ajax({  
                    type:"post",
                    data:{id:"<?php echo $jobdata->id ?>"},
                    url:"<?php echo site_url('job/deactive') ?>",
                    success: function(data){
                        window.location = "<?php echo site_url('job/manage') ?>"
                    } 
                }); 
            });
                
            $('#open-btn').live('click',function(){
                if (!confirm('Confirm request to open job?')) return false;
                var e = $(this);
                $.ajax({  
                    type:"post",
                    data:{id:"<?php echo $jobdata->id ?>"},
                    url:"<?php echo site_url('job/active') ?>",
                    success: function(data){
                        window.location = "<?php echo site_url('job/manage') ?>"
                    } 
                }); 
            });
<?php } ?>
            
        $('#job-assignedstaff-assign').live('click',function(){
            var staff_id = $('#job-assignstaff-available').val();
            $.ajax({  
                url:"<?php echo site_url('job/get_staff') ?>/"+staff_id,
                success: function(data){
                    $('#datalist-staff').append(data);
                } 
            }); 
        });
        
        $('#job-products-add').live('click',function(){
            var product_id = $('#job-products-product').val();
            $.ajax({  
                url:"<?php echo site_url('job/get_product') ?>/"+product_id,
                success: function(data){
                    $('#datalist-product').append(data);
                } 
            }); 
        });
        
       
        
        $("#customer").autocomplete({
            delay: 100,
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('job/get_customer?name=') ?>" + request.term,
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item, key) {
                            return {
                                label: item,
                                values: key
                            }
                        }));
                        return false
                    }
                });
            },
            select: function(event, ui) {
                $("#customer").val(ui.item.values);
            },
            focus: function(event, ui) {
                return false;
            }
        });
    })
    
    
</script>