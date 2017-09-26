<style>
	.was_price{
		text-decoration: line-through;
	}
</style>
<section id="menu">
			<div class="container dish-menu">
				<h2 class="wow fadeInUp animated">Menu</h2>
			</div>
			<div class="menu container">
				<div class="row">
					<?php foreach($products as $menu): ?>
					<div class="item-wrapper col-xs-12 col-sm-4 col-md-4">
						<div class="menu-item wow animated flipInX">
							<a href="<?php echo site_url(); ?>view-item/<?= $menu->slug;?>">
								<img src="<?php echo site_url(); ?>uploads/<?= $menu->pro_image;?>" alt="<?= $menu->pro_name;?>">
								<div class="w3-container caption">
									<h4><?= $menu->pro_name;?></h4>
									<p class="was_price"><span>&#8358;</span><?= $menu->pro_was_price;?></p>
									<p>N<?= $menu->pro_price;?></p>
								</div>
							</a>
							<div class="w3-container tag">
								<h4><?= $menu->pro_name;?></h4>
								<p class="was_price">N<?= $menu->pro_was_price;?></p>
								<p><span>&#8358;</span><?= $menu->pro_price;?></p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>	
				</div>
				
				<div class="more-wrap">
					<a href="<?php echo site_url('store'); ?>" class="view-more menu-items w3-btn">View More</a>
				</div>
			</div>
		</section>
