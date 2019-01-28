<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<?php  
		
	include "header_select.php";
   	include_once "db_connect.php";
   	include "mail.php";	
?>
<script>
	$(document).ready(function(){
		$('.note').click(function(event){
			var req_id = $(this).attr('id');
			$.ajax({
				url:"view_note.php",
				method:"POST",
				data:{req_id:req_id},
				success:function(data){
					alert("Note: " + data);
				}
			})
			event.preventDefault();
		})		
	});
</script>	
</head>
	<body>
		<div id="home" class="container mybody"><br>
		    <h1 class="title" align="center">Leaves for approval</h1><br/>

		    <form method="post" action="">
		    	<table cellpadding="5px" border="1" class="table table-bordered">
			     
			<?php 
			   
					include_once "db_connect.php";
						
					if($_SESSION['user']){ // checks if the user is logged in  
					    	
					} 
					else{
						header("location: ../index.php"); // redirects if user is not logged in
					}
					
					$user = $_SESSION['user']; //assigns user value
  					// ############ Retrive current user email address
					$qry_user_email = "SELECT email FROM emp_details WHERE emp_id = '$user'";
					$qry_result = $conn->query($qry_user_email);
					$rows = $qry_result->fetch_array();
					$user_email = $rows['email'];
				  					
  					//$sql = "SELECT req_id, emp_id, first_name, last_name, curr_date, start_date, end_date, leave_type, num_of_days, status FROM vw_leave_requested_details WHERE supervisor_id='$user' and status = 'Requested' ORDER BY curr_date ASC";
  					$sql = "SELECT * FROM vw_leave_requested_details WHERE supervisor_id='$user' and status = 'Requested' ORDER BY curr_date ASC";
					if($conn->query($sql) == TRUE){ //collecting submitted leave information to current user
						$result = $conn->query($sql);
						if($result->num_rows == 0){
								echo " You don't have any leave for approval";
								echo "<br/><br/><a class='btn btn-secondary btn-lg' href='viewdata.php' role='button'>Back</a>";
						}
						else{
									
							echo "<tr><th>#</th><th>User Name</th><th>Submit Date</th><th>Start Date</th><th>End Date</th><th>Leave Type</th><th>Days</th><th>Note</th><th>Select</th></tr>";
							for($x=0; $value = $result->fetch_assoc(); $x++)
							{
								$leave_id[$x] = $value['req_id'];
								$emp_id[$x] = $value['emp_id']; //for update leave_entitled_regula table
								$fname[$x] = $value['first_name'];
								$lname[$x] = $value['last_name'];	
								$curr_date[$x] = $value['curr_date'];
								$start_date[$x] = $value['start_date'];
								$end_date[$x] = $value['end_date'];
								$leave_type[$x] = $value['leave_type'];
								$num_of_days[$x] = $value['num_of_days'];
								//$status[$x] = $value['status'];
								
								//Print the data in form field
								print "<tr><td>".($x+1)."</td> <input type='hidden' name='req_id' value='".$leave_id[$x]."'/>";
								print "<td>".$fname[$x]." ".$lname[$x]."</td>	<input type='hidden' name='fullname' value='".$lname[$x]."'/>";
								print "<td>".$curr_date[$x]."</td>	<input type='hidden' name='currdate' value='".$curr_date[$x]."'/>";
								print "<td>".$start_date[$x]."</td>	<input type='hidden' name='startdate' value='".$curr_date[$x]."'/>";
								print "<td>".$end_date[$x]."</td>	<input type='hidden' name='enddate' value='".$end_date[$x]."'/>";
								print "<td>".$leave_type[$x]."</td>	<input type='hidden' name='enddate' value='".$leave_type[$x]."'/>";
								print "<td>".$num_of_days[$x]."</td>	<input type='hidden' name='numofdays' value='".$num_of_days[$x]."'/>";
								//print "<td>".$status[$x]."</td>	<input type='hidden' name='status' value='".$status[$x]."'/>";
								print "<td><button class='btn note' id='".$leave_id[$x]."'/>View</button></td>";
								print "<td><input type='checkbox' class='form-control' name='ckbox[]' value='".$x."'/></td></tr> ";
								
								//echo "<td><input type='submit' name ='".$x."' value='Approve' class='btn'/> &nbsp;&nbsp &nbsp;";
								//echo "<input type='submit' name = 'reject' value='Reject' class='btn'/></td></tr>";
								//echo "<input type = 'hidden' name = 'selected_user' value='". $subordinate_id."'/>";
							}
							print	"</table>
									<input type='submit' name ='approved' value='Approve' class='btn'/> &nbsp;&nbsp; &nbsp;
									<input type='submit' name = 'reject' value='Reject' class='btn'/>
									<div id='display_note'></div>";
						}
					}		
					else{
						echo "<br/>Error : ".$conn->error;
					}
					if(isset($_POST['approved'])){
						//$count = array();
						$count = isset($_POST['ckbox'])? count($_POST['ckbox']):0;
						if($count > 0){
							for ($i=0; $i<$count; $i++){
							$index = $_POST['ckbox'][$i];
							//print "<br>Selected User Name :".$fname[$index]." and your leave id # ".$leave_id[$index];
							//echo "levae type is: ". $leave_type[$index];
							
							$sql = "UPDATE vw_leave_requested_details SET status='Approved' WHERE req_id = '$leave_id[$index]'";
							$sql2 = "UPDATE leave_entitled_regular SET balance = balance-'$num_of_days[$index]' WHERE emp_id = '$emp_id[$index]' AND leave_type_id = (SELECT leave_type_id FROM `leave_type` WHERE leave_type = '$leave_type[$index]') ";
				
								if ($conn->query($sql)== true && $conn->query($sql2) == true){
									echo "<br/>Leave approved for user ";
									// ############ Retrive applicant email address
									$qry_supervisor_email = "SELECT email FROM emp_details WHERE emp_id = '$emp_id[$index]'";
									$qry_result = $conn->query($qry_supervisor_email);
									$rows = $qry_result->fetch_assoc();
									$applicant_email = $rows['email'];
									//################ Sending Mail to user
									echo $user_email." Supervisor-- ".$applicant_email;
									$msg = reply_mail($user_email, $applicant_email, "Approved");
									echo $msg;
									//header("location: leave_approval.php");
								}
								else{
									echo $conn->error;
								}
							}
						}
						else {
							echo "<br>Please select any checkbox";
						}						
					}
					if(isset($_POST['reject'])){
						$count = isset($_POST['ckbox'])? count($_POST['ckbox']):0;
						if($count > 0){
							for ($i=0; $i<$count; $i++){
							$index = $_POST['ckbox'][$i];
							
							$sql = "UPDATE vw_leave_requested_details SET status='Rejected' WHERE req_id = '$leave_id[$index]'";
							
								if ($conn->query($sql)){
									echo "<br/>Leave Rejected for user ".$fname[$x]." ".$lname[$x] ;
									// ############ Retrive applicant email address
									$qry_supervisor_email = "SELECT email FROM emp_details WHERE emp_id = '$emp_id[$index]'";
									$qry_result = $conn->query($qry_supervisor_email);
									$rows = $qry_result->fetch_assoc();
									$applicant_email = $rows['email'];
									//reply_mail($user_email, $applicant_email, "Rejected");
									$txt = "Dear applicant, \r\n your leave request has been regected";
									$msg = reply_mail($user_email, $applicant_email, "Rejected");
									echo $msg;
									//header("location: leave_approval.php");
								}
								else{
									echo $conn->error;
								}
							}
						}
						else {
							echo "<br>Please select any checkbox";
						}
	
					}
					$conn->close();
				?>
				<!--</table>  &nbsp;&nbsp; &nbsp;
				<input type='submit' name ='approved' value='Approve' class='btn'/>
				<input type='submit' name = 'reject' value='Reject' class='btn'/>-->
			  </form><br/><br/> 
			  <p id='msgs'></p>
			</div>
	</body>
</html> 
<?php include "footer.php"; ?>