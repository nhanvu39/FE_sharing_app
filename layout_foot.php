	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-4 p-b-50">
					<h2 style="font-family: Montserrat-Bold; text-transform: uppercase;" class="cl0 p-b-30">ShareApp.com</h2>
					<p class="footer-links">
						<a href="index.php">Home</a>
						·
						<a href="show_app.php">Explore</a>
						·
						<a href="blog.php">Blog</a>
						·
						<a href="about.php">About</a>
						·
						<a href="contact.php">Contact</a>
					</p>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Contact
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in Laboratory 602 at 6th floor, BachKhoa University or email us: support@hcmut.edu.vn
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-50">
					<!-- <h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="example@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form> -->
					<h4 class="stext-301 cl0 p-b-30">
						development team members
					</h4>
					<ul>
						<li class="p-b-10">
							<p class="stext-106 cl7 hov-cl1 trans-04">
								Trần Nhân Vũ
							</p>
						</li>

						<li class="p-b-10">
							<p class="stext-106 cl7 hov-cl1 trans-04">
								Lê Hoàng Kim
							</p>
						</li>

						<li class="p-b-10">
							<p class="stext-106 cl7 hov-cl1 trans-04">
								Nguyễn Phạm Phương Vy
							</p>
						</li>

						<li class="p-b-10">
							<p class="stext-106 cl7 hov-cl1 trans-04">
								Nguyễn Văn Sơn
							</p>
						</li>
					</ul>
				</div>
			</div>

			<div class="p-t-40">
				<p class="stext-107 cl6 txt-center">
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved
				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="quick_view">

				</div>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function() { //when select size
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e) {
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function() { //tick and untick heart when click
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function() {
				if ($(this).hasClass('js-addedwish-b2')) {
					$(this).removeClass('js-addedwish-b2');
				} else {
					swal(nameProduct, "is added to wishlist !", "success");
					$(this).addClass('js-addedwish-b2');
				}
			});
		});

		$('.js-addwish-detail').each(function() { //doing similiar in detail
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function() {
				if ($(this).hasClass('js-addedwish-detail')) {
					$(this).removeClass('js-addedwish-detail');
				} else {
					swal(nameProduct, "is added to wishlist !", "success");
					$(this).addClass('js-addedwish-detail');
				}
			});
		});
		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function() { //action when add to cart
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html(); //get name of product
			$(this).on('click', function() {
				swal(nameProduct, "is added to cart !", "success"); //alert success jQuery
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function() {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function() {
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

	</body>

	</html>