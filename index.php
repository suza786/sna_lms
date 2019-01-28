<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		
		<!--User define meta tag-->
		<meta name="Author" content="A N M Suza"/>
		
	    <!-- Bootstrap CSS and other -->
	    <link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/font-awesome-all.min.css">
		<link rel="stylesheet" href="css/mystyle.css"> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css">
		<title>Login: SNA LMS</title>
	</head>
	<style>
    	.loginpanel {
	        padding:10%;
      	}
      	.msg{
			font-style: oblique;
			font-size: 16px;
			color: #0000ff;
			font-weight: bold;
		}  
      
</style>
	<body>
	<div class="container loginpanel">
		<div class="row">
			  <div class="col-md-6">
			    <div class="card">
			      <div class="card-body">
			      	<div><img src="/sna_lms/images/snalogo.png" alt="Card image cap"></div>&nbsp;
			        <h4 class="card-title">SNA Leave Management System</h4>
			        <span></span>
			        <p class="card-text">Welcome! @ Solidaridad Network Asis</p>
					<form method="post">
						<table>
							<tr>
								<td>Login ID: &nbsp;</td>
								<td><input type="text" name="login"/></td>
							</tr>
							<tr> <td></td></tr>
							<tr>
								<td>Password:&nbsp;</td>
								<td><input type="password" name="passwd" /></td>
							</tr>
							<tr> <td>&nbsp;</td></tr>
							<tr>
								<td><input class="btn btn-primary" type="submit" name="submit" value="Login"/></td>
								<td><a href="#" class="btn 	">Password Rest</a></td>
							</tr>
						</table>
					</form>
					<br/> <p class='msg' id="msg"></p>
			      </div>
			    </div>
			  </div>
			</div><!--End of Row-->
		</div><!--End of Container-->
		
		<!--Linking Script files-->
	  	<script src="js/jquery-3.3.1.min.js"></script>
	  	<script src="js/popper.min.js"></script>
	  	<script src="js/fontawesome-all.min.js"></script>
  		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php

	//$dir = $_SERVER["DOCUMENT_ROOT"];
	include "files/db_connect.php";

	if(isset($_POST['submit']))
	{
		$login = $_POST['login'];
		$passwd = $_POST['passwd'];
		
		if($login == "" or $passwd == "")
		{
			echo "<script>document.getElementById('msg').innerHTML = 'Please Enter your ID & Password'</script>";
		}
		else {
			$sql = "SELECT emp_id, password FROM emp_details WHERE emp_id='$login' AND user_status = 'enable'";
			$result = $conn->query($sql);
	
			if ( $result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				if(password_verify($passwd, $row['password'])==1){

					//session_start();
					$_SESSION['user'] = $login;
					
					header("location: home.php");
					//echo "Login sucessfull Mr. ".$_SESSION['user'] ;
				}
				else if ( $row['password'] == $passwd){
					//session_start();
					$_SESSION['user'] = $login;
					
					header("location: home.php");
					//echo "Login sucessfull Mr. ".$_SESSION['user'] ;
				}
				else{
					echo "<script>document.getElementById('msg').innerHTML = 'Wrong password'</script>";
				}
			}
			else {
				echo "<script>document.getElementById('msg').innerHTML = 'Invalid user name'</script>";
			}
		}
	}
	$conn->close();
?>