<?php
    $connect = mysqli_connect("localhost", "root", "", "ass");
    if(isset($_POST["idApp"])){
        $version = $_POST["version"];
        $idApp = $_POST["idApp"];
        $test_save = true;
        $link1 = $_POST["link1"];
        $link2 = $_POST["link2"];
        $link3 = $_POST["link3"];
        if($link3){
            if (filter_var($link3, FILTER_VALIDATE_URL) === FALSE) {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Link download for MacOS is not valid format!';
                $test_save = false;
            }
        }
        if($link2){
            if (filter_var($link2, FILTER_VALIDATE_URL) === FALSE) {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Link download for Linux is not valid format!';
                $test_save = false;
            }
        }
        if($link1){
            if (filter_var($link1, FILTER_VALIDATE_URL) === FALSE) {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Link download for Windown is not valid format!';
                $test_save = false;
            }
        }

        if($test_save){
            $query = "INSERT INTO link(link1, link2, link3,idSoftware, version) VALUES('$link1', '$link2', '$link3', '$idApp', '$version')";
            if(mysqli_query($connect, $query)){
                $statusMsgType = 'alert alert-success';
				$statusMsg = 'Congratulation. Insert New version successful.';
            }else{
                $statusMsgType = 'alert alert-danger';
				$statusMsg = '[Database] Something went wrong.';
            }
        }
        echo '{"status": "'.$statusMsgType.'", "message": "'.$statusMsg.'"}';
    }
?>