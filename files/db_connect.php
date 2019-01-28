<?php
	
	$servername = "localhost" ;
	$user = "root";
	$password = "";
	$db_name = "sna_lms";
	
	$conn = new mysqli($servername,$user,$password,$db_name);
	
	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	} 

?>