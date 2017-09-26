<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    $page = "store";
    include('section_templates/header.php');
    include('section_templates/cart_nav.php');  
?>
<body>
    <section>
		<div class="section-header">
			<div class="breadcrumb-wrapper">
				<ul class="breadcrumb">
					<li class="active">
						<a href="<?php echo site_url('Home');?>"><i class="fa fa-home"></i> Home</a>
					</li>
					<li>
						<i class="fa fa-th"></i> 
                        Store
					</li>
				</ul>
			</div>
		</div>
        <div id="view-wrapper">
            <div class="store-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                        <?php foreach($store_item as $items) :?>
                            <div class="col-sm-6 col-md-4 animated fadeIn">
                                <div class="item-container">
                                    <a href="<?php echo site_url().'view-item/'.$items->slug?>">
                                        <img class="img-responsive img-thumbnail" src="<?php echo site_url().'uploads/'.$items->pro_image; ?>" alt="dazinny-<?= $items->pro_name;?>">
                                    </a>
                                    <div class="W3-container text-center">
                                        <h5><?= $items->pro_name;?></h5>
                                        <p>
                                            <span class="was-price"><span>&#8358;</span><?= $items->pro_was_price?></span><br>
                                            <span class="price"><span>&#8358;</span><?= $items->pro_price?></span>
                                        </p>
                                        <?php echo form_open('Cart/add_to_cart');
                                            echo form_hidden('pro_id', $items->pro_id);
                                            echo form_hidden('qty', 1);
                                        ?>
                                            <button type="submit" class="btn animated cart-view-btn">Buy Now</button>
                                        <?php echo form_close();?>
                                    </div>
                                </div>    
                            </div>
                        <?php endforeach;?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <aside>
                            <div class="store-category">
                                <h3>Store Item Categories</h3>
                                <?php
                                    $cat_name = $category['cat_name'];
                                    $products = $category['products'];
                                ?>
                                <ul class="nav">
                                    <?php foreach ($cat_name as $key => $cat): ?>
                                    <?php $name = $cat; $items = $products[$key];?>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$name->cat_name; ?>
                                            <span class="pull-right caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                        <?php if($items): ?>    
                                            <?php foreach($items as $item) : ?>
                                                <li>
                                                    <a href="<?php echo site_url().'view-item/'.$item->slug?>">
                                                        <i class="fa fa-angle-right"></i>&nbsp;<?= $item->pro_name;?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>    
                                            <li>
                                                Not Avialable Yet
                                            </li>
                                        <?php endif; ?>    
                                        </ul>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="paginations-wraps">
                    <ul class="pagination">
                         <?php print $pagination_links;?>
                    </ul>  
                </div>
            </div>
        </div>    
		<hr>
		<p class="view-footer">&copy; <a href="<?php echo site_url(); ?>">Dazinny</a> 2017 All Right Reserved.</p>
	
    </section>

    <script src="<?php echo site_url(); ?>assets/js/bootstrap.js"></script>
     <script src="<?php echo site_url(); ?>assets/js/wow.min.js"></script> 
    
</body>
</html>
<script type="text/javascript">
      new WOW().init();	
   $(document).ready(function (){   
    //    making aside section fixed when scroll
        $(Window).scroll(function () {
            if ($(window).width() > 992) {
                if ($(this).scrollTop() > 100 ){
                    $('aside').addClass('add-fixed');  
                }else{
                    $('aside').removeClass('add-fixed');
                }
            }
        });
   });     
</script>