<?php

	// Database connection code.
	require_once "../sys-control/connection.php";
	
	// On submit button clicked.
	if(isset($_POST["uid"]) && isset($_POST["to"])){
		$user_id = mysqli_real_escape_string($conn, $_POST['uid']);
		$to =  mysqli_real_escape_string($conn, $_POST['to']);
					
		// Checking if there is any empty value.
		if(empty($user_id) || empty($to)){
			echo "Invalid input fields.";
		}
		else{
						
			// Generating verification code.
			$otp = mt_rand(000000,999999);
			
			// Inserting user data.
			$user_update = "update user set user_otp='$otp' where user_id=$user_id";
			
			// Checking whether the data are added or not
			if(mysqli_query($conn, $user_update)){
				
				// Including PHPMiler to send otp.
				/*include('../sys-components/smtp/index.php');
				$msg="Hi There,<br/> 
					Let's explore the secured health environment. <br/>
					Your Verification link:<br>
					http://localhost/myprojects/securohealth/login/authentication.php?uid=".$user_id."&vc=".$otp."<br>
					Valid for 10 minutes only.<br/><br/>
					Thanks & Regards<br/>
					Technical Lead - SecuroHealth";
				
				$is_mail_sent = smtp_mailer($to,'New SecuroHealth Verification',$msg);
				
				// Checking whether the mail sent or not.
				if($is_mail_sent == "Sent"){
					echo "New E-Mail Sent";
				}else{
					echo "Somethis went wrong on Mail System.";
				}*/
			}else{
				echo "Unsuccessful, Please Try Again.";
			}
		}
	}
	else{
		echo "Invalid";
	}
?>