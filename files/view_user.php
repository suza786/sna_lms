<?php
	session_start();
	include_once "db_connect.php";
	##########################	View User #############################
	if(isset($_POST['emp_id'])){
		$sql = "SELECT * FROM vw_emp_details WHERE emp_id ='".$_POST['emp_id']."'";

		if($conn->query($sql)){
			$result = $conn->query($sql);
			$output = '';
			$output .= "
				<div class='table-responsive'>
				<table class='table table-bordered'>
				";
			while ($row = $result->fetch_assoc()) {
					$full_name = $row['first_name']." ". $row['last_name'];
				$output .= "
					 <tr>
					 	<th width='30%'>Employee ID:</th>
					 	<td width='70'>".$row['emp_id']."</td>
					</tr>
					  <tr>
					 	<th width='30%'>Full_Name:</th>
					 	<td width='70'>".$full_name."</td>
					 </tr>
					  <tr>
					 	<th width='30%'>Email:</th>
					 	<td width='70'>".$row['email']."</td>
					</tr>
					  <tr>
					 	<th width='30%'>Designation:</th>
					 	<td width='70'>".$row['position']."</td>
					 </tr>
					  <tr>
					 	<th width='30%'>Date of Birth:</th>
					 	<td width='70'>".$row['birth_date']."</td>
					</tr>
					  <tr>
					 	<th width='30%'>Joining Date:</th>
					 	<td width='70'>".$row['join_date']."</td>
					 </tr>
					  <tr>
					 	<th width='30%'>Department:</th>
					 	<td width='70'>".$row['dept_name']."</td>
					 </tr>
					  <tr>
					 	<th width='30%'>Location:</th>
					 	<td width='70'>".$row['location_name']."</td>
					 </tr>
					  <tr>
					 	<th width='30%'>Supervisor:</th>
					 	<td width='70'>".$row['supervisor']."</td>
					</tr>
					  <tr>
					 	<th width='30%'>Mobile #:</th>
					 	<td width='70'>".$row['mobile']."</td>
					 </tr>
				";
			}
			$output .= " </table>	</div>	";
			echo $output;
		}else{
			echo "Error: ".$conn->error;
		}
	}
	######################### Update Selected User #################################		
	$conn->close();
?>