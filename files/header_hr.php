		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		
		<!--User define meta tag-->
		<meta name="Author" content="A N M Suza"/>

	    <!-- Bootstrap CSS and other -->
	    <link rel="stylesheet" href="/sna_lms/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/sna_lms/css/font-awesome-all.min.css"/>
		<link rel="stylesheet" href="/sna_lms/css/mystyle.css"/>
		<link rel="stylesheet" href="/sna_lms/css/jquery-ui.css"/>  
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css"/>

		<div class="header container"><!-- Starting header-->
	
	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#"><img src="/sna_lms/images/snalogo.png" alt="Loading..." /></a>
		 
	    <ul class="navbar-nav mr-auto">
	    
		      <li class="nav-item active">
		        <a class="nav-link"  href="/sna_lms/home.php">Home</a>
		      </li>
		      
		   <!--   <li class="nav-item">
		        <a class="nav-link" href="/sna_lms/files/update_leave_record.php">LeaveUpdate</a>
		      </li>-->
		       
		      <li class="nav-item dropdown">
		        <a class="nav-link"  href="/sna_lms/files/viewdata.php">View</a>
		      </li>
  
		      <li class="nav-item">
		        <a class="nav-link" href="/sna_lms/files/leave_submit.php">Submit</a>
		      </li>
			  <li class="nav-item dropdown">
			    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			      HR
			    </a>
			    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			      <a class="dropdown-item" href="/sna_lms/files/add_holidays.php">Add Holidays</a>
			      <a class="dropdown-item" href="/sna_lms/files/user_list.php">Create User</a>
			      <div class="dropdown-divider"></div>
			      <a class="dropdown-item" href="/sna_lms/files/allocate_el.php">Allocate EL</a>
			      <a class="dropdown-item" href="/sna_lms/files/requested_leave_hr.php">Submitted Leaves</a>
				  <a class="dropdown-item" data-toggle="modal" href="#reset-pass">Reset Passwrod</a>
			    </div>
			  </li>

	    </ul>
	   	
	    <form class="form-inline my-2 my-lg-0">
	    	<label style="padding-left:7px; padding-right: 20px;">
	    	<a href="#"> <i class="fas fa-user"></i>
				<?php 
					include_once "db_connect.php";
					
					$user = $_SESSION['user']; //assigns user value
					//Retriving current user name
					if($_SESSION['user']){ // checks if the user is logged in  
					   }
					   else{
					      header("location: /sna_lms/index.php"); // redirects if user is not logged in
					   }
					$sql_query = "SELECT first_name, last_name FROM emp_details WHERE emp_id = '$user' ";
					if($conn->query($sql_query)== TRUE){
						$name = $conn->query($sql_query);
						
						$rows = $name->fetch_assoc();
						echo $rows['first_name']." ".$rows['last_name'];											
					}
					else{
						echo $conn->error;
					}
				?></a>&nbsp;&nbsp;
			    <a class="nav-link" href="/sna_lms/files/logout.php">Logout</a>
			</label>
	      <!--<input class="form-control " type="search" placeholder="Search">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
	    </form> 
		</nav>
	</div><!--End header-->
	<!--Linking Script files-->
  	<script src="/sna_lms/js/jquery-3.3.1.min.js"></script>
  	<script src="/sna_lms/js/popper.min.js"></script>
  	<script src="/sna_lms/js/fontawesome-all.min.js"></script>
	<script src="/sna_lms/js/bootstrap.min.js"></script>
	<script src="/sna_lms/js/jquery-ui.js"></script>
	<script>
		$(document).ready(function() {
		$('#pass-reset-form').on('submit', function(e){
			e.preventDefault();
			var emp_id = $('#emp-id').val();
			var newPass = $('#new-pass').val();
			var retypePass = $('#retype').val();

			if( newPass.length < 6){
				alert("Password minimum length must be six.");
			}else {
				if( newPass != retypePass)	{
					alert("Password does not match.");
				}
				else{
					$.ajax({
						url:"/sna_lms/files/pssword_reset.php",
						method:"POST",
						data:{emp_id:emp_id,newPass:newPass},
						success:function(data){
							if(data == 'success'){
								$('#reset-pass').modal("hide");
								alert("Password successfully reset.");
								location.reload(true);								
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
	<!-- ############# Modal password change #####################-->
	<div class="modal fade" role="dialog" id="reset-pass">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"> Password Reset</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form method="post" id="pass-reset-form">
						<label for="emp-id">Employee ID:</label>
						<Select class='form-control'id="emp-id" name="emp-id" required="">
							<option value=""> Select Employee ID</option>
							<?php 
								$sql_query = "SELECT emp_id FROM emp_details";
								if($conn->query($sql_query)== TRUE){
									$name = $conn->query($sql_query);

									while ($eid = $name->fetch_assoc()){
										echo "<option value=".$eid['emp_id'].">".$eid['emp_id']."</option>";					
									}
								}
								else{
									echo $conn->error;
								}
							?> </Select><br/>					
						<label for="new-pass">New Psssword</label>
						<input type="password" class="form-control" name="new-pass" id="new-pass" placeholder="Minimum 6 Character" required=""><br/>

						<label for="retype">Retype Psssword</label>
						<input type="password" class="form-control" name="retype" id="retype" min="6" required=""><br/>

						<input type="submit" name="reset" id="reset" value="Reset" class="btn btn-success">
						<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>		
					</form>
				</div>
			</div>
		</div>
	</div>	
	<!-- ############# End pass change modal #####################-->