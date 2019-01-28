
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
		      
		      <li class="nav-item dropdown">
		        <a class="nav-link"  href="/sna_lms/files/viewdata.php">View</a>
		      </li>
		      
		      <li class="nav-item">
		        <a class="nav-link" href="/sna_lms/files/leave_submit.php">Submit</a>
		      </li>

	    </ul>
	   <a href="#"> <i class="fas fa-user"></i>

	    <form class="form-inline my-2 my-lg-0"">
	    	<label style="padding-left:7px; padding-right: 20px;">
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
				?>
				<!--<a class="nav-link" data-toggle="modal" href="#pass-change">Change Passwrod</a>-->
			    <a class="nav-link" href="/sna_lms/files/logout.php">Logout</a>
			</label>
	      <!--<input class="form-control " type="search" placeholder="Search">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
		</form> </a>	
	</nav>
	</div><!--End header-->
	<!--Linking Script files-->
  	<script src="/sna_lms/js/jquery-3.3.1.min.js"></script>
  	<script src="/sna_lms/js/popper.min.js"></script>
  	<script src="/sna_lms/js/fontawesome-all.min.js"></script>
	<script src="/sna_lms/js/bootstrap.min.js"></script>
	<script src="/sna_lms/js/jquery-ui.js"></script>