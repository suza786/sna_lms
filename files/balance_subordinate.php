<?php
	session_start();
	require '../dompdf/autoload.inc.php';
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	if (isset($_POST['update'])) {
	$dompdf = new Dompdf();
	$html = pdfOutput();
	$dompdf->loadHtml($html);
	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');
	// Render the HTML as PDF
	$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream('Leave_Report.pdf',Array('Attachment'=>1));
	}	 
	echo getOutput();

	function getOutput(){
		include "header_select.php";
		$cur_year = date("Y");
		$output = "";
		$output .= "<div class='container mybody'><table align='center' border=1 class='table-sm table-hover table-bordered myfont'><tr><th>Name</th><th>CL Balance</th><th>SL Balance</th><th>EL Balance</th><th>Forwarded SL</th><th>Forwarded EL</th></tr>";

		$qry_type = "SELECT user_type FROM emp_details  WHERE emp_id = '$user'";
		$type = $conn->query($qry_type);
		$res = $type->fetch_assoc();
		if($res['user_type'] == "HR"){
			$sql_query = "SELECT emp_id, first_name, last_name FROM emp_details";
		}else{
			$sql_query = "SELECT emp_id, first_name, last_name FROM emp_details WHERE supervisor = '$user'";
		}	
		$name = $conn->query($sql_query);
		while ($rows = $name->fetch_assoc()){
		  	$output .=  "<tr><td>".$rows['first_name']." ".$rows['last_name']."</td>";
			$qry_leave_days = "SELECT balance FROM `leave_entitled_regular` WHERE emp_id = '".$rows['emp_id']. "'AND leave_year = '$cur_year'";
			
			$result = $conn->query($qry_leave_days);
				
			while ($value = $result->fetch_assoc()){
				$output .= "<td align='center'>".$value['balance']."</td>";
			}
			
			$sql = "SELECT fwrd_el, fwrd_sl FROM leave_forwarded WHERE emp_id = '".$rows['emp_id']. "'AND leave_year = '$cur_year'";
			$conn->query($sql);
			$result = $conn->query($sql);
			$value = $result->fetch_assoc();
			$output .= "<td align='center'>".$value['fwrd_sl']."</td></td>";
			$output .= "<td align='center'>".$value['fwrd_el']."</td></tr>";
		}	
		$output .= "</table>
			<a class='btn btn-secondary btn-lg' href='viewdata.php' role='button'>Back</a>";	
		$conn->close();
		return $output;
	}
	function pdfOutput(){
		include "db_connect.php";
		date_default_timezone_set('Asia/Dhaka'); //Set TimeZone
		$cur_year = date("Y");
		$pdfoutput = date( '\\D\a\t\e: j-M-Y h:i A');;
		$pdfoutput .= "<table border=1 width=100%><tr><th>Name</th><th>CL Balance</th><th>SL Balance</th><th>EL Balance</th><th>Forwarded SL</th><th>Forwarded EL</th></tr>";
		$user = $_SESSION['user'];
		$qry_type = "SELECT user_type FROM emp_details  WHERE emp_id = '$user'";

		$type = $conn->query($qry_type);
		$res = $type->fetch_assoc();
		if($res['user_type'] == "HR"){
			$sql_query = "SELECT emp_id, first_name, last_name FROM emp_details";
		}else{
			$sql_query = "SELECT emp_id, first_name, last_name FROM emp_details WHERE supervisor = '$user'";
		}	
		$name = $conn->query($sql_query);
		while ($rows = $name->fetch_assoc()){
		  	$pdfoutput .=  "<tr><td>".$rows['first_name']." ".$rows['last_name']."</td>";
			$qry_leave_days = "SELECT balance FROM `leave_entitled_regular` WHERE emp_id = '".$rows['emp_id']. "'AND leave_year = '$cur_year'";
			$result = $conn->query($qry_leave_days);
				
			while ($value = $result->fetch_assoc()){
				$pdfoutput .= "<td align='center'>".$value['balance']."</td>";
			}
			
			$sql = "SELECT fwrd_el, fwrd_sl FROM leave_forwarded WHERE emp_id = '".$rows['emp_id']. "'AND leave_year = '$cur_year'";
			$conn->query($sql);
			$result = $conn->query($sql);
			$value = $result->fetch_assoc();
			$pdfoutput .= "<td align='center'>".$value['fwrd_sl']."</td></td>";
			$pdfoutput .= "<td align='center'>".$value['fwrd_el']."</td></tr>";
		}	
		$pdfoutput .= "</table>";	
		$conn->close();
		return $pdfoutput;
	}
?>
<form method="post" style="margin: 10px;">
	<table cellpadding="5px" class="table" border="1" >
	<tr>
		<td>
			<input type="submit" id="update" name="update" value="Download Report" class="btn btn-warning"/>
		</td>
	</tr>
	</table>
</form>
</div>
<?php include "footer.php"; ?>