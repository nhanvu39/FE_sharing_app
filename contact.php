<?php
	include 'layout_head.php';
	
	function emailValid($string) 
    { 
        if (preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $string)) 
			return true; 
		else {
			return false;
		}
	} 
	
	$result = "";
	if (isset($_POST["send"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		if (emailValid($email)) {
			require 'phpmailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 1;
			$mail->CharSet = 'UTF-8';
			$mail->Host = 'smtp.gmail.com';
			$mail->isSMTP();
			$mail->Port = 587;
			$mail->SMTPAuth=true;
			$mail->SMTPSecure = 'tls';
			$mail->Username = 'notificationshareapp@gmail.com';
			$mail->Password = 'Admin1234.';
			$mail->setFrom($email,$name );
			$mail->addAddress('sshareapp@gmail.com');
			$mail->addReplyTo($email,$name );
			
			$mail->Subject = 'Form Submission: from '.$name ;
			$mail->isHTML(true);
			$mail->Body= "You have received a new message from the user $name.<br /> Here is the message:<br /> ".$_POST['msg'];
			
			//$mail->MsgHTML("You have received a new message from the user $name.\n Here is the message:\n ".$_POST['msg']);
			if (!$mail->send()) {
				$result = '<div style="color: #D8000C; background-color: #FFD2D2; margin: 10px 0px; padding:12px;"> <i class="fa fa-times-circle" style="font-size:24px;margin:5px 5px;vertical-align:middle;"></i>'.'&#09;Something went wrong. Please try again.'.$mail->ErrorInfo.'</div>';
			}else {
				$result = '<div style="color: #4F8A10; background-color: #DFF2BF; margin: 10px 0px; padding:12px;"> <i class="fa fa-check-circle" style="font-size:24px;margin:5px 5px;vertical-align:middle;"></i>'.'&#09;Send sucessfully. Thanks '.$name.' for contacting us.'.'</div>';
			}
		}else {
			$result = '<div style="color: #D8000C; background-color: #FFD2D2; margin: 10px 0px; padding:12px;"><i class="fa fa-times-circle" style="font-size:24px;margin:5px 5px;vertical-align:middle;"></i>'.'&#09;Invalid email format'.'</div>';
		}
		//header("Location: ./");
		unset($_POST["send"]);
	}
	
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/contact.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Contact With Us
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
			
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="POST">
							
						<h3 class="mtext-105 cl2 txt-center p-b-30 cl11">
							Send A Message
						</h3>
						<?php echo $result; 
						$result = "";
						?>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Your Full Name">
							<img class="how-pos4 pointer-none" src="images/icons/icon-name.png" alt="mailicon">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="phone" placeholder="Your Phone">
								<img class="how-pos4 pointer-none" src="images/icons/icon-phone-call.png" alt="mailicon">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Your Email Address">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="mailicon">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Write Something Here"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="send">
							Send
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Address
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								 BachKhoa University
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Telephone Number
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								+84 984 676903
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Fax Number
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								+84 984 676903
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Admin Support
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								sshareapp@gmail.com
							</p>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>

<?php
    include 'layout_foot.php';
?>