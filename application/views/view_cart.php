<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    $page = "cart";
    include('section_templates/header.php'); 

    include('section_templates/cart_nav.php');
?>
<section>
		<div class="section-header">
			<div class="breadcrumb-wrapper">
				<ul class="breadcrumb">
					<li class="active">
						<a href="<?php echo site_url('Home');?>"><i class="fa fa-home"></i> Home</a>
					</li>
					<li>
						view-cart
					</li>
				</ul>
			</div>
		</div>
		<div id="view-wrapper">
            <div class="view-content">
                <div class="row">
                    <div class="w3-container">
                        <h3>My Cart</h3> 
                        <?php if($this->session->has_userdata('cart_update')): ?>
                            <?php echo $this->session->cart_update; ?>
                        <?php endif?>
                        <?php if($this->session->has_userdata('cart_delete')): ?>
                            <?php echo $this->session->cart_delete; ?>
                        <?php endif?>
                    </div>
                    <div class="table-content">
                        <?php 
                            $counter = count($this->cart->contents());
                            if ($counter > 0): 
                             
                        ?>
                        <div class="continue-shopping pull-right w3-margin-bottom">
                            <?php echo anchor('store','<button type="button" class="check-out btn cart-view-btn">
                                Continue Shoping &nbsp;<i class="fa fa-angle-double-right"></i>
                                </button>');
                            ?> 
                        </div>
                        <div id="no-more-tables">
                            <?php echo form_open('Cart/update_cart') ?> 
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Item Image</th>
                                        <th>Item Name</th>
                                        <th>Item Price</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>

                                <?php foreach ($this->cart->contents() as $items): ?>

                                <?php echo form_hidden('rowid'.$i, $items['rowid']); ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo site_url().'uploads/'.$items['options']['Image']?>" height="40px" width="50px;">
                                        </td>
                                        <td data-title="Item Name"><?= $items['name'];?></td>
                                        <td data-title="Item Price"><span>&#8358;</span><?= $items['price'];?></td>
                                        <td data-title="Item Qty">
                                        <?php echo form_input(array('maxlength' => '3', 'size' => '5', 'name' => 'qty'.$i, 'value' => $items["qty"], 'id' => 'qty-'.$items["rowid"], 'class' =>'qty form-control'));?>
                                            
                                        </td>
                                        <td data-title="Subtotal">
                                        <span>&#8358;</span><?= $this->cart->format_number($items['subtotal']); ?>
                                        <td>
                                            <?php echo anchor('Cart/delete_item/'.$items['rowid'],'<button type="button" class="remove-cart btn btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>'); ?>
                                        </td>
                                    </tr>
                                    <?php $i++;?>
                                <?php endforeach ?>
                                    <tr>
                                        <td>
                                            <button type="submit" name="update" class="update-cart btn btn-warning"  disabled>
                                                <i class="fa fa-pencil-square-o"></i> Update Cart
                                            </button>
                                        </td>
                                        <td colspan="3" align="right">
                                            <b>Total</b>
                                        </td>
                                        <td><span>&#8358;</span><?= $this->cart->format_number($this->cart->total()); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                       <td colspan="6" align="right">
                                            <?php echo anchor('Checkout/_notice/'.$session_id,'<button type="button" class="check-out btn cart-view-btn">
                                                Proceed to Checkout
                                            </button>');?>      
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php echo form_close(); ?> 
                        </div> 
                        <?php else:?>
                            <div class="empty-cart text-center">
                                <span class="">
                                    <i class="fa fa-shopping-cart fa-4x"></i>
                                </span>
                                <h3>Your Cart is Currently Empty. Select Item <?php echo anchor('store', 'Here');?> <i class="fa fa-angle-double-right"></i>.</h3>
                            </div>
                        <?php endif;?>
                    </div>    
                </div>
            </div>
			
		</div>
		<hr>
		<p class="view-footer">&copy; <a href="<?php echo site_url(); ?>">Dazinny</a> 2017 All Right Reserved.</p>
	</section>

    <script src="<?php echo site_url(); ?>assets/js/jquery lib v2.2.5.js"></script> 
	<script src="<?php echo site_url(); ?>assets/js/bootstrap.js"></script> 
    
</body>
</html>  
<script type="text/javascript">

    $(function () {
        
        $('.qty').click(function (evt) {
            var $qty = $('#'+evt.currentTarget.id); 
            
            $qty.keypress(function () {
            
                if ($('.update-cart').is(':disabled')) {
                    $('.update-cart').removeAttr('disabled');   
                }
            });
        });
        
    });
</script>  