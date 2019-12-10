<?php
    session_start();
    include ("config/database.php");
    $id = $_GET["id"];
    $database = new Database();
    $conn = $database->getConnection();
    // echo $_GET["id"];
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
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Kind</th>
                <th scope="col">Options</th>
                </tr>
            </thead>
            <?php
                if (isset($_SESSION["id"])){
                    // echo $_SESSION["id"];
                    $query = "SELECT * FROM `software` WHERE idUser=$id";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<th>'.$row['id'].'</th>';
                        echo "<td><b>".$row['name']."</b></td>";
                        echo '<td>'.$row['description'].'</td>';
                        echo '<td>'.$row['kind'].'</td>';
                        if ($row['loc']){
                            echo "<td><a href=\"unlockApp.php?id=$row[id],$id\">Unlock</a>";
                        }
                        else {
                            echo "<td><a href=\"lockApp.php?id=$row[id],$id\">Lock</a>";
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