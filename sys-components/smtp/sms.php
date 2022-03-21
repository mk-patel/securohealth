<?php

// Including PHPMiler to send otp.
include('smtp/PHPMailerAutoload.php');

// Function to send the mail.
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->Encoding = '7bit';
	
	$mail->Username = "mkp.manishpatel@gmail.com";
	$mail->Password = "Manish9826@";
	
	$mail->Subject = "important";
	$mail->Body = "hi";
	
	$mail->AddAddress("6264515763@vtext.com");

	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		echo 'Sent';
	}

?>