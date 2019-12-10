<?php
    include_once "../config/database.php";
    $dbs = new Database();

	if(isset($_POST['id'])){
		$idApp = $_POST['id'];
		$conn = $dbs->getConnection();
		//delete version
		$query = "DELETE FROM link WHERE idSoftware=?";
		$stmt = $conn->prepare($query);
		$stmt->execute([$idApp]);
		$statusMsg = null;
		if ($stmt){
			$errorCode = $stmt->errorCode();
			if ($errorCode != 00000) {
				$statusMsg = '[Database] Something went wrong.';
			}
			else{
				//delete app
				$query = "DELETE FROM software WHERE id=?";
				$stmt = $conn->prepare($query);
				$stmt->execute([$idApp]);
				if ($stmt){
					$errorCode = $stmt->errorCode();
					if ($errorCode != 00000) {
						$statusMsg = '[Database] Something went wrong.';
					}
					else{
						$statusMsg = 'Congratulation. Delete App successfully!';
					}
				}
				else{
					$statusMsg = '[Database] Something went wrong.';
				}
			}
		}
		else{
			$statusMsg = '[Database] Something went wrong.';
		}
		echo $statusMsg;
	}
?>