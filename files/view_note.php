<?php
	session_start();
	include_once "db_connect.php";
	
	$req_id = $_POST['req_id'];   
	$sql_query = "SELECT note FROM leave_requested WHERE req_id = '$req_id'";
	$name = $conn->query($sql_query);

	$rows = $name->fetch_assoc();
	echo  $rows['note'];
	
	$conn->close();
?>