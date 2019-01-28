<?php
	//if (isset($_POST['submit'])) {

	$d1 = $_POST['d1'];
	$d2 = $_POST['d2'];
	
	$days1 = calWeekend($d1, $d2);
	$days2 = calHoliday($d1, $d2);

	echo ($days1 - $days2);

	//}
	function calWeekend($d1, $d2){
		$date1 = date_create($d1);
		$date2 = date_create($d2);

		$interval = date_diff($date1, $date2);
		$wdays = $interval->format('%a');
		$wdays++;

		while ( $date1 <= $date2) {
			$wd = $date1->format('D');

			if ($wd == "Fri" or $wd == "Sat"){
					$wdays--;
			}
		 	date_add($date1, date_interval_create_from_date_string('1 days'));
		}
		 return $wdays;
	}

	function calHoliday($date1, $date2){
		include_once "db_connect.php";
		//$conn = new mysqli("localhost","root","","smf");
		$sql = "SELECT date_ FROM holiday_list WHERE date_ BETWEEN '$date1' AND '$date2'";

		if($result = $conn->query($sql)){
			$hdays = $result->num_rows;
		}else{
				echo "Sz Error: ".$conn->error;
			}
		return $hdays;	
	}

?>