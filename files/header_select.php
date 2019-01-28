<?php
	//session_start(); //starts the session
	//$dir = $_SERVER["DOCUMENT_ROOT"]. "/szlms-hm";
	include_once "db_connect.php"; 
	
	if($_SESSION['user']){ // checks if the user is logged in  
   	}
   	else{
      header("location: /sna_lms/index.php"); // redirects if user is not logged in
   	}
   $user = $_SESSION['user']; //assigns user value
   //echo $user;
	$sql_qry = "SELECT 	user_type FROM emp_details WHERE emp_id = '$user' ";
	if($conn->query($sql_qry)== TRUE){
		$record = $conn->query($sql_qry);
		$info = $record->fetch_assoc();
		if($info['user_type']=="User"){
			include_once "header_user.php";	 
		}
		else{
			include_once "header_hr.php";	 
		}
	}
	else{
		echo $conn->error;
	}
?>