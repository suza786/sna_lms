<?php
	include_once "db_connect.php";

	$id = $_POST['emp_id'];
	$newPass = password_hash($_POST['newPass'], PASSWORD_DEFAULT);

	$sql = "UPDATE emp_details SET password='$newPass' WHERE emp_id = '$id'";
	if ($conn->query($sql)== TRUE){
		echo "success";
	}
	else{
		echo $conn->error;
	}
	$conn->close();
?>