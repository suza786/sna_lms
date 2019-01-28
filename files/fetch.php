<?php
	include_once "db_connect.php";

	if($_POST['emp_id'] != ''){
		$sql = "SELECT * FROM vw_emp_details WHERE emp_id ='".$_POST['emp_id']."'";
		
		if ($conn->query($sql)== TRUE){
			$result = $conn->query($sql);
			$row = $result->fetch_array();
			echo json_encode($row);
		}
		else{
			echo $conn->error;
		}
	}
	$conn->close();
?>