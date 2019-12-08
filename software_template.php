	<!-- Software -->
	<div class="bg0 m-t-23 p-b-140 p-all-50">
	    <div class="container">
	        <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : '';  ?>
	        <div class="flex-w flex-sb-m p-b-52">
	            <!-- Menu -->
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

	                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".program">
	                    Tool Program
	                </button>

	            </div>

	            <!-- Filter -->
	            <div class="flex-w flex-c-m m-tb-10">

	                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
	                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
	                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
	                    Search
	                </div>
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
	        </div>


	        <!-- show all product -->
	        <div class="row isotope-grid">
	            <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $kind = $row["kind"];
                    $image = $row["image"];
                    $name = $row["name"];
                    $id = $row["id"];
                    echo '<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ' . $kind . '">';
                    echo '<!-- Block2 -->';
                    echo '<div class="block2">';
                    echo '<div class="block2-pic hov-img0">';
                    echo '<a href="app.php?id=' . $id . '" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">';
                    echo '<img src="images/' . $image . '" alt="IMG-PRODUCT">';
                    echo '</a>';
                    echo '';
                    echo '<a href="#"' .  ' class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">';
                    echo 'Quick View';
                    echo '</a>';
                    echo '</div>';
                    echo '';
                    echo '<div class="block2-txt flex-w flex-t p-t-14">';
                    echo '<div class="block2-txt-child1 flex-col-l ">';
                    echo '<a href="app.php?id=' . $id . '" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">';
                    echo $name;
                    echo '</a>';
                    echo '';
                    echo '<span class="stext-105 cl3">';
                    // echo '$ '.$price;
                    echo '</span>';
                    echo '</div>';
                    echo '';
                    echo '<div class="block2-txt-child2 flex-r p-t-3">';
                    echo '<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">';
                    echo '<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">';
                    echo '<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

	        </div>

	        <!-- Load more -->
	        <div class="flex-c-m flex-w w-full p-t-45">
	            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
	                Load More
	            </a>
	        </div>
	    </div>
	</div>