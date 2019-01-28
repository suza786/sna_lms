<?php
	require_once 'autoload.inc.php';
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
		$output = date( '\\D\a\t\e: j-M-Y h:i A');
	$output .= "<div class='container mybody'><table align='center' border=1 class='table-sm table-hover table-bordered myfont'><tr><th>Name</th><th>CL Balance</th><th>SL Balance</th><th>EL Balance</th><th>Forwarded SL</th><th>Forwarded EL</th></tr>";
	//print date( '\\D\a\t\e: j-M-Y h:i A');
	if (isset($_POST['update'])) {
		$dompdf = new Dompdf();
		$dompdf->loadHtml($output);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream('Leave_Report.pdf',Array('Attachment'=>0));
	}
?>

<form method="post" style="margin: 10px;">
	<table cellpadding="5px" class="table" border="1" >
	<tr> <th>Action:</th>
		<td>
			<input type="submit" id="update" name="update" value="Update" class="btn btn-warning"/>
		</td>
	</tr>
	</table>
</form>
