<?php
	include "layout_head.php";
	include_once "config/database.php";
	if(!$_SESSION["id"]){
		echo '<script>window.location = "index.php"</script>';
	}

	// $errorImage = $errorlink1 = $errorlink2 = $errorlink3 = $errorCategory = $errorLtype = false;
	$check_error = false;
	if (isset($_POST["Upload"])){
		$Name =  $_POST["Name"];
		$Version = $_POST["Version"];
		$Description = $_POST["Description"];

		$Category = $_POST["Category"];
		

		$Ltype = $_POST["Ltype"];
		

		$Image_name =  $_FILES['file']['name'];
		$target_dir = "images/";
		$target_file = null;
		// $image = null;
		if($Image_name != '' and !$check_error){
			$target_file = $target_dir.basename($_FILES['file']['name']);
			//File extension
			$extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			//Valid file extension
			$extensions_arr = array("jpg","jpeg","png","gif");
			// Check extension
  			if(in_array($extension,$extensions_arr) ){
				// Convert to base64 
    			// $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
    			// $image = 'data:image/'.$extension.';base64,'.$image_base64;

				// Upload file
				if(!move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
					$statusMsgType = 'alert alert-danger';
					$statusMsg = 'Error while uploading file';
					$check_error = true;
				}
			}else{
				$statusMsgType = 'alert alert-danger';
				$statusMsg = 'The file is in the wrong format. Only the following formats are accepted: jpg, jpeg, png, gif.';
				$check_error = true;
			}
		}

		$Link3 = $_POST["Link3"];
		$Link2 = $_POST["Link2"];
		$Link1 = $_POST["Link1"];
		if(!$check_error){
			if($Link1 or $Link2 or $Link3){
				if($Link3){
					if (filter_var($Link3, FILTER_VALIDATE_URL) === FALSE) {
						$statusMsgType = 'alert alert-danger';
						$statusMsg = 'Link download for MacOS is not valid format!';
						$check_error = true;
					}
				}
				if($Link2){
					if (filter_var($Link2, FILTER_VALIDATE_URL) === FALSE) {
						$statusMsgType = 'alert alert-danger';
						$statusMsg = 'Link download for Linux is not valid format!';
						$check_error = true;
					}
				}
				if($Link1){
					if (filter_var($Link1, FILTER_VALIDATE_URL) === FALSE) {
						$statusMsgType = 'alert alert-danger';
						$statusMsg = 'Link download for Windown is not valid format!';
						$check_error = true;
					}
				}
			}else{
				$statusMsgType = 'alert alert-danger';
				$statusMsg = 'At least one URL is required to download the application!';
				$check_error = true;
			}
		}
		if(!$check_error){
			$database = new Database();
			$conn = $database->getConnection();
			$idUser = $_SESSION["id"];
			$query  =  "INSERT INTO `software`( `idUser`, `name`, `description` ,`Ltype`, `kind`, `loc`, `image`) VALUES  (?,?,?,?,?,?,?) ";
			$array = array($idUser, $Name, $Description, $Ltype, $Category, false, $target_file);
			$stmt = $conn->prepare($query);
			$stmt->execute($array);
			if ($stmt){
				$errorCode = $stmt->errorCode();
				if ($errorCode != 00000) {
					$statusMsgType = 'alert alert-danger';
					$statusMsg = '[Database] Something went wrong.';
				}
				else{
					$idSoftware = $conn->lastInsertId();
					$query  = 	"INSERT INTO `link`( `linkWindows`, `linkLinux`, `linkMac`, `idSoftware`, `version`) VALUES  (?,?,?,?,?) ";
					$array = array($Link1, $Link2, $Link3, $idSoftware, $Version);
					$stmt = $conn->prepare($query);
					$stmt->execute($array);
					if ($stmt){
						$errorCode = $stmt->errorCode();
						if ($errorCode != 00000) {
							$statusMsgType = 'alert alert-danger';
							$statusMsg = '[Database] Something went wrong.';
						}
						else{
							$statusMsgType = 'alert alert-success';
							$statusMsg = 'Congratulation. Upload App successful. Click <a href="My_upload.php">here</a> to view!';
						}
					}
					else{
						$statusMsgType = 'alert alert-danger';
						$statusMsg = '[Database] Something went wrong.';
					}
				}
			}
			else{
				$statusMsgType = 'alert alert-danger';
				$statusMsg = '[Database] Something went wrong.';
			}
		}
	}
	$_POST = array();
?>
	<script>
		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
	</script>
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Upload App
		</h2>
	</section>	

	<!-- Content page -->
	
	<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
		<form action="upload.php" method="post" enctype = "multipart/form-data">
			<h3 class="mtext-105 cl2 txt-center p-b-30 cl11">
				Upload Panel
			</h3>
			<?php 
				echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
			?>
			<div class="bor8 m-b-20 how-pos4-parent">
				<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Name" placeholder="Name App" required>
			</div>
			
			<div class="bor8 m-b-20 how-pos4-parent">
				<div class="size-116 p-l-62 p-r-30" style="margin: 0 0;height:fit-content">
						<div style="float: left; margin: 0 auto;">
							<label style="float: left;">Category:</label>
							<input list="browsers" name="Category" style="color: #000; float: right; padding-left: 5px; overflow: hidden;" required>
							<datalist id="browsers">
								<option value="Media">
								<option value="Business">
								<option value="Education">
								<option value="Games">
								<option value="Graphics">
								<option value="Internet">
								<option value="Social">
								<option value="Utilities">
								<option value="Security">
							</datalist>
							<div style="clear: both;"></div>
						</div>				
						<div style="float: left; margin: 0 auto;">
							<label style="float: left; ">License Type:</label>
							<input list="Ltype" name="Ltype"  style="color: #000; float: right; padding-left: 5px; overflow: hidden;" required>
							<datalist id="Ltype">
								<option value="Adware">
								<option value="Commercial">
								<option value="Demo">
								<option value="Freeware">
								<option value="Open Source">
								<option value="Proprietary">
								<option value="Shareware">
								<option value="Trial">
							</datalist>
							<div style="clear: both;"></div>
						</div>
						<div style="clear: both;"></div>
				</div>
			</div>
			<div class="bor8 m-b-20 how-pos4-parent">
				<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Version" placeholder="Version of App" required>
			</div>
			<div class="bor8 m-b-20 how-pos4-parent">
				<p class="stext-111 cl2 plh3 p-l-62 p-r-30">Select icon for App:</p>
				<div class="size-116 p-l-62 p-r-30">
					<div style="float: left; width: 90%;"><input type='file' style="overflow: hidden;" name= "file" accept="image/*" onchange="readURL(this);" required/></div>
					<div style="float: right; width: 10%;"><img id="blah" src="http://placehold.it/50" alt="your icon" style="margin-right:20%; background:#2d2d2d; max-width:50px;"/></div>
					<div style="clear: bold"></div>
				</div>	
			</div>

			<div class="bor8 m-b-20 how-pos4-parent">
				<textarea name="Description" class="size-116 p-l-62 p-r-30" style = "height: 100px "id="description" placeholder="Description about App..."></textarea>
			</div>

			<div class="bor8 m-b-20 how-pos4-parent">
				<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Link1" placeholder="Link download windown" >			
			</div>
			<div class="bor8 m-b-20 how-pos4-parent">
				<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Link2" placeholder="Link download Linux" >			
			</div>
			<div class="bor8 m-b-20 how-pos4-parent">
				<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Link3" placeholder="Link download MacOS" >			
			</div>
			<input type ="submit" name="Upload" class="btn btn-primary btn-block" value= "Upload"></input>
		</form>
	</div>

<?php include "layout_foot.php"; ?>