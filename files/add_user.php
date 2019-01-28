<?php
	session_start();
	include "db_connect.php";
	########################## Add User #############################
	//Retriving last user ID & set current user ID.
		$msg = "";
		$sql_id = "SELECT lpad(emp_id+1,4,0) AS 'empid' FROM last_emp_id";
		if($conn->query($sql_id)== TRUE){
			$name = $conn->query($sql_id);
			
			$rows = $name->fetch_assoc();
			$id = "SOLBD".$rows['empid'];
			//return $id;											
		}
		else{
			$msg = "User ID Creation Error: ".$conn->error;
		}
		$fname = $_POST['first_name'];
		$lname = $_POST['last_name'];
		$passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$email = $_POST['e_mail'];
		$supervisor = $_POST['supervisor'];
		$birth_date = $_POST['birth_date'];
		$join_date = $_POST['join_date'];
		$department = $_POST['department'];
		$location = $_POST['location'];
		$position = $_POST['position'];
		$mobile = $_POST['mobile'];
		$user_type = $_POST['user_type'];
		$note = $_POST['note'];
		
		$qry_insert = "INSERT INTO emp_details(emp_id, first_name, last_name, password, email, supervisor, birth_date, join_date, dept_id, location_id, position, mobile, user_type, note) VALUES ('$id','$fname','$lname','$passwd','$email','$supervisor','$birth_date','$join_date','$department','$location', '$position','$mobile','$user_type', '$note')";
		
		//echo $qry_insert;
		if ($conn->query($qry_insert)){
			//update last_em	p_id for next entry
			$qry_update_last_id = "UPDATE last_emp_id SET emp_id = emp_id + 1 WHERE id = 1";
			$conn->query($qry_update_last_id);
			
			// ##### Update Entitled Leave Records ###############
			date_default_timezone_set('Asia/Dhaka');
			$dt = date_create($join_date);

			$day = $dt->format("d"); //date("d");
			$month = $dt->format("m"); // date("m");
			$year = $dt->format("Y"); // date("Y");
			
			$ent_cl = (10/360)*((12-$month)*30+(30-$day)+1); 
			$ent_sl = (12/360)*((12-$month)*30+(30-$day)+1);
			$ent_el = (24/360)*((12-$month)*30+(30-$day)+1);
			
			$year_end_date = $year."-12-31";
			
			$qry_leave_days =  "INSERT INTO leave_entitled_regular (emp_id, leave_type_id, cycle_start_date, cycle_end_date, balance, leave_year) VALUES ('$id',11,'$join_date','$year_end_date', '$ent_cl', '$year');";
			
			$qry_leave_days .= "INSERT INTO leave_entitled_regular (emp_id, leave_type_id, cycle_start_date, cycle_end_date, balance, leave_year) VALUES ('$id',12,'$join_date','$year_end_date', '$ent_sl', '$year');";
			
			$qry_leave_days .= "INSERT INTO leave_entitled_regular (emp_id, leave_type_id, cycle_start_date, cycle_end_date, balance, leave_year) VALUES ('$id',13,'$join_date','$year_end_date', '$ent_el', '$year')";	
			
			//echo $qry_leave_days;

			if($conn->multi_query($qry_leave_days)){
				$msg = "success";
			}
			else{
			$msg = "Multi Query Error: ". $conn->error;
			}
		}
		else{
			$msg = "New User Insert Error: ". $conn->error;
		}
		echo $msg;
	$conn->close();
?>