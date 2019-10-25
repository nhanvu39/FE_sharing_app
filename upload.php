<?php
	include "layout_head.php";
	
?>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Upload File
		</h2>
	</section>	


	<!-- Content page -->
	
	<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
		<form action="register.php" method="post">
		<h3 class="mtext-105 cl2 txt-center p-b-30 cl11">
			Upload Panel
		</h3>
		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Name" placeholder="Name App" >
		</div>
		

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Kind" placeholder="Kind of app" >			
		</div>
		

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Link" placeholder="Link download" >			
		</div>
		
		
		

		<button type ="button" class="btn btn-primary btn-block">Upload</button>

		</form>
	</div>

<?php include "layout_foot.php"; ?>