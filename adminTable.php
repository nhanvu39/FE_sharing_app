<?php
    session_start();
    include ("config/database.php");
    $database = new Database();
    $conn = $database->getConnection();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style ="margin-top: 30px;">
            <h2 style="text-align:center;"> Users Table</h2>
            
            <a style = "margin-bottom: 10px; margin-left: 90%;" href="logout.php" class="btn btn-info " role="button">Logout</a>
            
            <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">UserName</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Options</th>
                </tr>
            </thead>
            <?php
                if (isset($_SESSION["id"])){
                    // echo $_SESSION["id"];
                    $query = "SELECT * FROM `users` WHERE 1";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<th>'.$row['id'].'</th>';
                        echo "<td><a href=\"softwareUser.php?id=$row[id]\">".$row['userName']."</td>";
                        echo '<td>'.$row['firstName'].'</td>';
                        echo '<td>'.$row['lastName'].'</td>';
                        echo '<td>'.$row['email'].'</td>';
                        if ($row['loc']){
                            echo "<td><a href=\"unlockUser.php?id=$row[id]\">Unlock</a>";
                        }
                        else {
                            echo "<td><a href=\"lockuser.php?id=$row[id]\">Lock</a>";
                        }
                        echo '</tr>';
                        echo '</tbody>';
                    }
                }
            ?>
            
            </table>
        </div>
    </body>
</html>