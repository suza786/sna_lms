<?php
	include_once "db_connect.php";

	date_default_timezone_set('Asia/Dhaka'); //Set TimeZone
	//Retriving last entry of date information form database.
	$qry_date = "SELECT month, year FROM cur_date";
	$name = $conn->query($qry_date);
	
	$rows = $name->fetch_assoc();
	$last_month = $rows['month'];
	$last_year = $rows['year'];
	
	//Retriving current date information form database.
	//$today = $dt->format("d"); //date("d");
	$cur_month = date("m"); // date("m");
	$cur_year = date("Y"); // date("Y");
	
	$year_start_date = $cur_year."-01-01";
	$year_end_date = $cur_year."-12-31";
	
	// ################### Section for Increase Earned Leave in every month #########################
	if($cur_month > $last_month and $cur_year == $last_year ){
		$qry_update_el = "UPDATE leave_entitled_regular SET balance = balance+2 WHERE leave_type_id = 13 AND leave_year = '$cur_year'";
		$conn->query($qry_update_el);
		
		$qry_update_date = "UPDATE cur_date SET month = '$cur_month' WHERE id = 1";
		$conn->query($qry_update_date);
	}else{
		//echo "Month Updated";
	}
	
	//echo "<br/> <br/> Date Year : ".$last_year." ".$cur_year;
	//echo "<br/> Date Month :".$last_month." ".$cur_month;
	
	// ############# Set leave entitled days in year begining for existing user #########################
	if($cur_year > $last_year){
		$sql_query = "SELECT emp_id FROM emp_details WHERE user_status = 'enable'";
		$name = $conn->query($sql_query);
		
		while ($rows = $name->fetch_assoc()){
			$emp_id = $rows['emp_id'];
			echo $emp_id."<br/>";
				
		//##################### section for auto leave forwording to next year ######################
		
			//##################### Checking available EL for forwording to next year ######################
			$sql_el = "SELECT leave_type_id, balance FROM leave_entitled_regular WHERE emp_id = '$emp_id' AND leave_type_id = 13";
			$exe_query_el = $conn->query($sql_el);
			$result1 = $exe_query_el->fetch_assoc();
			$last_balance_el = $result1['balance'] > 10? 10:$result1['balance'];
			
			//##################### Checking total SL as well as EL is crossing 48 or not ######################
			$sql_frdel = "SELECT fwrd_el, fwrd_sl FROM leave_forwarded WHERE emp_id = '$emp_id'";
			$exe_query_frdel = $conn->query($sql_frdel);
			$result_frdel = $exe_query_frdel->fetch_assoc();
			if(($result_frdel['fwrd_el'] + $last_balance_el) > 48){
				$last_balance_el =  48;
			}else{
				$last_balance_el =  $result_frdel['fwrd_el'] + $last_balance_el;
			}
			
			//##################### Checking available SL for forwording to next year ######################
			$sql_sl = "SELECT leave_type_id, balance FROM leave_entitled_regular WHERE emp_id = '$emp_id' AND leave_type_id = 12";
			$exe_query_sl = $conn->query($sql_sl);
			$result2 = $exe_query_sl->fetch_array();
			$last_balance_sl = $result2['balance'];
			$last_balance_sl =  $result_frdel['fwrd_sl'] + $last_balance_sl;		
			
			$qry_frwd_leave = "INSERT INTO leave_forwarded (emp_id, fwrd_el, fwrd_sl, leave_year) VALUES ('$emp_id','$last_balance_el','$last_balance_sl','$cur_year')";
			$conn->query($qry_frwd_leave);
			//##################### end section for auto leave forwording to next year ######################	
			
			//$sql = "SELECT balance FROM leave_entitled_regular WHERE emp_id = '$emp_id' AND leave_type_id = 13";
			
			$qry_update_yearly = "INSERT INTO leave_entitled_regular (emp_id, leave_type_id, cycle_start_date, cycle_end_date, balance, leave_year) VALUES ('$emp_id', 11, '$year_start_date', '$year_end_date', 10, '$cur_year');";
			$qry_update_yearly .= "INSERT INTO leave_entitled_regular (emp_id, leave_type_id, cycle_start_date, cycle_end_date, balance, leave_year) VALUES ('$emp_id', 12, '$year_start_date', '$year_end_date', 12, '$cur_year');";
			$qry_update_yearly .= "INSERT INTO leave_entitled_regular (emp_id, leave_type_id, cycle_start_date, cycle_end_date, balance, leave_year) VALUES ('$emp_id', 13, '$year_start_date', '$year_end_date', 2, '$cur_year');";
			
			if ($conn->multi_query($qry_update_yearly)) {
			    do {
			    } while ($conn->next_result());
			}
			// ############# End Section for Increase Earned Leave in every month #########################
		}
		
		$qry_update_year = "UPDATE cur_date SET year = '$cur_year', month = '$cur_month' WHERE id = 1";
		$conn->query($qry_update_year);
		//echo "<br/> <br/> Date Year : ".$last_year." ".$cur_year;
	}else{
		//echo "Year Updated";
	}

	$conn->close();
?>