<?php
    include 'config/database.php';
    include 'layout_head.php';
    if (!isset($_SESSION["userName"])){
        echo "<script>alert('Please login before using this feature'); window.location = 'login.php'</script>";
    }
    $id = $_SESSION["id"];
    $database = new Database();
    $conn = $database->getConnection();
    $query = "SELECT  `userName`, `firstName`, `lastName`, `email` FROM `users` WHERE id= ?";
    $array = array($_SESSION["id"]);
	
    $stmt = $conn->prepare($query);
    
    $stmt->execute($array);
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $userName = $row["userName"];
    $firstName = $row["firstName"];
    $lastName = $row["lastName"];
    $email = $row["email"];
    if (isset($_POST["firstname"]) && isset($_POST["lastname"])){
        
        if ($_POST["firstname"] == $firstName && $_POST["lastname"] == $lastName){
            $statusMsgType = 'alert alert-danger';
            $statusMsg = 'Nothing was changed';  
        }
        else{
            $nFirstName = $_POST["firstname"];
            $nLastName = $_POST["lastname"];
            $qr = "UPDATE `users` SET `firstName`= '$nFirstName',`lastName`= '$nLastName' WHERE id=$id";
            $stmt1 = $conn->prepare($qr);
            $stmt1->execute();
            if ($stmt1){
                // echo "<script>window.location = 'profile.php'</script>";
                $statusMsgType = 'alert alert-success';
                $statusMsg = 'Update infomation successful';  
                $lastName = $nLastName;
                $firstName = $nFirstName;
            }
            else{
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Something went wrong!'; 
            }
        }
    }

    if(isset($_POST['password'])){
        if (empty($_POST['password']) | empty($_POST['confirm_password']) | empty($_POST['cur_pass'])){
            $statusMsgPassType = 'alert alert-danger';
            $statusMsgPass = 'Input is empty!';
        }
        else {
            $cur_pass = $_POST['cur_pass'];
            //password and confirm password comparison
            if($_POST['password'] !== $_POST['confirm_password']){
                $statusMsgPassType = 'alert alert-danger';
                $statusMsgPass = 'Confirm password must match with the password.';
            }
            else if ($cur_pass == $_POST['password']){
                $statusMsgPassType = 'alert alert-danger';
                $statusMsgPass = 'New password like current password!';
            }
            else{
                $qry = "SELECT `password` FROM `users` WHERE id=$id";
                $stmt2 = $conn->prepare($qry);
                $stmt2->execute();
                $row1 = $stmt2->fetch(PDO::FETCH_ASSOC);
                if ($row1["password"] != MD5($cur_pass)){
                    $statusMsgPassType = 'alert alert-danger';
                    $statusMsgPass = 'Your current password is incorrect, please try again.';
                }
                else {
                    $nPass = MD5($_POST['password']);
                    $qur = "UPDATE `users` SET `password`= '$nPass' WHERE id=$id";
                    $stmt3 = $conn->prepare($qur);
                    $stmt3->execute();
                    if($stmt3){
                        $message = "Successful! You need to login again to apply the change.";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        echo '<script>window.location = "logout.php"</script>';
                        

                        // $statusMsgPassType = 'alert alert-success';
                        // $statusMsgPass = 'Successful! You need to login again to apply the change.';
                    }else{
                        $statusMsgPassType = 'alert alert-danger';
                        $statusMsgPass = 'Some problem occurred, please try again.';
                    }
                }
            }
        }
    }
?>



<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Profile
    </h2>
</section>


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <?php 
                        echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
                    ?>
					<form action="profile.php" method="POST">
						<h3 class="mtext-105 cl2 txt-center p-b-30 cl11">
                            Account Information
						</h3>

                        <div class="m-b-20 how-pos4-parent" style="margin-top:20px;margin-bottom:5px;">
                            <label>User Name</label>
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="text" name="name" value="<?php echo $userName; ?>" disabled>
						</div>

						<div class="m-b-20 how-pos4-parent" style="margin-top:20px;margin-bottom:5px;">
                            <label>Email</label>
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="email" name="email" value="<?php echo $email;?>" disabled>
						</div>

                        <div class="m-b-20 how-pos4-parent" style="margin-top:20px;margin-bottom:5px;">
                            <label>First Name</label>
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="text" name="firstname" value="<?php echo $firstName;?>">
						</div>

                        <div class="m-b-20 how-pos4-parent" style="margin-top:20px;margin-bottom:5px;">
                            <label>Last Name</label>
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="text" name="lastname" value="<?php echo $lastName;?>">
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Update
						</button>
					</form>

				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <form action="profile.php" method="POST">
							
                <h3 class="mtext-105 cl2 txt-center p-b-30 cl11">
                    Change Password
                </h3>
                <?php 
                    echo !empty($statusMsgPass)?'<p class="'.$statusMsgPassType.'">'.$statusMsgPass.'</p>':''; 
                ?>
                <div class="m-b-20 how-pos4-parent" style="margin-top:20px;margin-bottom:5px;">
                    <label>Password</label>
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="password" name="cur_pass" placeholder="Enter Current Password">
                </div>


                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="password" name="password" placeholder="Enter New Password">
                </div>


                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="password" name="confirm_password" placeholder="Re-type New Password">
                </div>


                <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                    Change Password
                </button>
            </form>
					
				</div>
			</div>
		</div>
	</section>	

<?php
    
    include "layout_foot.php";

?>