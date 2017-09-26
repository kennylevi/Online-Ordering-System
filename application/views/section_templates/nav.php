	<header class="header">
		<div class="nav-wrapper">
			<nav class="navbar">
				<div class="container-fluid">
					<div class="navbar-header">
		            	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-wrap" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar w3-green"></span>
							<span class="icon-bar w3-green"></span>
							<span class="icon-bar w3-green"></span>
						</button>
						<a class="navbar-brand" id="brand" href="<?php echo site_url(); ?>">
	                        <div class="row">
	                            <div class="col-sm-8">
	                                <img src="<?php echo site_url('assets/img/DAZINNY-logo.png');?>" class="img-responsive" alt="Dazinny logo">
	                            </div>
	                            <div class="col-sm-4"></div>
	                        </div>
                    	</a>
			        </div>    
		            <div class="collapse navbar-collapse" id="menu-wrap">
		                <ul class="nav navbar-nav navbar-right" id="menus">
		                    <li><a href="" class="">Home</a></li>
		                    <li><a href="#About" class="">About Us</a></li>
		                    <li><a href="#menu" class="">Menu</a></li>
		                    <li><a href="#reservation" class="">Reservation</a></li>
		                    <li><a href="#location" class="">Location</a></li>
							<li><a href="#contact" class="">Contact Us</a></li> 
							
							<li class="cart pull-right">
								<a href="<?php echo site_url().'view-cart'?>">
									<img src="<?php echo site_url().'assets/img/cart.png'?>" alt="dazinny-cart-icon">
								</a>
							</li>
		                </ul>
		            </div>      
				</div>
			</nav>
		</div>
	</header>