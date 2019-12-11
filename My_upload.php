<?php
include 'layout_head.php';
include_once "config/database.php";
include_once "object/software.php";
if (!$_SESSION["id"]) {
    echo '<script>window.location = "index.php"</script>';
}
$dbs = new Database();
$db = $dbs->getConnection();

$software = new Software($db);
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1; //page is current page, if there's nothing set, default is 1
$records_per_page = 4; //set records or row of data per page
$record_num = $records_per_page * $page; //calculate for the query LIMIT clause

//read all products in the database
$stmt = $software->readfollowIdUser($_SESSION["id"], $record_num);
?>
<div class="bg0 m-t-23 p-b-140 p-all-50">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    All Applications
                </button>
                <?php
                $stmt_allKind = $software->getAllKind();
                while ($row = $stmt_allKind->fetch(PDO::FETCH_ASSOC)) {
                    echo '<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".' . strtoupper($row["kind"]) . '">';
                    echo $row["kind"];
                    echo '</button>';
                }
                ?>
            </div>

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
        
        <div class="flex-w flex-c-m m-tb-10" style="justify-content: flex-end;">
            <button class="btn btn-primary" type="submit" onClick="window.location = 'upload.php'">
                Upload new App
            </button>
        </div>
        <?php
        $num = $stmt->rowCount();
        if ($num > 0) {
            echo '<div class="row isotope-grid">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $kind = $row["kind"];
                $image = $row["image"];
                $name = $row["name"];
                $id = $row["id"];
                // $ltype = $row["Ltype"];
                echo '<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ' . $kind . '">
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                        <img src="' . $image . '" alt="IMG-PRODUCT" class = "icon_app">
                                </div>
                                <div class="block2-txt-child1 flex-col-l">
                                    <span class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        ' . $name . '
                                    </span>
                                </div>
                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l">
                                        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; width: 100%">
                                            <button type="button" onClick = "window.location = \'Edit-app.php?idApp=' . $id .'\" class="btn btn btn-info" style="width: 50%">Edit</button>
                                            <button type="button" onClick = "deleteApp(' . '\'' . $id . '\'' . ')" class="btn btn-warning" style="width: 40%"> Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
            echo '</div>';
            echo '<div class="flex-c-m flex-w w-full p-t-45">
                    <a href="My_upload.php?page=' . ($page + 1) . '" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        Load More
                    </a>
                    </div>';
        } else {
            echo "<div class='col-md-12";
            echo "<div class='alert alert-danger'>No Applications found. </div>";
            echo "</div>";
        }
        ?>
    </div>
</div>
</div>
</div>
<?php
include 'layout_foot.php';
?>
<script>
    function deleteApp(id) {
        if (confirm("Are you really want delete this App!")) {
            var appid = id;
            var datatoSend = 'appid=' + id;
            $.ajax({
                type: 'POST',
                cache: false,
                url: "./database/delete_app.php",
                data: {
                    id: appid
                },
                error: function(e) {
                    var response = e.responseText;
                    alert(response);
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                async: true
                // dataType: "json",
                // contentType: "application/json"
            });
        }
    }
</script>