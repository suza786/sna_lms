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
		$('#from').datepicker({ numberOfMonths: 2});
			$( "#from" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$('#to').datepicker({ numberOfMonths: 2});
			$( "#to" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	  });	
	</script>
 
	<body>
		<div class="container mybody">
			<div class="row">
				<div class="Col-off-2 col-sm-10">
					<div class="jumbotron page-heading"> <h1 class="title" align="center">Add your yearly holidays</h1></div>
				<form method="post" style="margin: 10px;">
						<table cellpadding="5px" class="table" border="1" >
						
						<tr>
							<td class="font-weight-bold"> Occasion Name : </td>
							<td> <input type="text" name="occation" class="form-control"/></td>	
						</tr>
						<tr>
							<td>From:	</td>
							<td> <input type="text" name="from" id="from" class="form-control" required=""/></td>		
						</tr>
						
						<tr>
							<td>To:</td>
							<td> <input type="text" name="to" id="to" class="form-control" required=""/></td>	
						</tr>
												
						<tr>
							<td>Number of days:	</td>
							<td><input type="number" name="num_of_days" id="nod" class="form-control"/></td>
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
				
				<!--<div class="col-sm-5" style="padding-top: 100px;">
					<p class="title" align="justify" style="margin-right: 20px;"> <strong>Note: </strong> You can edit your previous leave request or you can delete current leave request and submit a new request.</p>
					<p id="info""></p>
				</div>-->
			</div>	<!--End of row-->	
		</div>

	</body>
	<?php include "footer.php"; ?>
</html>
<?php
	if (isset($_POST['update'])) {

		$occation_name = $_POST['occation'];
		$date1 = date_create($_POST['from']);
		//$date1 = $_POST['from'];
		$date2 = date_create($_POST['to']);
		$num_days = $_POST['num_of_days'];
		$note = $_POST['note'];
			$x=1;
		while ( $date1 <= $date2) {
				
			$year = $date1->format('Y');
			$month = $date1->format('m');
			$days = $date1->format('d');
			$date_ = $year."-".$month."-".$days;
			
			//$sql = "INSERT INTO holiday_list(name,year,month,day,note) VALUES ('$occation_name','$year','$month','$days','$note')";
			$sql = "INSERT INTO holiday_list (name, date_, note) VALUES ('$occation_name','$date_','$note')";
		
			if ($conn->query($sql)== TRUE){
				
			}else {
				echo "Error".$conn->error;
			}
			date_add($date1, date_interval_create_from_date_string('1 days'));
			$x++;
		}
		echo "<br/><br/>OK";
	}
?>