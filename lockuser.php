<?php
    
    $id = $_GET['id'];
    $lock = false;
    include ("config/database.php");
    $database = new Database();
    $conn = $database->getConnection();
    $query = "UPDATE `users` SET `loc`=true WHERE id=$id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt){
        header("location:adminTable.php");
    }
    // echo $lock;
    // echo $id;
?>