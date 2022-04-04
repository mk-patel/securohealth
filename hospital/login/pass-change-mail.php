<?php
	// Database connection code.
	require_once "../../sys-control/connection.php";
	
	// Including cryptography codes.
	require_once "../../sys-components/crypt/pub-encrypt.php";
	require_once "../../sys-components/crypt/pub-decrypt.php";
	
	$proceed = 0;
	
	// On submit button clicked.
	if(isset($_POST["hp_email"])){
		$hp_email = mysqli_real_escape_string($conn, $_POST['hp_email']);
		
		$select_hp = "select hp_id, hp_email from hospital";
		$select_result = mysqli_query($conn, $select_hp);
		
		while($hp_row_encrypted = mysqli_fetch_assoc($select_result)){
			$hp_decrypted_email = aes_decrypt($hp_row_encrypted['hp_email']);
			if($hp_decrypted_email == $hp_email){
				$hp_id = $hp_row_encrypted['hp_id'];
				$proceed = 1;
				break;
			}
			else{
				$proceed = 0;
			}
		}
		if($proceed == 1){
			// Genarating Card Number
			function getTokan() {
				$n = 16;
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomString = '';
				for ($i = 0; $i < $n; $i++) {
					$index = rand(0, strlen($characters) - 1);
					$randomString .= $characters[$index];
				}
				
				return $randomString;
			}
			$tokan_string = getTokan();
			
			$select_fp = "select fp_hp_id from forget_pass where fp_hp_id='$hp_id'";
			$fp_result = mysqli_query($conn, $select_fp);
			
			if(mysqli_num_rows($fp_result)<=0){
				$tokan_query = "insert into forget_pass values('', '0', '$hp_id', '$tokan_string')";
			}else{
				$tokan_query = "update forget_pass set fp_tokan='$tokan_string' where fp_hp_id='$hp_id'";
			}
			
			if(mysqli_query($conn, $tokan_query)){
				// Including PHPMiler to send otp.
					/*include('../../sys-components/smtp/index.php');
					$msg="Hi There,<br/> 
						Your data security is the most important for us.<br/>
						Change your password by clicking this link:<br/><br/>
						http://localhost/myprojects/securohealth/hospital/login/reset-password.php?tokan=".$tokan_string."<br/><br/>
						<br/><br/>
						If you did not request password change, please ignore this mail.<br/>
						Thanks & Regards<br/>
						Technical Lead - SecuroHealth";
					
					$is_mail_sent = smtp_mailer($hp_email,'Reset Password - SecuroHealth',$msg);
					
					// Checking whether the mail sent or not.
					if($is_mail_sent == "Sent"){
						echo "Password reset e-mail has been sent.";
					}else{
						echo "Somethung went wrong with e-mail system, try again.";
					}*/
					echo "Email Successfully Sent.";
			}else{
				echo "Somethung went wrong, try again.";
			}
		}else{
			echo "Email Not Exist";
		}
	}else{
		echo "Invalid Access";
	}
?>