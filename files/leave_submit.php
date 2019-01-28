<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<?php
	/*$to = "suza786@gmail.com";
	$subject = "My subject";
	$txt = "Hello world!";
	$headers = "From: unifoxdigital.mizan@gmail.com" . "\r\n" .
	"CC: jubairmizan@gmail.com";

	mail($to,$subject,$txt,$headers);
	die('adsf');*/
	include "header_select.php";
   	include "mail.php";	 
	
	if($_SESSION['user']){ // checks if the user is logged in  
   	}
   	else{
      header("location: ../index.php"); // redirects if user is not logged in
   	}
	$user = $_SESSION['user']; //assigns user value
	
	// ############ Retrive current user email address
	$qry_user_email = "SELECT email FROM emp_details WHERE emp_id = '$user'";
	$qry_result = $conn->query($qry_user_email);
	$rows = $qry_result->fetch_array();
	$user_email = $rows['email'];
	$cur_year = date("Y");
	
	if (isset($_POST['submit1'])){	//For regular leave
   		
   		$ltype = $_POST['leave_type'];
		$today = date('Y-m-d');
		$sdate = $_POST['start_date'];
		$edate = $_POST['end_date'];
		$nodays= $_POST['nodays'];
		$supervisor = $_POST['supervisor_id'];
		$status	= $_POST['status'];
		$note = $_POST['note'];
		
		$sql = $sql = "INSERT INTO leave_requested(emp_id, leave_type_id, curr_date, start_date, end_date, num_of_days, status, supervisor_id, note) VALUES ('$user', '$ltype', '$today', '$sdate','$edate','$nodays', '$status', '$supervisor', '$note')";
		
		if($conn->query($sql) == TRUE){
			//echo "";
			// ######## Send mail to respective persons ############
			if($status == "Requested"){
				// ############ Retrive supervisor email address
				$qry_supervisor_email = "SELECT email FROM emp_details WHERE emp_id = '$supervisor'";
				$qry_result = $conn->query($qry_supervisor_email);
				$rows = $qry_result->fetch_assoc();
				$supervison_email = $rows['email'];
				
				$msg = send_mail($supervison_email, $user_email);
				echo $msg." <script>alert('Leave request successfully submitted')</script>";
				//echo "<script>document.getElementById('display').innerHTML = '<br/>Leave request successfully submitted<br/>'</script>";
			}
		}
		else{
			echo "<br/>Error : ".$conn->error;
		}
   } 
//############################--For irregular leave--#####################$$$$$$$$$$$$$$$$$$$$$$$$$$
	if (isset($_POST['submit2'])){	//For irregular leave
   		
   		$ltype = $_POST['leave_type'];
		$today = date('Y-m-d');
		$sdate = $_POST['start_date'];
		$edate = $_POST['end_date'];
		$nodays= $_POST['nodays'];
		$supervisor = $_POST['supervisor_id'];
		$note = $_POST['note'];
		
		// ################### Documents upload steps ######################
		$docTempName = $_FILES['document']['tmp_name'];
		$docName = $_FILES['document']['name'];
		$docType = $_FILES['document']['type'];
		$docSize = $_FILES['document']['size'];

		if($docSize == FALSE){
			echo "Please select a supporting documet";
		} else {
			$dtype = array('application/pdf');
			if(in_array($docType, $dtype)){
				if(move_uploaded_file($docTempName, "uploads/documents/$docName")){
					$sql = "INSERT INTO leave_requested(emp_id, leave_type_id, curr_date, start_date, end_date, num_of_days, supervisor_id, doc_of_ir_leave, note) VALUES ('$user', '$ltype', '$today', '$sdate','$edate','$nodays','$supervisor', '$docName', '$note')";
		
					if($conn->query($sql) == TRUE){
						//echo "<br/>Leave request successfully submitted";
						// ######## Send mail to respective persons ############
						// ############ Retrive supervisor user email address
						$qry_supervisor_email = "SELECT email FROM emp_details WHERE emp_id = '$supervisor'";
						$qry_result = $conn->query($qry_supervisor_email);
						$rows = $qry_result->fetch_assoc();
						$supervison_email = $rows['email']; 
						
						$file_name = $dir ."./uploads/documents/".$docName;
						$msg = send_mail($supervison_email, $user_email, $file_name);
						echo $msg. " <script>alert('Leave request successfully submitted')</script>";
					}
					else{
						echo "<br/>Error : ".$conn->error;
					}
				}
			}else {
					echo "File type must be .pdf";
				}	
		}			
	} 
?>
<script>
	$( function(){
	
		$("#sdate").datepicker({changeMonth:true, changeYear:true});
			$( "#sdate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$("#edate").datepicker({changeMonth:true, changeYear:true});
			$( "#edate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );	

		$("#sdate_ir").datepicker({changeMonth:true, changeYear:true});
			$( "#sdate_ir" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$("#edate_ir").datepicker({changeMonth:true, changeYear:true});
			$( "#edate_ir" ).datepicker( "option", "dateFormat", "yy-mm-dd" );	
						
		$('#nod').click(function(event){
			var ajx_obj	= new XMLHttpRequest();
			ajx_obj.open("post","calculate_leave_days.php",true);
			ajx_obj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			ajx_obj.onreadystatechange = function(){
				if(ajx_obj.readyState == 4 && ajx_obj.status == 200){
					$('#nod').val(ajx_obj.responseText);
					
				}
			}
			var dt1 = $('#sdate').val();
			var dt2 = $('#edate').val();

			ajx_obj.send("d1="+dt1+"&d2="+dt2);
			//document.getElementById("info").innerHTML = "Processing... ";
			event.preventDefault();
		})
	});
</script>
</head>
<body>
	<div class="container mybody">
		<div class="row">
			<div class="col-sm-6">
				<div class="page-heading"> <h1 class="title">Submit a leave request</h1></div>
				<div class="accordion" id="accordionExample">
	<!--########## Section for leave buttons ############-->
			<!--########## 1. Section for Regular leave button ############-->					
  					<div class="card mycard">
						<div class="card-header" id="headingOne">
					        <h5 class="mb-0">
					          <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseOne">
					             Regular Leave
					          </button>
					          &nbsp;&nbsp;&nbsp;
					           <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseTwo">
				             Irregular Leave
				          </button>
					        </h5>
					    </div>

					    <div id="collapseOne" class="collapse" data-parent="#accordionExample">
					    <div class="jumbotron page-heading"> <h3 class="title" align="center"><u>Regular Leave</u></h3></div>
					        <div class="card-body">
					            <form method="post">
					                <table cellpadding="5px" class="table" >
					                
					                <tr>
					                  <td class="font-weight-bold">Leave Type: </td>
					                  <td>
					                    <select name="leave_type" class="form-control" required="">
					                      <option selected value=""> Select leave type ...</option>
					                      <option value="11"> Casual Leave </option>
					                      <option value="12"> Sick Leave </option>
					                      <option value="13"> Earned Leave </option>
					                    </select>
					                  </td>
					                </tr>
					                
					                <tr>
					                  <td>Start Date: </td>
					                  <td> <input type="text" name="start_date" id="sdate" class="form-control" required="">  </td>
					                </tr>
					                
					                <tr>
					                  <td>End Date:</td>
					                  <td><input type="text" name="end_date" id="edate" class="form-control" required=""></td>
					                </tr>
					                            
					                <tr>
					                  <td>No. of days:</td>
					                  <td><input type="text" name="nodays" id="nod" class="form-control" readonly="" value="Click here"/></td>
					                </tr>
					                <tr>
					                  <td> <label class="col-form-lebel" for="supervise"> Sepervisor:</label></td>
					                  <td>
					                    <Select class='form-control' name='supervisor_id' required="">
					                    <option value=""> Select your supervisor..</option>
					                    <?php 
					                      //Retriving employee/supervisor id from dropdown menu;
					                      $sql_query = "SELECT emp_id, first_name, last_name FROM emp_details";
					                      if($conn->query($sql_query)== TRUE){
					                        $name = $conn->query($sql_query);

					                        while ($rows = $name->fetch_assoc()){
					                          echo  "<option value=".$rows['emp_id'].">".$rows['first_name']." ".$rows['last_name']."</option>";                      	                        }
					                      }
					                      else{
					                        echo $conn->error;
					                      }
					                    ?> </Select>
					                  </td>
					                </tr>
					                <tr>
					                  <td>Leave Status : </td>
					                  <td>
					                    <select name="status" class="form-control" required="">
					                      <option selected=""> Select your leave status ...</option>
					                      <option value="Planed"> Planed </option>
					                      <option value="Requested"> Requested </option>
					                    </select>
					                  </td>
					                </tr>
					                <tr>
					                  <td>Note:</td>
					                  <td><textarea class="form-control" name="note"></textarea></td>
					                </tr>

					                <tr> <td></td>
					                  <td><input type="submit" name="submit1" value="Submit" class="btn btn-primary"/>
					                    <input type="reset" name="reset" value=" Reset " class="btn"/></td>
					                  </td>
					                </tr>
					              </table>        
					              </form>
					        </div>
					    </div>

					</div>
			<!--########## 2. Section for Irregular leave buttons ############-->	
 					<div class="card mycard">
				      <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
				      <div class="page-heading"> <h3 class="title" align="center"><u>Irregular Leave</u></h3></div>
				        <div class="card-body">
				          <form method="post" enctype="multipart/form-data">
				          	<table cellpadding="5px" class="table" >
				                <tr>
				                  <td class="font-weight-bold">Leave Type: </td>
				                  <td>
				                    <select name="leave_type" class="form-control" required="">
				                      <option selected value=""> Select leave type ...</option>
				                      <option value="14"> Compensatory Leave </option>
				                      <option value="15"> Maternity Leave </option>
				                      <option value="16"> Paternity Leave </option>
				                      <option value="17"> Miscarriage Leave </option>
				                    </select>
				                  </td>
				                </tr>
				                
				                <tr>
				                  <td>Start Date: </td>
				                  <td> <input type="text" name="start_date" id="sdate_ir" class="form-control" required="">  </td>
				                </tr>
				                
				                <tr>
				                  <td>End Date:</td>
				                  <td><input type="text" name="end_date" id="edate_ir" class="form-control" required=""></td>
				                </tr>
				                            
				                <tr>
				                  <td>No. of days:</td>
				                  <td><input type="text" name="nodays" id="no_ir_days" class="form-control"/></td>
				                </tr>
				                <tr>
				                  <td> <label class="col-form-lebel" for="supervise"> Sepervisor:</label></td>
				                  <td>
				                    <Select class='form-control' name='supervisor_id' required="">
				                    <option value=""> Select your supervisor..</option>
				                    <?php 
				                      //Retriving employee/supervisor id from dropdown menu;
				                      $sql_query = "SELECT emp_id, first_name, last_name FROM emp_details";
				                      if($conn->query($sql_query)== TRUE){
				                        $name = $conn->query($sql_query);

				                        while ($rows = $name->fetch_assoc()){
				                          echo  "<option value=".$rows['emp_id'].">".$rows['first_name']." ".$rows['last_name']."</option>";                      
				                        }
				                      }
				                      else{
				                        echo $conn->error;
				                      }
				                    ?>
				                    </Select>
				                  </td>
				                </tr>
				                <tr>
				                  <td>Upload Documents : </td>
				                  <td><input type="file" class="form-control" id="document" name="document" required=""></td>
				                </tr>
				                <tr>
				                  <td>Note:</td>
				                  <td><textarea class="form-control" name="note"></textarea></td>
				                </tr>

				                <tr> <td></td>
				                  <td><input type="submit" name="submit2" value="Submit" class="btn btn-primary"/>
				                    <input type="reset" name="reset" value=" Reset " class="btn"/></td>
				                  </td>
				                </tr>
				              </table>
				              
				              </form>
				        </div>
				      </div>
				  </div>
	<!--########## End Section for leave buttons ############-->
				</div>
				<div>
					<p id="display" style="margin: 10px 20px"></p>
				</div>
			</div>
			<div class="col-sm-6">
				
				<!--###############################################-->
					<div class="page-heading" align="center"> <h2 class="title">Your leave information</h2></div>
				  <!-- ##################### Section for regular available leave ###########################--> 
				  <div class="text-center">
		   				 <h3 class="text-capitalize">available leave status</h3>
		   				 <hr/>
		    			<table cellpadding="5px" border="1" align="center" cellspacing="0">
		      
					<?php 
						$sql = "SELECT l.leave_type, le.balance from leave_type l join leave_entitled_regular le on l.leave_type_id = le.leave_type_id WHERE emp_id = '$user' AND le.leave_year = '$cur_year'";
				   		if($conn->query($sql) == TRUE){
							$result = $conn->query($sql);
							
							echo "<tr><th>Leave Types</th><th> Remaining Days </th></tr>";
							while ($value = $result->fetch_assoc()){
								echo "<tr><td align='left'>".$value['leave_type']."</td><td>".$value['balance']."</td></tr>";
							}			
						}	
						else{
							echo "<br/>Error : ".$user_email = $rows['email']; 
						}
 				//<!-- ##################### End Section for regular available leave ###########################--> 
 				//<!-- ##################### Section for carry forwarded  leave ###########################--> 
						$sql = "SELECT fwrd_el, fwrd_sl FROM leave_forwarded WHERE emp_id = '$user' AND leave_year = '$cur_year'";
				   		$conn->query($sql);
						$result = $conn->query($sql);
						$value = $result->fetch_assoc();
						echo "<tr><td align='left'>Forwarded SL</td><td>".$value['fwrd_sl']."</td></tr>";
						echo "<tr><td align='left'>Forwarded EL </td><td>".$value['fwrd_el']."</td></tr>";
					?> 
				   	</table>
				</div>
				<!-- ##################### End Section for carry forwarded leave ###########################--> 
			</div><!--End of Col-sm-6 -->
		</div>	
	</div><!--End of Container-->
</body>
</html>
<?php include "footer.php"; ?>