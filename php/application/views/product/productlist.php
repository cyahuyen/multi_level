<table>
    <tbody><tr class="heading">
            <td style="width:120px"><div>Code</div></td>
            <td style="width:400px"><div>Name</div></td>
            <td style="width:60px"><div>Status</div></td>
            <td style="width:40px"><div>Actions</div></td>
        </tr>
        <?php foreach ($products as $product) { ?>
            <tr class="row">
                <td onclick="window.location='<?php echo site_url('product/profile/' . $product->id) ?>'"><div><?php echo $product->code; ?></div></td>
                <td onclick="window.location='<?php echo site_url('product/profile/' . $product->id) ?>'"><div><?php echo $product->title; ?></div></td>
                <td onclick="window.location='<?php echo site_url('product/profile/' . $product->id) ?>'"><div><?php echo empty($product->status) ? 'Deactive' : 'Active'; ?></div></td>
                <td>
                    <?php if(!empty($product->status)){ ?>
                    <div>
                        <?php if (in_array($user[0]->usertype, array('StaffManager'))){ ?>
                        <a class="deactive" href="javascript:void(0)" rel="<?php echo $product->id ?>">
                            <img title="De-activate" alt="Deactivate" src="<?php echo base_url() ?>/img/actions/deactivate.png">
                        </a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>