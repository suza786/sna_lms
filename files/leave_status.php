<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--	<script type="text/javascript">
		$(document).ready(function(){
			$('#l-status').click(function(event){
			event.preventDefault();			
		});
		function showDiv(){
			$("#hideme").show();
		}
		
	</script>-->	
	</head>
	<body>
		<div id="home" class="container mybody"><br>
		    <h3 class="title" align="center"> My Leave Requests  </h3><hr/>
		      <form method="post" action="">	
		    	<table cellpadding="5px" border="1" class="table mybody">
		      		<?php 
								   
						include_once "db_connect.php";
							
						if($_SESSION['user']){ // checks if the user is logged in  
						    	
						} 
						else{
							header("location: ../index.php"); // redirects if user is not logged in
						}
						
						$user = $_SESSION['user']; //assigns user value
	  					//echo "welcome mr ".$user;
						$sql = "SELECT req_id, emp_id, curr_date, start_date, end_date, leave_type, num_of_days, status FROM vw_leave_requested_details WHERE emp_id = '$user'";
				   		if($conn->query($sql) == TRUE){
							$result = $conn->query($sql);
								
							echo "<tr align='center'><th>#</th><th>Submit Date</th><th>Start Date</th><th>End Date</th><th>Leave Type</th><th>Days</th><th>Status</th><th>Action</th></tr>";
							$x = 1;
							while($value = $result->fetch_assoc())	{
								//$leave_id[$x] = $value['req_id'];
								$leave_id = $value['req_id'];
								$emp_id = $value['emp_id']; //for update leave_entitled_regula table
								$curr_date = $value['curr_date'];
								$start_date = $value['start_date'];
								$end_date = $value['end_date'];
								$leave_type = $value['leave_type'];
								$num_of_days = $value['num_of_days'];
								$status = $value['status'];
								//$subordinate_id = $_POST['selected_user'];
								
								//Print the data in form field
								print "<tr><td>$x</td>
									<td>$value[curr_date]</td>
									<td>$value[start_date]</td>
									<td>$value[end_date]</td>
									<td>$value[leave_type]</td>
									<td>$value[num_of_days]</td>
									<td>$value[status]</td>";
								//Display "update", "delete" link for "planed" leave.
								if ($value['status'] == "Planed")
								{
									echo "<td><a href='l_update.php?leave_id=$value[req_id]&start_date=$value[start_date]&end_date=$value[end_date]&leave_type=$value[leave_type]&num_of_days=$value[num_of_days]&status=$value[status]'>Update/Delete </a>	&nbsp;
									<!--<a href='l_update.php?leave_id=$value[req_id]&start_date=$value[start_date]&end_date=$value[end_date]&leave_type=$value[leave_type]&num_of_days=$value[num_of_days]&status=$value[status]'>Delete </a></td>-->
									</tr>";
								}
								else{
									echo	"<td>N/A</td></tr>";
								}
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
</html>