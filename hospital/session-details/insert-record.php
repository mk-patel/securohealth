<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	//Having card validation codes.
	require_once '../control/card-validation.php';
	
	$user_private_key = aes_decrypt($qr_card[1]);
	
	// on submit button clicked.
	if(isset($user_private_key) && isset($_POST["tr_type"]) && isset($_POST["tr_title"]) && isset($_POST["tr_desc"]) && isset($_POST["tr_doctor"]) && isset($_POST["tr_cost"])){
		$user_status_select = "select user_status from user where user_id='$user_id'";
		$user_status_result = mysqli_query($conn, $user_status_select);
		$user_status_row = mysqli_fetch_assoc($user_status_result);
		
		if($user_status_row['user_status'] == 2){
			echo "This account has been Deactivated.";
		}else{
			//Private encryption.
			require_once '../../sys-components/crypt/pvt-encrypt.php';
			
			$tr_type = mysqli_real_escape_string($conn, $_POST['tr_type']);
			$tr_title = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_title']), $user_private_key);
			$tr_desc = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_desc']), $user_private_key);
			$tr_doctor = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_doctor']), $user_private_key);
			$tr_cost = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_cost']), $user_private_key);
			if(empty($tr_title)){
				$tr_title = aes_pvt_encrypt("NA", $user_private_key);
			}
			if(empty($tr_cost)){
				$tr_cost = aes_pvt_encrypt('0', $user_private_key);
			}
			$NAfile = aes_pvt_encrypt("NA", $user_private_key);
			if(!empty($tr_desc) && !empty($tr_doctor)){
				if(!empty($tr_type)){
					
					// Setting up default timezone.
					date_default_timezone_set('Asia/Calcutta');
					$date=date("Y-m-d, h:i A");
					$date = aes_pvt_encrypt($date, $user_private_key);
					
					if(!empty($_FILES["tr_files"]["tmp_name"])){
					
						$fileSize = $_FILES['tr_files']['size'];
						if($fileSize < 10000000){
							
							$target_directory = "../../files/";
							$target_file = $target_directory.basename($_FILES["tr_files"]["name"]); 
							$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
							$newfilename = uniqid('', true).".".$filetype;
							$path = "files/".$newfilename;
							$path = aes_pvt_encrypt($path, $user_private_key);
							if(move_uploaded_file($_FILES["tr_files"]["tmp_name"],$target_directory.$newfilename)){
								$sql = "INSERT INTO treatment_record(tr_trt_id,tr_title,tr_desc,tr_cost,tr_doctor,tr_files,tr_type,tr_date) 
										VALUES('$trt_id','$tr_title','$tr_desc','$tr_cost','$tr_doctor','$path','$tr_type','$date')";
								if(mysqli_query($conn, $sql)){
									
									echo "Successfully Inserted.";
								}
								else{
									echo "Not Inserted, Try Again !";
								}
							}else{
								echo "File not uploaded, Try Again !";
							}
						}else{
							echo "Invalid, Please Upload File Under 10MB Size.";
						}
					}else{
						$sql = "INSERT INTO treatment_record(tr_trt_id,tr_title,tr_desc,tr_cost,tr_doctor,tr_files,tr_type,tr_date) 
								VALUES('$trt_id','$tr_title','$tr_desc','$tr_cost','$tr_doctor','$NAfile','$tr_type','$date')";
						if(mysqli_query($conn, $sql)){
							
							echo "Successfully Inserted.";
						}else{
							echo "Not Inserted, Try Again!";
						}
					}
				}else{
					echo "Something went wrong!";
				}
			}else{
				echo "Empty Field Not Allowed, Please Fill Doctor Name and Description.";
			}
		}
	}
	else{
		echo "Invalid Access!";
	}
?>