<?php
include_once "config/database.php";
include_once "object/software.php";

// Get database connection
$dbs = new Database();
$db = $dbs->getConnection();

$software = new Software($db);

include 'layout_head.php';
?>

<?php
//for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; //page is current page, if there's nothing set, default is 1
$records_per_page = 4; //set records or row of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; //calculate for the query LIMIT clause


//read all products in the database
$stmt = $software->read($from_record_num, $records_per_page);

//count number of retrieved products
$num = $stmt->rowCount();

//if products retrieved more than zero
if ($num > 0) {
	//needed for paging
	$page_url = "show_app.php?";
	$total_rows = $software->count();
	//show products
	include_once "software_template.php";
}
//tell user if there's no products in the database
else {
	echo "<div class='col-md-12";
	echo "<div class='alert alert-danger'>No products found. </div>";
	echo "</div>";
}

?>

<?php
include 'layout_foot.php';
?>