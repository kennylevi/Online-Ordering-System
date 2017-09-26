<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$page = 'home';
	include('section_templates/header.php');  
?>
<body>
	<?php include('section_templates/nav.php'); ?>
	<div id="wrapper">
		
		<!-- page slider  -->
			<?php include('section_templates/slider.php'); ?>
		<!-- page slider ends -->

    <!-- About section -->
        <?php include('section_templates/about.php'); ?>
    <!-- About section ends here -->

		<!-- menu section -->
			<?php include('section_templates/menu.php'); ?>
		<!-- menu section end here -->

        <!-- Reservation section -->
            <?php include('section_templates/reservation.php'); ?>
        <!-- Reservation ends here -->

		<!-- location section -->
		<section id="location" class="nav-section">
			<div class="container location">
				<h2>Locate Us</h2>
			</div>
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.7958533052806!2d3.3825032999999998!3d6.5474416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8d74ef1c523d%3A0x917eae48db93bc31!2sDazinny+Shawarma!5e0!3m2!1sen!2sng!4v1501796494568" allowfullscreen></iframe>
			</div>
		</section>

		<!-- contact section -->
			<?php include('section_templates/contact.php'); ?>
		<!-- contact ends here -->
	</div>
	      
	<!-- footer section -->
		<?php include('section_templates/footer.php'); ?>
	<!-- footer end here -->
</body>
</html>
<script type="text/javascript">
	// contact form validation

 new WOW().init();	

</script>