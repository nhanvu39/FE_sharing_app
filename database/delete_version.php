<?php
    $connect = mysqli_connect("localhost", "root", "", "ass");
    if(isset($_POST["id"])){
        $query = "DELETE FROM link WHERE id = '".$_POST["id"]."'";
        if(mysqli_query($connect, $query)){
            $statusMsgType = 'alert alert-success';
			$statusMsg = 'Congratulation. Delete record successful.';
        }else{
            $statusMsgType = 'alert alert-danger';
			$statusMsg = '[Database] Something went wrong.';
        }
        echo '{"status": "'.$statusMsgType.'", "message": "'.$statusMsg.'"}';
    }
?>