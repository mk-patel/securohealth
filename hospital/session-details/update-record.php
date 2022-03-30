<?php
	
	//Having identity codes.
	require_once '../control/identification.php';
	
	//Having card validation codes.
	require_once '../control/card-validation.php';
	
	$user_private_key = aes_decrypt($qr_card[1]);
	
	//Private encryption.
	require_once '../../sys-components/crypt/pvt-encrypt.php';
	require_once '../../sys-components/crypt/pvt-decrypt.php';
		
	// on submit button clicked.
	if(isset($_POST["tr_id"]) && isset($_POST["tr_title"])){
		$tr_title = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_title']), $user_private_key);
		$tr_desc = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_desc']), $user_private_key);
		$tr_doctor = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_doctor']), $user_private_key);
		$tr_cost = aes_pvt_encrypt(mysqli_real_escape_string($conn, $_POST['tr_cost']), $user_private_key);
		$tr_id = mysqli_real_escape_string($conn, $_POST['tr_id']);
		
		if(empty($tr_cost)){
			$tr_cost = aes_pvt_encrypt('0', $user_private_key);
		}
		
		if(empty($tr_title)){
			$tr_title = aes_pvt_encrypt('NA', $user_private_key);
		}
		
		if(!empty($tr_desc) && !empty($tr_doctor)){
			
			// Setting up default timezone.
			date_default_timezone_set('Asia/Calcutta');
			$date=date("Y-m-d, h:i A");
			$date = aes_pvt_encrypt($date, $user_private_key);
			
			if(!empty($_FILES["tr_files"]["tmp_name"])){
				$fileSize = $_FILES['tr_files']['size'];
				if($fileSize < 10000000){
					$file_select = "select tr_files from treatment_record where tr_id=$tr_id";
					$file_result = mysqli_query($conn, $file_select);
					
					if(mysqli_num_rows($file_result)>=1){
						$file_row = mysqli_fetch_assoc($file_result);
						$delete = "../../".aes_pvt_decrypt($file_row['tr_files'], $user_private_key);
						unlink($delete);
					}
					
					$target_directory = "../../files/";
					$target_file = $target_directory.basename($_FILES["tr_files"]["name"]); 
					$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$newfilename = uniqid('', true).".".$filetype;
					$path = "files/".$newfilename;
					$path = aes_pvt_encrypt($path, $user_private_key);
					if(move_uploaded_file($_FILES["tr_files"]["tmp_name"],$target_directory.$newfilename)){
					
						$sql = "update treatment_record set tr_title='$tr_title',tr_desc='$tr_title',tr_cost='$tr_cost',tr_doctor='$tr_doctor',tr_files='$path',tr_date='$date' where tr_id=$tr_id";
						if(mysqli_query($conn, $sql)){
							echo "Record Successfully Updated.";
						}
						else{
							echo "Not Updated, Try Again !";
							die(mysqli_error($conn));
						}
					}else{
						echo "file not supported";
					}
				}else{
					echo "Invalid, Please Upload Image Under 10MB Size";
				}
			}else{
				$sql = "update treatment_record set tr_title='$tr_title',tr_desc='$tr_title',tr_cost='$tr_cost',tr_doctor='$tr_doctor',tr_date='$date' where tr_id=$tr_id";
					if(mysqli_query($conn, $sql)){
					echo "Record Successfully Updated.";
				}
				else{
					echo "Not Updated, Try Again !";
					die(mysqli_error($conn));
				}
			}
		}else{
			echo "Some important fields are empty.";
		}
	}
	else{
		echo "Invalid";
	}
?>