<?php
session_start();
session_destroy();
header("location: /sna_lms/index.php");
?>