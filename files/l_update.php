<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Leave Request</title>
			<!-- Bootstrap CSS and other -->
	</head>
	<?php
	
  	include "header_select.php";
   	include_once "db_connect.php";
	
	if($_SESSION['user']){ // checks if the user is logged in  
   	} 
   	else{
		header("location: /szlms-hm/login.php"); // redirects if user is not logged in
   	}
	$user = $_SESSION['user']; //assigns user value
	
	$l_type = $_GET['leave_type'];
	switch ($l_type) {
	    case "Casual Leave":
	        $ltype_id = 11;
	        break;
	    case "Sick Leave":
	        $ltype_id = 12;
	        break;
	    case "Earned Leave":
	        $ltype_id = 13;
	        break;
	    default:
	        echo "Invalid Leave Type!";
    }
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#update').click(function(event){
				var ajx_obj	= new XMLHttpRequest();
				ajx_obj.open("post","update_request.php",true);
				ajx_obj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				ajx_obj.onreadystatechange = function(){
					if(ajx_obj.readyState == 4 && ajx_obj.status == 200){
						document.getElementById("info").innerHTML = ajx_obj.responseText;
					}
				}
				var id = $('#id').val();
				var ltype = $('#ltype').val();
				var sdate = $('#sdate').val();
				var edate = $('#edate').val();
				var nod = $('#nod').val();
				var status = $('#status').val();	
				ajx_obj.send("leave_id="+id+"&leave_type="+ltype+"&start_date="+sdate+"&end_date="+edate+"&num_of_days="+nod+"&status="+status);
				document.getElementById("info").innerHTML = "Processing... ";
				event.preventDefault();
			})
		})
		
	</script>
 
	<body>
		<div class="container mybody">
			<div class="row">
				<div class="col-sm-7">
					<div class="jumbotron page-heading"> <h1 class="title" align="center">Edit your leave request</h1></div>
				<form method="post" action="update_request.php" style="margin: 10px;">
						<table cellpadding="5px" class="table" border="1" >
						
						<tr>
							<td class="font-weight-bold">Leave Type: 
								<input type="hidden" id="id" name="leave_id" value="<?= $_GET['leave_id'];?>" />
							</td>
							<td>
								<select name="leave_type" id="ltype" class="form-control" required="">
									<option value=" <?= $ltype_id;?> "> <?= $_GET['leave_type'];?> </option>
									<option value="11"> Casual Leave </option>
									<option value="12"> Sick Leave </option>
									<option value="13"> Earned Leave </option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>Start Date:	</td>
							<td> <input type="date" name="start_date" id="sdate" class="form-control" required="" value="<?= $_GET['start_date'];?>" readonly=""/></td>		</tr>
						
						<tr>
							<td>End Date:</td>
							<td><input type="date" name="end_date" id="edate" class="form-control" required="" value="<?= $_GET['end_date'];?>"/> </td>
						</tr>
												
						<tr>
							<td>Number of days:	</td>
							<td><input type="number" name="num_of_days" id="nod" class="form-control" required="" value="<?= $_GET['num_of_days'];?>"/></td>
						</tr>

						<tr>
							<td class="font-weight-bold"> Leave Status : </td>
							<td>
								<select name="status" id="status" class="form-control" required="">
									<option selected=""> Select your leave status ...</option>
									<option value="Planed"> Planed </option>
									<option value="Requested" selected=""> Requested </option>
								</select>
							</td>
						</tr>
						<tr> <th>Action:</th>
							<td>
								<input type="submit" id="update" name="submit" value="Update" class="btn btn-secondary"/>
									&nbsp;&nbsp;
								<input type="submit" id="delete" name="delete" value=" Delete " class="btn btn-danger"/>
							</td>
						</tr>
					</table>
					
					</form>
					<p id="msg"></p>
				</div>
				
				<div class="col-sm-5" style="padding-top: 100px;">
					<p class="title" align="justify" style="margin-right: 20px;"> <strong>Note: </strong> You can edit your previous leave request or you can delete current leave request and submit a new request.</p>
					<p id="info""></p>
				</div>
			</div>	<!--End of row-->	
		</div>

				<!--Linking Script files-->
	  	<script src="/szlms-hm/js/jquery-3.3.1.min.js"></script>
	  	<script src="/szlms-hm/js/popper.min.js"></script>
	  	<script src="/szlms-hm/js/fontawesome-all.min.js"></script>
  		<script src="/szlms-hm/js/bootstrap.min.js"></script>
	</body>
</html>
