<?php
    $connect = mysqli_connect("localhost", "root", "", "ass");
    if(isset($_POST["idApp"])){
        $version = $_POST["version"];
        $idApp = $_POST["idApp"];
        $test_save = true;
        $linkWindows = $_POST["linkWindows"];
        $linkLinux = $_POST["linkLinux"];
        $linkMac = $_POST["linkMac"];
        if($linkMac){
            if (filter_var($linkMac, FILTER_VALIDATE_URL) === FALSE) {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Link download for MacOS is not valid format!';
                $test_save = false;
            }
        }
        if($linkLinux){
            if (filter_var($linkLinux, FILTER_VALIDATE_URL) === FALSE) {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Link download for Linux is not valid format!';
                $test_save = false;
            }
        }
        if($linkWindows){
            if (filter_var($linkWindows, FILTER_VALIDATE_URL) === FALSE) {
                $statusMsgType = 'alert alert-danger';
                $statusMsg = 'Link download for Windown is not valid format!';
                $test_save = false;
            }
        }

        if($test_save){
            $query = "INSERT INTO link(linkWindows, linkLinux, linkMac,idSoftware, version) VALUES('$linkWindows', '$linkLinux', '$linkMac', '$idApp', '$version')";
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