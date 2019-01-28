<?php
	//session_start(); //starts the session
	require '../PHPMailer/PHPMailerAutoload.php';
	
	//$dir = $_SERVER["DOCUMENT_ROOT"];
	//include ($dir ."/szlms-hm/files/header_select.php");	 
	//require ($dir. "/szlms-hm/PHPMailer/PHPMailerAutoload.php");
	
	if($_SESSION['user']){ // checks if the user is logged in  
   	}else{
      header("location: /szlms-hm/index.php"); // redirects if user is not logged in
   	}
   	$user = $_SESSION['user']; //assigns user value
	
	function send_mail($to, $fromName, $attachment=null){
		$mail = new PHPMailer;

		$message = "";
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.ikracom-bd.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'leave_request@ikracom-bd.com';             // SMTP username
		$mail->Password = 'Samsung123';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		//$mail->setFrom('leave_request@ikracom-bd.com', 'SNA LMS');
		$mail->From = "leave_request@ikracom-bd.com";
		$mail->FromName = "SNA Leave Request";
		$mail->addAddress($to);     					// Add a recipient, add 2nd parameter as ,'Mostofa Suza'
		$mail->addAddress("mostofa.suza@solidaridadnetwork.org"); //Recipient name is optional
		$mail->addReplyTo($fromName, 'Do Not Reply');
		$mail->addCC('chistia@solidaridadnetwork.org','Chistia Hydar Sharmin');
		$mail->addCC($fromName);
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment($attachment);         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Request for leave';
		$mail->Body    = 'Dear Concern, <br> A leave request has been submitted by '. $fromName.'. <br>
		Please <a href="https://ikracom-bd.com/sna_lms/index.php">login</a> for details.';
		$mail->AltBody = 'Dear Concern, A leave request has been submitted by '.$fromName.'.';

		if(!$mail->send()) {
		    $message = 'Message could not be sent.';
		    $message .= '<br> Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    $message = 'Message has been sent';
		}
		return $message;
	}
	//############################################
	function reply_mail($to, $fromName, $status){
		$mail = new PHPMailer;

		$message = "";
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.ikracom-bd.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'leave_request@ikracom-bd.com';             // SMTP username
		$mail->Password = 'Samsung123';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		//$mail->setFrom('leave_request@ikracom-bd.com', 'SNA LMS');
		$mail->From = "leave_request@ikracom-bd.com";
		$mail->FromName = "SNA Leave Request";
		$mail->addAddress($fromName);     					// Add a recipient, add 2nd parameter as ,'Mostofa Suza'
		$mail->addAddress("mostofa.suza@solidaridadnetwork.org"); //Recipient name is optional
		$mail->addReplyTo($fromName);
		$mail->addCC('chistia@solidaridadnetwork.org','Chistia Hydar Sharmin');
		
		//$mail->addAttachment();         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'RE:Request for leave';
		$mail->Body    = 'Dear '. $fromName.', <br> <br>
		Your leave request has been <strong>'.$status.'.</strong>';
		$mail->AltBody = 'Your leave request has been '.$status;

		if(!$mail->send()) {
		    $message = 'Message could not be sent.';
		    $message .= '<br> Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    $message = 'Message has been sent';
		}
		//return $message;
	}
?>

