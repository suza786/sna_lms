<?php
	session_start();
	include_once "db_connect.php";
	########################## Edit User #############################

	$id = $_POST['emp_id'];
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$email = $_POST['e_mail'];
	$supervisor = $_POST['supervisor'];
	$birth_date = $_POST['birth_date'];
	$join_date = $_POST['join_date'];
	$position = $_POST['position'];
	$mobile = $_POST['mobile'];
	$user_type = $_POST['user_type'];
	$note = $_POST['note'];
	
	$department = $_POST['department'];
	/*switch($department){
		case "Program":
			$department = 2;
			break;
			
		case "Operation":
			$department = 3;
			break;
			
		case "Finance":
			$department = 4;
			break;			
		default:
			break;
	}*/
	$location = $_POST['location'];
	switch($location){
		case "Dhaka":
			$location = 1;
			break;
			
		case "Khulna":
			$location = 2;
			break;
			
		case "Jeshore":
			$location = 3;
			break;
			
		case "Noakhali":
			$location = 4;
			break;	
						
		default:
			break;
	}
	
	$sql = "UPDATE emp_details SET first_name='$fname', last_name='$lname', email='$email', supervisor='$supervisor', birth_date='$birth_date', join_date='$join_date', dept_id='$department', location_id='$location', position='$position', mobile='$mobile', user_type='$user_type', note='$note' WHERE emp_id = '$id'";
	
	if ($conn->query($sql)== TRUE){
		echo "success";
	}
	else{
		echo $conn->error;
	}
			
	$conn->close();
	//echo "Data ".$fname. " ".$lname." ".$email." ".$position;
?>