<?php
	include_once "db_connect.php";

	$sql = "UPDATE emp_details SET user_status = 'disable' WHERE emp_id ='".$_POST['emp_id']."'";
	
	if ($conn->query($sql)== TRUE){
		echo "success";	
	}
	else{
		echo $conn->error;
	}

	$conn->close();
?>