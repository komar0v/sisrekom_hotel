<!-- Footer section -->
<footer class="footer-section">
	<div class="container">
		<div class="row">

			<div class="col-xl-6 col-lg-5 order-lg-1">
				<img src="<?php echo base_url('/asset_web/home_assets') ?>/img/logo_app.png" alt="" height="60" width="150">
				<div class="copyright">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Footer section end -->

<!--====== Javascripts & Jquery ======-->
<script src="<?php echo base_url('/asset_web/home_assets') ?>/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url('/asset_web/home_assets') ?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('/asset_web/home_assets') ?>/js/jquery.slicknav.min.js"></script>
<script src="<?php echo base_url('/asset_web/home_assets') ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url('/asset_web/home_assets') ?>/js/mixitup.min.js"></script>
<script src="<?php echo base_url('/asset_web/home_assets') ?>/js/main.js"></script>
<script>
	$(document).ready(function() {
		// Add smooth scrolling to all links
		$("a").on('click', function(event) {

			// Make sure this.hash has a value before overriding default behavior
			if (this.hash !== "") {
				// Prevent default anchor click behavior
				event.preventDefault();

				// Store hash
				var hash = this.hash;

				// Using jQuery's animate() method to add smooth page scroll
				// The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
				$('html, body').animate({
					scrollTop: $(hash).offset().top
				}, 800, function() {

					// Add hash (#) to URL when done scrolling (default click behavior)
					window.location.hash = hash;
				});
			} // End if
		});
	});
</script>

</body>

</html>