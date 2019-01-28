<?php
	
	$servername = "localhost" ;
	$user = "ikracombd_suza";
	$password = "SNA@House32";
	$db_name = "ikracombd_sna_lms";
	
	$conn = new mysqli($servername,$user,$password,$db_name);
	
	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	} 

?>