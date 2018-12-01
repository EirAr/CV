<?php
	//Import the PHPMailer class into the global namespace
	use PHPMailer\PHPMailer\PHPMailer;
	require 'vendor/autoload.php';

	$email = $_POST['email'];
	$name = $_POST['name'];
	$message = $_POST['message'];
	$subject = $_POST['subject'];

	if ($name === ''){
		print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
		exit();
	}
	if ($email === ''){
		print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
		exit();
	} else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
			exit();
		}
	}
	if ($subject === ''){
		print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
		exit();
	}
	if ($message === ''){
		print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
		exit();
	}

	$mail = new PHPMailer;
	$mail->IsSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'linux41.papaki.gr';                    // Specify main and backup server
	$mail->Username = 'info@arapkoule.me';                // SMTP username
	$mail->Password = 'M6Reuhudw!@#';                  	  // SMTP password
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'tls' also accepted
	$mail->Port = 465;                                    // Set the SMTP port

	$mail->setFrom('info@arapkoule.me', 'Info Arapkoule');
	$mail->AddAddress('eirini.arapkoule@gmail.com');  	  // Add a recipient

	$mail->Subject = $subject;
	$mail->Body = "From: $email\r\nName: $name\r\nMessage: $message";

	if(!$mail->Send()) {
		print json_encode(array('message' => 'Message could not be sent', 'code' => 0));
		exit();
	}

	print json_encode(array('message' => 'Email successfully sent!', 'code' => 1));
	exit();
?>