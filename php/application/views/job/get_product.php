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