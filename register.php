<?php
	include "layout_head.php";
	include_once "config/database.php";
	if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
		echo '<script>window.location = "index.php"</script>';
	}
	$flag = true;
	if (isset($_POST["submit"])){
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$userName = $_POST["userName"];
		$password = $_POST["password"];
		$Rpassword = $_POST["passwordRepeat"];
		$email = $_POST["email"];
		if (strlen($firstName) < 2 || strlen($firstName) > 50) {
			$statusMsgType = 'alert alert-danger';
            $statusMsg = 'Length of first name must from 2 to 50 charater!'; 
			$flag = false;
		}
		if (strlen($lastName) < 2 || strlen($lastName) > 30) {	
			$statusMsgType = 'alert alert-danger';
            $statusMsg = 'Length of last name must from 2 to 30 charater!'; 
			$flag = false;
		}
		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$statusMsgType = 'alert alert-danger';
            $statusMsg = 'Email format invalid!'; 
			$flag = false;
		}
		if (strlen($userName) < 2 || strlen($userName) > 30) {
			$statusMsgType = 'alert alert-danger';
            $statusMsg = 'Length username must from 2 to 30 charater!!'; 				
			$flag = false;
		}
		if (strlen($password) < 2 || strlen($password) > 30) {	
			$statusMsgType = 'alert alert-danger';
            $statusMsg = 'Length password must from 2 to 30 charater!!'; 				
			$flag = false;
		}
		if ($_POST["password"] != $_POST["passwordRepeat"]) {
			$statusMsgType = 'alert alert-danger';
            $statusMsg = 'Confirm password must match with the password.';
			$flag = false;
		}
		if ($flag) {
			//get database connection
			$database = new Database();
			$conn = $database->getConnection();
			$qr = "SELECT `userName` FROM `users` WHERE userName = ? OR email = ?";
			// echo $email;
			$arr = array($userName,$email);
			$st = $conn->prepare($qr);
			$st->execute($arr);
			$row = $st->fetch(PDO::FETCH_ASSOC);

			if ($row != NULL){
				$statusMsgType = 'alert alert-danger';
				$statusMsg = 'Username or email  already exists!';
			}
			else{
				$query  =  "INSERT INTO `users`( `userName`, `password`, `firstName`, `lastName`, `email`, `loc`, `isAdmin` ) VALUES  (?,?,?,?,?,?,?) ";
				$password = MD5($password);
				$array = array( $userName, $password, $firstName, $lastName, $email,false,false);
				
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
						$statusMsg = 'Congratulation. Register successful. Click <a href="login.php">here</a> to login';
					}
				}
				else{
					$statusMsgType = 'alert alert-danger';
					$statusMsg = '[Database] Something went wrong.';
				}
			}
		}
	}
?>

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/123.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Register
		</h2>
	</section>	


	<!-- Content page -->
	
	<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
		<form action="register.php" method="post">
		<h3 class="mtext-105 cl2 txt-center p-b-30 cl11">
			Register Panel
		</h3>
		<?php 
			echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
		?>
		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="firstName" placeholder="First Name" >
		</div>
		

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="lastName" placeholder="Last Name" >			
		</div>
		

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Email" >			
		</div>
		
		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="userName" placeholder="User Name" >			
		</div>
		

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" placeholder="Password" >		
		</div>
		

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="passwordRepeat" placeholder="Repeat Password" >			
		</div>
		

		<input onclick="checkError()" type="submit" name="submit" value="register" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">

		</form>
	</div>

<?php include "layout_foot.php"; ?>