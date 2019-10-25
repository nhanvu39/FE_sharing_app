<?php
    include 'layout_head.php';
?>
<div class="bg0 m-t-23 p-b-140 p-all-50">
		<div class="container">
			
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Applications
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".browser">
						Browser
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".social">
						Social
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".office">
						Office
					</button>

				</div>

				<div class="flex-w flex-c-m m-tb-10">
					
                        
						
						<button class="btn btn-primary" type="submit" onClick="window.open('/FE_sharing_app/upload.php')">
						Upload
                        </button>
					
				</div>
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>

				<!-- Filter -->
				
			</div>
            <div class="row isotope-grid">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item browser">
						<!-- Block2 -->
						<div class="block2">
						<div class="block2-pic hov-img0">
                        <a href="app.php">
			            	<img src="images/browser_chrome.png" alt="IMG-PRODUCT">
			            </a>
						
					
					
						
						</div>
						
						<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
						<a href="app.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
						Chrome
						</a>
						
						<span class="stext-105 cl3">
						
						</span>
						</div>
						
						<div class="block2-txt-child2 flex-r p-t-3">
						<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
						<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
						<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
						</a>
						</div>
						</div>
						</div>
						</div>

                       
            </div>
            <div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>


<?php
    include 'layout_foot.php';
?>