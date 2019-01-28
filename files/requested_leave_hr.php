<?php
ob_start();
session_start();
include_once "header_select.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<div id="home" class="container mybody"><br>
		    <h3 class="title" align="center"> Submitted Leave Information </h3><hr/>
		      <form method="post" action="">	
		    	<table cellpadding="5px" border="1" class="table text-white">
		      		<?php 
						   
						include_once "db_connect.php";
							
						if($_SESSION['user']){ // checks if the user is logged in  
						    	
						} 
						else{
							header("location: ../index.php"); // redirects if user is not logged in
						}
						
						$user = $_SESSION['user']; //assigns user value
	  					//echo "welcome mr ".$user;
						$sql = "SELECT first_name, last_name, curr_date, start_date, end_date, leave_type, num_of_days, status FROM vw_leave_requested_details ORDER BY curr_date DESC ";
				   		if($conn->query($sql) == TRUE){
							$result = $conn->query($sql);
								
							echo "<tr align='center'><th>#</th><th>Name</th><th>Submit Date</th><th>Start Date</th><th>End Date</th><th>Leave Type</th><th>Days</th><th>Status</th></tr>";
							$x = 1;
							while($value = $result->fetch_assoc())	{
								//$leave_id[$x] = $value['req_id'];
								$leave_id = $value['first_name'];
								$emp_id = $value['last_name']; //for update leave_entitled_regula table
								$curr_date = $value['curr_date'];
								$start_date = $value['start_date'];
								$end_date = $value['end_date'];
								$leave_type = $value['leave_type'];
								$num_of_days = $value['num_of_days'];
								$status = $value['status'];
								//$subordinate_id = $_POST['selected_user'];
								
								//Print the data in form field
								print "<tr><td>$x</td>
									<td>$value[first_name] $value[last_name]</td>
									<td>$value[curr_date]</td>
									<td>$value[start_date]</td>
									<td>$value[end_date]</td>
									<td>$value[leave_type]</td>
									<td>$value[num_of_days]</td>
									<td>$value[status]</td>";
								$x++;
							}
						}
						
						else{
							echo "<br/>Error : ".$conn->error;
						}					
					$conn->close();
				?>
				</table>
			
			</form>
			<p><br/><br/></p>
		</div>
	</body>
	<?php include "footer.php"; ?>
</html>