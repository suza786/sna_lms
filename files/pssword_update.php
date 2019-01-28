<?php
	include_once "db_connect.php";

	$id = $_POST['emp_id'];
	$oldPass = $_POST['oldPass'];
	$newPass = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
		
	$sql = "SELECT password FROM emp_details WHERE emp_id='$id'";
	$result = $conn->query($sql);
	
	if ( $result->num_rows > 0){
		$row = $result->fetch_assoc();
		
		if(password_verify($oldPass, $row['password']) == 1 or $oldPass == $row['password']){
			
			$sql = "UPDATE emp_details SET password='$newPass' WHERE emp_id = '$id'";
	
			if ($conn->query($sql)== TRUE){
				echo "success";
			}
			else{
				echo $conn->error;
			}
		}else{
			echo "Password is worng.";
		}
	}
	else{
		echo "Envalid User ID.";
	}
	$conn->close();
?>