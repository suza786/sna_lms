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
	   	//$dir = $_SERVER["DOCUMENT_ROOT"];
	  	include "header_select.php";
	   		
		if($_SESSION['user']){ // checks if the user is logged in  
	   	} 
	   	else{
			header("location: ../index.php"); // redirects if user is not logged in
	   	}
		$user = $_SESSION['user']; //assigns user value
	?>
	<script type="text/javascript">
	  $( function() {
		$('#el_date').datepicker();
			$( "#el_date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	  });	
	</script>
 
	<body>
		<div class="container mybody">
			<div class="row">
				<div class="Col-off-2 col-sm-10">
					<div class="jumbotron page-heading"> <h1 class="title" align="center">Allocate Common Earn Leave</h1></div>
				<form method="post" style="margin: 10px;">
						<table cellpadding="5px" class="table" border="1" >
						
						<tr>
							<td class="font-weight-bold"> EL Title : </td>
							<td> <input type="text" name="title" class="form-control"/></td>	
						</tr>
						<tr>
							<td>Date of El:	</td>
							<td> <input type="text" name="el_date" id="el_date" class="form-control" required=""/></td>		
						</tr>

						<tr>
							<td> Note : </td>
							<td> <input type="text" name="note" id="note" class="form-control"/></td>	
						</tr>
						<tr> <th>Action:</th>
							<td>
								<input type="submit" id="update" name="update" value="Update" class="btn btn-warning"/>
							</td>
						</tr>
					</table>
					
					</form>
					<p id="msg"></p>
				</div>
			</div>	<!--End of row-->	
		</div>

	</body>
	<?php include "footer.php"; ?>
</html>
<?php
	if (isset($_POST['update'])) {
		$el_title = $_POST['title'];
		$date = date_create($_POST['el_date']);
		$note = $_POST['note'];
		
		$year = $date->format('Y');
		$month = $date->format('m');
		$days = $date->format('d');
		$el_date = $year."-".$month."-".$days;

		$sql_el = "INSERT INTO allocate_el (el_title, el_date, note) VALUES ('$el_title','$el_date','$note')";
		
		if ($conn->query($sql_el)== TRUE){
			$update_el = "UPDATE leave_entitled_regular SET balance = balance-1 WHERE leave_year  = '$year' AND leave_type_id = 13";
			if ($conn->query($update_el)!= TRUE){
				echo "<script>alert('Failed to update EL leave')</script>";
			}
		}else {
			echo "Error".$conn->error;
		}
	}
?>