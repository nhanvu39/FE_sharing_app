<?php
    $connect = mysqli_connect("localhost", "root", "", "ass");
    if(isset($_POST["id"])){
        $value = mysqli_real_escape_string($connect, $_POST["value"]);
        $query = "UPDATE link SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
        if(mysqli_query($connect, $query)){
            $statusMsgType = 'alert alert-success';
			$statusMsg = 'Congratulation. Update record successful.';
        }else{
            $statusMsgType = 'alert alert-danger';
			$statusMsg = '[Database] Something went wrong.';
        }
        echo '{"status": "'.$statusMsgType.'", "message": "'.$statusMsg.'"}';
    }
?>