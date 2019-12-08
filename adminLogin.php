<?php
    session_start();
    session_destroy();
    session_start();
    include ("config/database.php");
	$database = new Database();
    $conn = $database->getConnection();
    if (isset($_POST["login"])){
		
		$userName = $_POST["userName"];
		$password = $_POST["password"];
		
		$query  =  "SELECT id, firstName, lastName, loc, isAdmin  FROM users WHERE userName = ? AND  password = ? ";
		$password = MD5($password);
		$array = array($userName, $password);
		
		$stmt = $conn->prepare($query);
		
		$stmt->execute($array);
		
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row != NULL){
            if ($row["isAdmin"]){
				$_SESSION["userName"] = $userName;
				$_SESSION["id"] = $row["id"];
                // echo $_SESSION["id"];
                echo '<script>window.location = "adminTable.php"</script>';
            }
            else {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Account is not admin!';
            }
		}
		else{
			$statusMsgType = 'alert alert-danger';
            $statusMsg = 'The username or password are incorrect!'; 
		}
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>


<body>
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/123.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Login
	</h2>
</section>


<!-- Content page -->

<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 100px auto;">
	<form action="adminLogin.php" method="POST">
		<h3 class="mtext-105 cl2 txt-center p-b-30 cl11">
			Login Panel
		</h3>
		<?php 
			echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
		?>
		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="userName" placeholder="User Name">
		</div>

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" placeholder="Password">
		</div>

		<input type="submit" name="login" value="Login" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
	</form>
	
</div>
</body>
</html>