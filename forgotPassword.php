<?php

include "layout_head.php";

include 'config/database.php';
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function emailValid($string) 
        { 
            if (preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $string)) 
                return true; 
            else {
                return false;
            }
        } 
if (isset($_POST["forgotSubmit"])){

        
        
        $email = $_POST['email'];
        $database = new Database();
        $conn = $database->getConnection();
        $qr = "SELECT `email`FROM `users` WHERE email= ?";
        $arr = array($email);
        $st = $conn->prepare($qr);
        $st->execute($arr);
        $row = $st->fetch(PDO::FETCH_ASSOC);
        if ($row == NULL){
            $statusMsgType = 'alert alert-danger';
            $statusMsg = 'Email is not already exist!';
        }
        else {
            $pass =generateRandomString();
            $nPass = MD5($pass);
            $qur = "UPDATE `users` SET `password`='$nPass' WHERE email= ?";
            $array = array($email);
            $stmt3 = $conn->prepare($qur);
            $stmt3->execute($array);
            if($stmt3){
                
            
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
                $mail->setFrom($email );
                $mail->addAddress($email);
                $mail->addReplyTo($email );
                
                $mail->Subject = 'Form Submission: from System ' ;
                $mail->isHTML(true);
                $mail->Body= "You have received a new message from the System Sharing App.<br /> Your new password:<br /> <b>".$pass."</b>";
                
                //$mail->MsgHTML("You have received a new message from the user $name.\n Here is the message:\n ".$_POST['msg']);
                if (!$mail->send()) {
                    $statusMsgType = 'alert alert-danger';
                    $statusMsg = 'Something went wrong!'; 
                }else {
                    $statusMsgType = 'alert alert-success';
                    $statusMsg = 'Your password was send to your email!'; 
                }
            }else {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Email is not valid!'; 
            }
            }
        }
        //header("Location: ./");
        // unset($_POST["send"]);
    
}

?>


<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 100px auto;">
    <h2 class="cl5 txt-center">
        Enter the email of your account
	</h2>

   

    <div class="container">
        <div class="regisFrm">
            <form action="forgotPassword.php" method="POST">
                <?php 
                    echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; 
                ?>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Type email here...">
                </div>
                <input type="submit" name="forgotSubmit" value="CONTINUE" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">

            </form>
        </div>
    </div>

</div>

<?php
include "layout_foot.php";
?>