<?php
    include ("layout_head.php");
    include_once "config/database.php";
    if(!$_SESSION["id"]){
		echo '<script>window.location = "index.php"</script>';
    }
    $onetime = true;
    if(!$_REQUEST['idApp']){
        echo '<script>window.location = "My_upload.php"</script>';
    }
    $id = $_REQUEST['idApp'];
    $database = $conn = $query = $stmt = null;
    $name1 = $description1 = $Ltype1 = $kind1 = $image1 = null;
    if($onetime){
        $database = new Database();
        $conn = $database->getConnection();
        $query = "SELECT name, description, Ltype, kind, image FROM software WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $name1 = $row["name"];
        $description1 = $row["description"];
        $image1 = $row["image"];
        $Ltype1 = $row["Ltype"];
        $kind1 = $row["kind"];
        $onetime = false;
    }

    $check_error = false;
    $statusMsgType = null;
    $statusMsg = null;
	if (isset($_POST["Upload"])){
        // echo 123;
		$Name =  $_POST["Name"];
		$Description = $_POST["Description"];

		$Category = $_POST["Category"];
		if(!$check_error){
			if($Category!= "Business" and  $Category != "Communications" and $Category!= "Desktop" and $Category != "Education" and $Category!= "Games" and $Category!="Graphics" and $Category!= "Internet" and $Category != "Life" and $Category!= "Media" and $Category!="Utilities" and $Category != "Security"){
				$statusMsgType = 'alert alert-danger';
				$statusMsg = 'Please select Category from options';
				$check_error = true;
			}
		}

		$Ltype = $_POST["Ltype"];
		if(!$check_error){
			if($Ltype!= "Adware" and  $Ltype != "Commercial" and $Ltype!= "Demo" and $Ltype != "Freeware" and $Ltype!= "Open Source" and $Ltype!="Proprietary" and $Ltype!= "Shareware" and $Ltype != "Trial"){
				$statusMsgType = 'alert alert-danger';
				$statusMsg = 'Please select License Type from options';
				$check_error = true;
			}
		}

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
		}else{
            $target_file = $image1;
        }

		if(!$check_error){
			$database = new Database();
			$conn = $database->getConnection();
			// $query  =  "INSERT INTO `software`(`name`, `description` ,`Ltype`, `kind`, `loc`, `image`) VALUES  (?,?,?,?,?,?,?) ";
            // $array = array($idUser, $Name, $Description, $Ltype, $Category, false, $target_file);
            $query = "UPDATE software SET name=?, description=?, Ltype=?, kind=? , image=? WHERE id=?";
            $array = array($Name,$Description,$Ltype,$Category,$target_file,$id);
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
                    $statusMsg = 'Congratulation. Update Application information successfully!';
                    //refresh!
                    $query = "SELECT name, description, Ltype, kind, image FROM software WHERE id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$id]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $name1 = $row["name"];
                    $description1 = $row["description"];
                    $image1 = $row["image"];
                    $Ltype1 = $row["Ltype"];
                    $kind1 = $row["kind"];
				}
			}
			else{
				$statusMsgType = 'alert alert-danger';
				$statusMsg = '[Database] Something went wrong.';
			}
        }
        // echo "<meta http-equiv='refresh' content='0'>";
        $_POST = array();
    }
    $_POST = array();
?>
<!--==================================================================================-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<!--==================================================================================-->
<style>
.project-tab {
    padding: 10%;
    margin-top: -8%;
}
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0062cc;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #0062cc;
    font-size: 16px;
    font-weight: 600;
}
.project-tab .nav-link:hover {
    border: none;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}
.project-tab a{
    text-decoration: none;
    color: #333;
    font-weight: 600;
}
.box_
  {
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   box-sizing:border-box;
  }
</style>
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
<!-- <div class="bg0 m-t-23 p-b-140 p-all-50"> -->
    <!-- <div class="container"> -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92">
		<h2 class="ltext-105 cl0 txt-center"  style="color: #ff8c1a">
            <?php echo $name1 ?>
		</h2>
	</section>	
        <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Edit infomation of Application</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Version management</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div style = "padding-top: 5px;">
                            <div class="bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
                            <form action=<?php echo 'Edit-app.php?idApp='.$id ?> method="post" enctype = "multipart/form-data">
                                <?php 
                                    echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
                                ?>
                                <div class="bor8 m-b-20 how-pos4-parent">
                                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="Name" placeholder="Name App" value=<?php echo $name1 ?> required>
                                </div>
                                
                                <div class="bor8 m-b-20 how-pos4-parent">
                                    <div class="size-116 p-l-62 p-r-30" style="margin: 0 0; height:fit-content">
                                            <div style="float: left; margin: 0 auto;">
                                                <label style="float: left;">Category:</label>
                                                <input list="browsers" value = <?php echo $kind1 ?> name="Category" style="color: #000; float: right; padding-left: 5px;overflow: hidden;" required>
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
                                                <input list="Ltype" value = <?php echo $Ltype1 ?> name="Ltype"  style="color: #000; float: right; padding-left: 5px;overflow: hidden;" required>
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
                                        <p class="stext-111 cl2 plh3 p-l-62 p-r-30">Select icon for App:</p>
                                        <div class="size-116 p-l-62 p-r-30">
                                            <div style="float: left; width: 90%;"><input type='file' style="overflow: hidden;" name= "file" accept="image/*" onchange="readURL(this);"/></div>
                                            <div style="float: right; width: 10%;"><img id="blah" src=<?php echo $image1 ?> alt="your icon" style="margin-right:20%; background:#2d2d2d; max-width:50px;"/></div>
                                            <div style="clear: bold"></div>
                                        </div>	
                                    </div>

                                    <div class="bor8 m-b-20 how-pos4-parent">
                                        <textarea name="Description" class="size-116 p-l-62 p-r-30" style = "height: 100px "id="description" placeholder="Description about App..."><?php echo $description1 ?></textarea>
                                    </div>
                                <input type ="submit" name="Upload" class="btn btn-primary btn-block" value= "Upload"></input>
                            </form>
                            </div>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <!-- content2 -->
                            <div class = "box_">
                            <div class="table-responsive">
                            <br>
                                <div align="right">
                                    <button type="button" name="add" id="add" class="btn btn-info">Add</button>
                                </div>
                                <br />
                                <div id="alert_message"></div>
                                <table id="app_data" class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Version</th>
                                            <th>Link Windown</th>
                                            <th>Link Linux</th>
                                            <th>Link MacOS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- </div> -->
<!-- </div> -->

<?php
	include "layout_foot.php";
?>
<!--=======================================================================================================-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<!--=======================================================================================================-->
<!--=======================================================================================================-->
<script type="text/javascript" language="javascript" >
 $(".table-responsive").ready(function(){
  
  fetch_data();

  function fetch_data()
  {
    var id = <?php echo $_REQUEST['idApp']?>;
    var dataTable = $('#app_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"./database/load_version.php",
     type:"POST",
     data:{idApp:id}
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"./database/update_version.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
        var response = JSON.parse(data);
        $('#alert_message').html('<div class="'+response.status+'">'+response.message+'</div>');
        $('#app_data').DataTable().destroy();
        fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 15000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $("#add").hide();
   $('#app_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var version = $('#data1').text();
   var link1 = $('#data2').text();
   var link2 = $('#data3').text();
   var link3 = $('#data4').text();
   var id = <?php echo $_REQUEST['idApp']?>;
   if(version != '' && (link1 != '' || link2 != '' || link3!=''))
   {
    $.ajax({
     url:"./database/insert_version.php",
     method:"POST",
     data:{idApp:id,version:version, link1:link1, link2:link2, link3:link3},
     success:function(data)
     {
      var response = JSON.parse(data);
      $('#alert_message').html('<div class="'+response.status+'">'+response.message+'</div>');
      $('#app_data').DataTable().destroy();
      $("#add").show();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 15000);
   }
   else
   {
    $('#alert_message').html('<div class="alert alert-danger">You need to fill in the version field and at least one link!</div>');
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this version?"))
   {
    $.ajax({
     url:"./database/delete_version.php",
     method:"POST",
     data:{id:id},
     success:function(data){
        var response = JSON.parse(data);
        $('#alert_message').html('<div class="'+response.status+'">'+response.message+'</div>');
        // $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
        $('#app_data').DataTable().destroy();
        fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 15000);
   }
  });
 });


</script>