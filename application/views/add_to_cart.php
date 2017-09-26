<div class="addCart">
<?php echo form_open('Cart/add_to_cart');?>
    <table class="table">
        <tr>
            <td colspan="2">Item ID: &nbsp; <?=$item_id;?></td>
        </tr>
        <tr>
            <td colspan="2">Item Price: &nbsp; N<?=$price;?></td>
        </tr>
        <tr>
            <td>Qty:</td>
            <td>
                <div class="col-sm-8">
                    <select name="qty" class="form-control">
                    <?php
                        for ($i=1; $i <= 20; $i++) { 
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        } 
                    ?> 
                    </select>
                  
                </div>    
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type"submit" class="btn cart-view-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;Add To Cart</button>
            </td>
        </tr>
    </table>
<?php echo form_hidden('pro_id', $item_id);?>
<?php echo form_close();?>    
</div>
