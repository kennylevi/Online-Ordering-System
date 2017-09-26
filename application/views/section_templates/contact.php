<section id="contact" class="nav-section">
	<div class="container contact-title">
		<h2>Contact Us</h2>
	</div>
	<div class="contact-wrapper container">
		<div class="contact-form">
			<div class="row">
				<div class="col-sm-8 col-md-8">
					<form method="post" id="con-form" name="con-form">
						<div class="row">
							<div class="col-md-12 contact-note">
								<h5>
									We are here to answer any questions you may have about our dazinny experiences. Reach out to us and we'll respond as soon as we can.
								</h5>
								<h5>
									You can also send use feed back on your dazinny experience. 
								</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="icon-addon addon-lg">
										<input type="text" name="name" placeholder="Your name" class="form-control animated zoomIn" id="name">
										<label for="name" class="fa fa-user"></label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="icon-addon addon-lg">
										<input type="email" name="email" placeholder="Your email address" class="form-control  animated zoomIn" id="email">
										<label for="email" class="fa fa-envelope"></label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control animated zoomIn" name="message" id="message" placeholder="Message" rows="7"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5 w3-margin-top">
								<div class="col-sm-8">
									<p class="sub-btn">
										<button type="submit">
											SEND
										</button>
									</p>
								</div>
								<div class="col-sm-3">
									<span class="loader-icon">
										 <img src"<?php echo site_url(); ?>assets/img/spinner.gif" >
									</span>
								</div>
							</div>
							<div class="col-md-7">
								<div id="feedback"> </div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-4 col-md-4">
					<div class="con-info w3-card-4 wow fadeInRight" data-wow-delay="1s">
						<div class="details">
							<dl>
								<dt>Email <i class="fa fa-envelope"></i></dt>
								<dd>
									<a href="mailto:info@dazinny.com.ng">info@dazinny.com.ng</a>
								</dd>
								<dt>
									Telephone <i class="fa fa-phone"></i>
								</dt>
								<dd>
									<a href="Tel:0808 948 1178">+234 808 948 1178</a><br>
									<a href="Tel:0706 644 4175">+234 706 644 4175</a>
								</dd>
								<dt>
									Address <i class="fa fa-map-marker"></i>
								</dt>
								<dd>
									SHOP 11 Phase 2 Shopping Arena,<br>
									Lanre Awolokun Street,<br> Gbagada Phase 2 by Domino Pizza,<br> Gbagada Lagos.
								</dd>
								<dt>
									Social Media
									<div class="social-icons">
										<a href="https://www.facebook.com" title="Facebook page">
											<img src="<?php echo site_url('assets/img/social/facebook.png'); ?>">
										</a>
										<a href="https://www.twitter.com" title="Twitter Handle">
											<img src="<?php echo site_url('assets/img/social/twitter.png'); ?>">
										</a>
										<a href="https://www.instagram.com" title="Instagram">
											<img src="<?php echo site_url('assets/img/social/instagram.png'); ?>">
										</a>
									</div>
								</dt>
							</dl>
						</div>	
					</div>
				</div>
			</div>
			<!-- form contents ends here -->
			
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {

		$("#con-form").validate({

			rules:{
				name: "required",
				email:{
					required: true,
					email: true
				},
				message: "required"
			},
			messages:{
				name: "Please enter your name",
				email:{
					required: "Please enter your email address"
				},
				message: "your message is required"
			},
			submitHandler: function() {
				//submit the form
				var string = $("#con-form").serialize(); 
				// $.post("<?php// echo site_url('emailHandler/mailer');?>", 
					$('.loader-icon').show();
				$.ajax({
					url: "<?php echo site_url('emailHandler/mailer');?>",
					method: "POST",
					dataType: "JSON",
					data: string,
					success: function(data) {
						$('.loader-icon').fadeOut();
						$("#con-form")[0].reset();
						$('#feedback').html(data.msg);
					}
				});	   
			}
		}); //validate the form
	});
</script>