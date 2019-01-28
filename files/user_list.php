<?php
ob_start();
session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>New User</title>
	<!--##########################################-->
	<?php 	
		include "header_select.php";
		
		if($_SESSION['user']){ // checks if the user is logged in  
	   }
	   else{
	      header("location: ../index.php"); // redirects if user is not logged in
	   }
		$user = $_SESSION['user']; //assigns user value
	    
	    $qry = "SELECT * FROM vw_emp_details WHERE user_status = 'enable' ORDER BY emp_id ASC";
		$result = $conn->query($qry);
		
	?>	<!--PHP Coding End-->
	<!--##########################################-->
<script>
	$(document).ready(function() {
		//########################### View User ###############################
		$('.view-user').click(function(){
			var emp_id = $(this).attr('id');
			//alert("Hello " + emp_id);
			$.ajax({
				url:"view_user.php",
				method:"POST",
				data:{emp_id:emp_id},
				success:function(data){
					$('#view-body').html(data);
					$('#view-modal').modal("show");
				}
			})
		});
	//########################### Add User ###############################
		$("#bdate").datepicker({changeMonth:true, changeYear:true, yearRange: "c-70:c+10"});
				$( "#bdate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$("#jdate").datepicker({changeMonth:true, changeYear:true});
			$( "#jdate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
		$('#userform').on('submit', function(event){
			var first_name = $('#fname').val();
			var last_name = $('#lname').val();
			var password = $('#passwd').val();
			var e_mail = $('#email').val();
			var supervisor = $('#supervisor').val();
			var birth_date = $('#bdate').val();
			var join_date = $('#jdate').val();
			var department = $('#dept').val();
			var location = $('#location').val();
			var position = $('#position').val();
			var mobile = $('#mobile').val();
			var user_type = $('#type').val();
			var note = $('#note').val();
	
			$.ajax({
				url:"add_user.php",
				method:"POST",
				data:$('#userform').serialize(),
				success:function(data){
					if(data != 'success'){
						alert("Error: " + data);
					}else{
						//alert(data);
						alert("User successfuly created");
						$("#userform").trigger('reset');
						document.getElementById("userform").reset();
						location.reload(true);
					}
				}
			});
			event.preventDefault();
		});
	//########################### Edit User Data Retrive ###############################
		$('.edit-user').click(function(){
			var emp_id = $(this).attr('id');
			$.ajax({
				url:"fetch.php",
				method:"POST",
				data:{emp_id:emp_id},
				dataType:"json",
				success:function(data){
					$('#first_name').val(data.first_name);
					$('#last_name').val(data.last_name);
					$('#e_mail').val(data.email);
					$('#supervis').val(data.supervisor);
					$('#birth_date').val(data.birth_date);
					$('#join_date').val(data.join_date);
					$('#department').val(data.dept_name);
					$('#location_name').val(data.location_name);
					$('#position_name').val(data.position);
					$('#mobile_no').val(data.mobile);
					$('#user_type').val(data.user_type);
					$('#user_note').val(data.note);
					$('#emp_id').val(data.emp_id);
					
					//$('#submit').val("Update");
					//$('#reset').hide();
					$('#edit_user').modal("show");
				}
			})
		});
		//########################### Edit User Data Update -- ###############################
		$('#edit_user_form').on('submit', function(event){
			var first_name = $('#first_name').val();
			var last_name = $('#last_name').val();
			var e_mail = $('#e_mail').val();
			var supervisor = $('#supervis').val();
			var birth_date = $('#birth_date').val();
			var join_date = $('#join_date').val();
			var department = $('#department').val();
			var location = $('#location_name').val();
			var position = $('#position_name').val();
			var mobile = $('#mobile_no').val();
			var user_type = $('#user_type').val();
			var note = $('#user_note').val();
			var emp_id = $('#emp_id').val();
			//alert("Edit Form Submit"+e_mail+" "+mobile+" "+emp_id);	
			$.ajax({
				url:"update_user.php",
				method:"POST",
				data:{emp_id:emp_id, first_name:first_name,last_name:last_name,e_mail:e_mail,supervisor:supervisor, birth_date:birth_date,join_date:join_date,department:department,location:location,position:position, mobile:mobile, user_type:user_type, note:note},
				//data:$('#edit_user_form').serialize(),
				success:function(data){
					if(data == 'success'){
						$('#edit_user').modal("hide");
						alert("User successfuly updated");
						location.reload(true);						
					}else{
						alert("Error on update data : " + data);
					}
				}
			});
		event.preventDefault();
		});
	//########################### Disable User ###############################
		$('.disable-user').click(function(){
			var emp_id = $(this).attr('id');
			if(confirm("Are you sure to dicativate the user?")){
				$.ajax({
				url:"disable_user.php",
				method:"POST",
				data:{emp_id:emp_id},
				success:function(data){
					if(data != 'success'){
						alert("Error " + data);
					}else{
						if(confirm("User successfuly deactivated")){}
						location.reload(true);
					}
				}
				})	
			}else{
				//Nothing
			}
		});	
	});
</script>
</head>
<body>
	<div class="container p-2 mybody" align="center"> 
		<h2> User Operation</h2> <hr/>
		<button type="button" class="btn btn-warning" id="add" name="add" data-toggle="collapse" data-target="#add_user">Add User</button>
		<br><br>
	<!--############################  Add User ####################################-->
  		<div class="collapse" id="add_user">  <!--Start Collapse -->
			<div class="jumbotron page-heading"> <h3 class="title" align="center"><u>New User</u></h3></div>
			  <form method="post" id="userform">
				<table cellpadding="5px" class="table mybody"> 
					<tr><div class="form-group">
						    <td><label for="lname" class="col-form-label">First Name:</label></td>
						    <td><input type="text" class="form-control" id="fname" name="first_name" required=""></td>
						</div>
						<div class="form-group">
						    <td><label for="lname" class="col-form-label">Last Name:</label></td>
						    <td><input type="text" class="form-control" id="lname" name="last_name" required=""></td>
					</div></tr>
					<tr><div class="form-group">
						    <td><label for="passwd" class="col-form-label">Password:</label></td>
						    <td><input type="password" class="form-control" id="passwd" name="password" required=""></td>
						</div>
						<div class="form-group">
						    <td><label for="email" class="col-form-label">Email:</label></td>
						    <td><input type="email" class="form-control" id="email" name="e_mail" required=""></td>	
						</div>
					</tr>
					<tr><div class="form-group">
							<td><label class="col-form-label" for="supervisor">Supervisor:</label></td>
							<td>
								<Select class='form-control'id="supervisor" name="supervisor"  required="">
										<option value=""> Select your supervisor..</option>
										<?php 
											//Retriving employee/supervisor id from dropdown menu;
											$sql_query = "SELECT emp_id, first_name, last_name FROM emp_details";
											if($conn->query($sql_query)== TRUE){
												$name = $conn->query($sql_query);

												while ($rows = $name->fetch_assoc()){
													echo	"<option value=".$rows['emp_id'].">".$rows['first_name']." ".$rows['last_name']."</option>";											
												}
											}
											else{
												echo $conn->error;
											}
										?> </Select>
							</td>
							
					</div>
					<div class="form-group">
						    <td><label for="bdate" class="col-form-label">Date of Birth</label></td>
						    <td><input type="text" class="form-control" id="bdate" name="birth_date"></td>
						</div></tr>
					<tr><div class="form-group">
						    <td><label for="jdate" class="col-form-label">Join date</label></td>
						    <td><input type="text" class="form-control" id="jdate" name="join_date" required=""></td>
					</div>
					<div class="form-group">
						    <td><label for="dept" class="col-form-label">Department</label></td>
						    <td> <select name="department" id="dept" class="form-control" required="">
								<option value="">Select your department</option>
								<option value="2">Program</option>
								<option value="1">Suppirt</option>
							</select> </td>
					</div></tr>	
					<tr><div class="form-group">
						    <td><label for="location" class="col-form-label">Location :</label></td>
						   	<td> <select name="location" id="location" class="form-control" required="">
								<option value="">Select your location</option>
								<option value="1">Dhaka</option>
								<option value="2">Khulna</option>
								<option value="3">Jeshore</option>
								<option value="4">Noakhali</option>
							</select> </td>
					</div>
					<div class="form-group">
						<td><label for="position" class="col-form-label">Position:</label></td>
					    <td><input type="text" class="form-control" id="position" name="position" required=""></td>
					</div>
					</tr>
					<tr><div class="form-group">
						    <td><label for="mobile" class="col-form-label">Mobile :</label></td>
						    <td><input type="text" class="form-control" id="mobile" name="mobile" required=""></td>
					</div>
					<div class="form-group">
						<td> <label for="type" class="col-form-label">User Type</label></td>
				    	<td><select name="user_type" id="type" class="form-control" required="">
						<option value="">Select user type</option>
						<option value="User">User</option>
						<option value="HR">HR</option>
						<option value="System Admin">Admin</option></select>
						</td>
					</div></tr>

					<tr><div class="form-group">
							<td ><label for="note" class="col-form-label">Note:</label></td>
						    <td colspan="2"><textarea rows="1" class="form-control" cols="45" name="note" id="note"></textarea></td>
						</div>
											
				     <td align="center"><input type="submit" class="btn btn-primary" value="Create" name="submit" id="submit">
				     &nbsp;&nbsp;&nbsp;
				     <input type="reset" class="btn btn-warning" value=" Reset " name="reset" id="reset">
					 </td>
					</tr>						
				</table>
				</form>
				<hr/>
			</div><!--End of Collapse-->
  <!--########################### End Add User #####################################-->
			<table class="table table-bordered text-white">
			<h3 class="title" align="left"> <u>List of users</u>	</h3>
				<tr align="center">
					<th width="5%">Sl #</th>
					<th>First Name</th>
					<th>Designation</th>
					<th>Location</th>
					<th width="21%">Action</th>
				</tr>
				<?php 
					$x = 1;
					 while ($row = $result->fetch_array()) {
					 	$full_name = $row['first_name']." ". $row['last_name'];	
				?>
							<tr>
								<td align="center"> <?php echo $x ?> </td>
								<td> <?php echo $full_name ?> </td>
								<td> <?php echo $row['position'] ?> </td>
								<td> <?php echo $row['location_name'] ?> </td>
								<td align="center"> 
									<input type="button" class="btn btn-primary btn-sm view-user" id="<?php echo $row['emp_id'] ?>" value="View">  
									<input type="button" class="btn btn-light btn-sm edit-user" id="<?php echo $row['emp_id'] ?>" value="Edit">
									<input type="button" class="btn btn-danger btn-sm disable-user" id="<?php echo $row['emp_id'] ?>" value="Disable"> 
								</td>
							</tr>
	 			<?php	$x++;	}	?>
			</table>
	</div><!-- End of Container-->	
		<!--#########-- Modal for view button to view individual user information-- ###################-->
		<div class="modal fade" id="view-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title text-centered"> User Details</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" id="view-body">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
						
					</div>
				</div>
			</div>
		</div>
	<!--############################### -- Edit User Modal -- #################################-->
  	<div class="modal fade" id="edit_user" role="dialog">  <!--Start Modal-->
  		<div class="modal-dialog"  role="document">	
			<div class="modal-content">
				<div class="modal-header">
					<div class="page-heading"> <h3 align="center"><u>Edit User</u></h3></div>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form method="post" id="edit_user_form">
						<table cellpadding="5px" class="table"> 
							<tr><div class="form-group">
								    <td width="30%"><label>First Name:</label></td>
								    <td><input type="text" class="form-control" id="first_name" name="fname" required=""></td>
								</div></tr>
								<tr><div class="form-group">
								    <td><label>Last Name:</label></td>
								    <td><input type="text" class="form-control" id="last_name" name="lname" required=""></td>
							</div></tr>
							<tr><div class="form-group">
								    <td><label>Email:</label></td>
								    <td><input type="email" class="form-control" id="e_mail" name="email" required=""></td>	
								</div>
							</tr>
							<tr><div class="form-group">
									<td> <label class="col-form-lebel" for="supervise"> Sepervisor:</label></td>
									<td>
										<Select class='form-control'id="supervis" name="supervis"  required="">
										<option value=""> Select your supervisor..</option>
										<?php 
											//Retriving employee/supervisor id from dropdown menu;
											$sql_query = "SELECT emp_id, first_name, last_name FROM emp_details";
											if($conn->query($sql_query)== TRUE){
												$name = $conn->query($sql_query);

												while ($rows = $name->fetch_assoc()){
													echo	"<option value=".$rows['emp_id'].">".$rows['first_name']." ".$rows['last_name']."</option>";											
												}
											}
											else{
												echo $conn->error;
											}
										?> </Select>
									</td>
							</div></tr>
							<tr><div class="form-group">
								    <td><label>Date of Birth</label></td>
								    <td><input type="text" class="form-control" id="birth_date" name="bdate" required=""></td>
								</div></tr>
							<tr><div class="form-group">
								    <td><label>Join date</label></td>
								    <td><input type="text" class="form-control" id="join_date" name="jdate" required=""></td>
							</div></tr>
							<tr><div class="form-group">
								    <td><label>Department</label></td>
								    <td> <select name="dept" id="department" required="" class="form-control">
										<option value="">Select your department</option>
										<option value="2">Program</option>
										<option value="1">Support</option>
									</select> </td>
							</div></tr>	
							<tr><div class="form-group">
								    <td><label>Location :</label></td>
								   	<td> <select name="location_name" id="location_name" class="form-control" required="">
										<option value="">Select your location</option>
										<option value="Dhaka">Dhaka</option>
										<option value="Khulna">Khulna</option>
										<option value="Jeshore">Jeshore</option>
										<option value="Noakhali">Noakhali</option>
									</select> </td>
							</div></tr>
							<tr><div class="form-group">
								<td><label>Position:</label></td>
							    <td><input type="text" class="form-control" id="position_name" name="position_name" required=""></td>
							</div>
							</tr>
							<tr><div class="form-group">
								    <td><label>Mobile :</label></td>
								    <td><input type="text" class="form-control" id="mobile_no" name="mobile_no" required=""></td>
							</div></tr>
							<tr><div class="form-group">
								<td> <label>User Type</label></td>
						    	<td><select name="user_type" id="user_type" class="form-control" required="">
								<option value="">Select user type</option>
								<option value="User">User</option>
								<option value="HR">HR</option>
								<option value="System Admin">Admin</option></select>
								</td>
							</div></tr>

							<tr><div class="form-group">
									<td ><label>Note:</label></td>
								    <td><textarea name="user_note" class="form-control" id="user_note"></textarea></td>
								    <input type="hidden" name="emp_id" id="emp_id"/>
								</div></tr>
													
						  <tr> <td align="center"><input type="submit" class="btn btn-primary" value="Update" name="update" id="update">
						  	 </td>
						  		<td><button type="button" class="btn btn-warning" data-dismiss="modal">Close</button> 
						  </td>
						</tr>						
						</table>

					</form>
				</div>

			</div><!-- Modal Content-->
		</div> <!-- Modal Dialog-->
	</div><!--End of modal->
  	<!--############################# -- Edit User Modal --###################################-->	
</body>
</html>
<?php include "footer.php"; ?>