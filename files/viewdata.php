<?php
	session_start();
	include "header_select.php";
	include_once "db_connect.php";;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	<title></title>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#l-status').click(function(event){
				event.preventDefault();
				$.ajax({
					url:"leave_status.php",
					dataType:"html",
					success: function(result){
					$('#data').html(result);
					}
				})
			})
		})
	</script>
	</head>
	<body>
	<div class="container mybody">
		<div class="jumbotron page-heading"> 
		<h1>Your leave related information</h1>
		</div>
		<nav class="nav navbar">
			<ul>
				<li> <a href="" id="l-status" class="title"> List of leaves you submitted </a>	</li>
				<li> <a href="leave_approval.php" class="title">List of leaves for approval by your subordinate</a> </li>
				<li> <a href="balance_subordinate.php" class="title">Available leave balance of subordinates</a> </li>
			</ul>
		</nav>

		<span id="data"></span>
	</div><!--End of container-->
	</body>
</html>
<?php include "footer.php"; ?>