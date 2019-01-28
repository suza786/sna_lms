<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<?php
	//session_start(); //starts the session
	//$dir = $_SERVER["DOCUMENT_ROOT"];
	include "files/header_select.php";	 
	
	if($_SESSION['user']){ // checks if the user is logged in  
   	}
   	else{
      header("location: index.php"); // redirects if user is not logged in
   	}
   $user = $_SESSION['user']; //assigns user value

	$sql_qry = "SELECT emp_id, birth_date, position, join_date, dept_name, location_name, email, mobile, supervisor FROM vw_emp_details WHERE emp_id = '$user' ";
	if($conn->query($sql_qry)== TRUE){
		$record = $conn->query($sql_qry);
		$info = $record->fetch_assoc();
	}
	else{
		echo $conn->error;
	}
?>
<script>
	$(document).ready(function(){
		$('#pass-change-form').on('submit', function(event){
			event.preventDefault();
			var emp_id = $('#id').val();
			var oldPass = $('#oldpass').val();
			var newPass = $('#newpass').val();
			var retypePass = $('#retypepass').val();

			if( newPass.length < 6){
				alert("Password minimum length must be six.");
			}else {
				if( newPass != retypePass)	{
					alert("Password does not match.");
				}
				else{
					$.ajax({
						url:"files/pssword_update.php",
						method:"POST",
						data:{emp_id:emp_id,oldPass:oldPass,newPass:newPass},
						success:function(data){
							if(data == 'success'){
								var res = confirm("Password has been updated.");
								res==true?location.replace("/sna_lms/files/logout.php"):location.reload();
							}else{
								alert("Error " + data);
							}
						}
					});
					//location.reload();
				}
			}	
		});
	});		
</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<!--Start lert panel-->
			<div class="col-sm-3" style="background-color: #AED6F1;">
				<nav class="nav flex-column">
					<a class="nav-link"  href="home.php">Home</a>
					<a class="nav-link" href="/sna_lms/files/viewdata.php">View</a>
					<a class="nav-link" href="/sna_lms/files/leave_submit.php">Submit</a>  
					 <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
			          	User
			        </a>
			        <div class="dropdown-menu">
				          <a class="dropdown-item" data-toggle="modal" href="#pass-change">Change Passwrod</a>
				          <a class="dropdown-item" href="#">Edit Profile</a>
				   </div>
				</nav>
			</div><!--End of Left panel-->
			<div class="col-sm-9 mybody">
				<div class="jumbotron page-heading"> <h3 class="title" align="center">Hi, <?php echo $rows['first_name']." ".$rows['last_name'];?>! </h3></div>
				<div class="jumbotron page-heading" align="center"> 
					<h3>Welcome to Solidaridad Leave Management System.</h3>
				</div>
				<form method="post">
					<table cellpadding="5px"  border="1" align="center" class="table"> 
	 					 <tr>
							<th><label class="col-form-label"> Employee ID: </label></th>
							<td> <?= $info['emp_id'];?> </td>
						</tr>	
		
						<tr>
					    	<th><label class="col-form-label">Date of Birth:</label></th>
					    	<td><?= $info['birth_date'];?></td>
						</tr>
		
						<tr>
		    				<th><label class="col-form-label">Designation:</label></th>
		   					<td><?= $info['position'];?></td>
						</tr>
						<tr>
						    <td><label class="col-form-label">Joining Date:</label></td>
						    <td><?= $info['join_date'];?></td>
						</tr>
						<tr>
						    <td><label class="col-form-label">Location:</label></td>
						    <td><?= $info['location_name'];?></td>
						</tr>
						<tr>
							<td><label class="col-form-label">Email Address:</label></td>
							<td><?= $info['email'];?></td>
						</tr>
						<tr>
						    <td><label class="col-form-label">Mobile #:</label></td>
						    <td><?= $info['mobile'];?></td>
						</tr>
						<tr>
						    <td><label class="col-form-label">Supervisor:</label></td>
						    <td><?= $info['supervisor'];?></td>
						</tr>	
						<tr>
						    <td><label class="col-form-label">Department</label></td>
						    <td> <?= $info['dept_name'];?> </td>
						</tr>
					</table>
				</form>
			</div>				
		</div> <!--End of row -->
	</div> <!--End of Container/Mybody class-->
	<!-- ############# Modal password change #####################-->
	<div class="modal fade" role="dialog" id="pass-change">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"> Password Change</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form method="post" id="pass-change-form">
						<label for="oldpass">Old Password:</label>
						<input type="password" class="form-control" name="oldpass" id="oldpass" required=""><br/>
					
						<label for="newpass">New Psssword</label>
						<input type="password" class="form-control" name="newpass" id="newpass" min="6" required=""><br/>

						<label for="retypepass">Retype Psssword</label>
						<input type="password" class="form-control" name="retypepass" id="retypepass" required=""><br/>

						<input type="hidden" name="id" id="id" value="<?php echo $user?>">
						<input type="submit" name="submit" id="submit" value="Update" class="btn btn-success">
						<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>		
					</form>
				</div>
			</div>
		</div>
	</div>	
	<!-- ############# End pass change modal #####################-->
</body>
</html>
<?php include "files/footer.php"; ?>