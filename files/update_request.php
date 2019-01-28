<?php
		
	include_once "db_connect.php";
	
	$leaveID = $_POST['leave_id'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];	
	$leave_type_id = $_POST['leave_type'];
	$num_of_days = $_POST['num_of_days'];
	$status = $_POST['status'];
	
	//echo " Num of Days: ".$num_of_days." Status: ".$status." & Leave type id: ".$leave_type_id;
	$sql = "UPDATE leave_requested SET leave_type_id = '$leave_type_id',end_date='$end_date',num_of_days='$num_of_days', status='$status' WHERE req_id = '$leaveID'";

	if ($conn->query($sql)== TRUE){
		echo "Your leave request has been updated";
	}
	else{
		echo $conn->error;
	}
	$conn->close();	
?>