<?php
	//session_start(); //starts the session
	require '../PHPMailer/PHPMailerAutoload.php';
	
	$dir = $_SERVER["DOCUMENT_ROOT"];
	include ($dir ."/szlms-hm/files/header_select.php");	 
	//require ($dir. "/szlms-hm/PHPMailer/PHPMailerAutoload.php");
	
	if($_SESSION['user']){ // checks if the user is logged in  
   	}else{
      header("location: /szlms-hm/index.php"); // redirects if user is not logged in
   	}
   	$user = $_SESSION['user']; //assigns user value
	
	function send_mail($to, $fromName, $attachment=null){
		$mail = new PHPMailer;

		$message = "";
		$mail->SMTPDebug = 2;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.ikracom-bd.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'sna_lms@ikracom-bd.com';             // SMTP username
		$mail->Password = 'Snabd@123';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('sna_lms@ikracom-bd.com', 'SNA LMS');
		$mail->addAddress($to);     					// Add a recipient, add 2nd parameter as ,'Mostofa Suza'
		//$mail->addAddress('suza786@gmail.com');               // Name is optional
		$mail->addReplyTo('sna_lms@ikracom-bd.com', 'Do Not Reply');
		$mail->addCC('suza786@gmail.com','Chistia Hydar Sharmin');
		$mail->addCC($fromName);
		//$mail->addBCC('bcc@example.com');

		$mail->addAttachment($attachment);         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Request for leave';
		$mail->Body    = 'Dear Concern, <br> A leave request has been submitted by '. $fromName.'. <br>
		Please <a href="http://localhost/szlms-hm/">login</a> for details.';
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
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'sna_lms@ikracom-bd.com';             // SMTP username
		$mail->Password = 'Snabd@123';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom($fromName, 'SNA LMS');
		$mail->addAddress($to);     					// Add a recipient, add 2nd parameter as ,'Mostofa Suza'
		//$mail->addAddress('suza786@gmail.com');               // Name is optional
		$mail->addReplyTo('sna_lms@ikracom-bd.com', 'Do Not Reply');
		$mail->addCC('suza786@gmail.com','Chistia Hydar Sharmin');
		$mail->addCC($fromName);
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment();         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Request for leave';
		$mail->Body    = 'Dear '. $to.', <br>
		Your leave request has been <strong>'.$status.'.</strong>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    $message = 'Message could not be sent.';
		    $message .= '<br> Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    $message = 'Message has been sent';
		}
		//return $message;
	}
?>

