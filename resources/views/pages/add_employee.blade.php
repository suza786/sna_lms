@extends('layout.admin')
@section('body')
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Basic Forms</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{url('admin_')}}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Add Employee</span></li>
			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	<!-- start: page -->
	<body>
	<div class="container mybody" align="center"> 
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
										</Select>
							</td>
							
					</div>
					<div class="form-group">
						    <td><label for="bdate" class="col-form-label">Date of Birth</label></td>
						    <td><input type="text" class="form-control" id="bdate" name="birth_date" required=""></td>
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
								<option value="3">Operation</option>
								<option value="4">Finance</option>
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
			<table class="table table-bordered mybody">
			<h3 class="title" align="left"> <u>List of users</u>	</h3>
				<tr align="center">
					<th width="5%">Sl #</th>
					<th>First Name</th>
					<th>Designation</th>
					<th>Location</th>
					<th width="21%">Action</th>
				</tr>
				
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
										 </Select>
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
										<option value="3">Operation</option>
										<option value="3">Finance</option>
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
	</div><!--End of modal-->
  	<!--############################# -- Edit User Modal --###################################-->	
</body>
@endsection