<?php
    $id = $_GET['id'];
    $pi = explode(",", $id);
    $ida = $pi[0];
    $idu = $pi[1];
    $lock = false;
    include ("config/database.php");
    $database = new Database();
    $conn = $database->getConnection();
    $query = "UPDATE `software` SET `loc`=true WHERE id=$ida";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt){
        header("location:softwareUser.php?id=$idu");
    }
    // echo $lock;
    // echo $id;
    // echo $ida;
?>