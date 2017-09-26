<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	$page = 'view_item';
	foreach($response as $items){
		$name = $items->pro_name;
		$desc = $items->pro_description;
		$image = $items->pro_image;
		$data['item_id'] =$items->pro_id;
		$data['price'] = $items->pro_price;
	}
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
						View-Item(<?=$name;?>)
					</li>
				</ul>
			</div>
		</div>
		<div id="view-wrapper">
            <div class="view-content">
                <div class="row">
                    <div class="col-md-5 col-lg-5">
                        <img class="img-responsive" src="<?php echo site_url();?>uploads/<?=$image;?>" alt="<?= $name;?>"/>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h2><?= strtoupper($name); ?></h2>
                        <p class="desc"><?= $desc;?></p>
                    </div>
                    <div class="col-lg-3 col-md-3">
						<?php $this->load->view('add_to_cart', $data);?>
                    </div>  
                </div>
            </div>
			<div class="product_suggestion">
				<?php if($count_suggestion > 0):?>
					<div class="row">
						<div class="w3-container">
							<h4>Related Items:</h4>
						</div>
						<?php foreach ($pro_suggestion as $key => $products): ?>
							<?php if ($products->pro_name == $name) : ?>
								<?php $products = ""; ?>
							<?php else : ?>
							<div class="col-sm-3">
								<img class="img-responsive img-thumbnail" src="<?= site_url(); ?>uploads/<?=$products->pro_image;?>" alt="<?=$products->pro_name;?>">
								<h5><?= $products->pro_name;?></h5>
								<p>
									<span class="was_price">N<?= $products->pro_was_price;?></span>
									 &nbsp;
									<span class="price">N<?= $products->pro_price;?></span>
								</p>
							</div>
							<?php endif;?>
						<?php endforeach;?>
					</div>
				<?php endif;?>
			</div>
		</div>
		<hr>
		<p class="view-footer">&copy; <a href="<?php echo site_url(); ?>">Dazinny</a> 2017 All Right Reserved.</p>
	</section>

	<script src="<?php echo site_url(); ?>assets/js/bootstrap.js"></script> 
    
</body>
</html>    