<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	$trt_id = aes_decrypt($_SESSION['trt_id_56']);
	
	// on submit button clicked.
	if(isset($_POST["tr_type"]) && isset($_POST["tr_title"]) && isset($_POST["tr_desc"]) && isset($_POST["tr_doctor"]) && isset($_POST["tr_cost"])){
		$tr_type = mysqli_real_escape_string($conn, $_POST['tr_type']);
		$tr_title = aes_encrypt(mysqli_real_escape_string($conn, $_POST['tr_title']));
		$tr_desc = aes_encrypt(mysqli_real_escape_string($conn, $_POST['tr_desc']));
		$tr_doctor = aes_encrypt(mysqli_real_escape_string($conn, $_POST['tr_doctor']));
		$tr_cost = aes_encrypt(mysqli_real_escape_string($conn, $_POST['tr_cost']));
		if(empty($tr_title)){
			$tr_title = aes_encrypt("NA");
		}
		if(empty($tr_cost)){
			$tr_cost = aes_encrypt('0');
		}
		$NAfile = aes_encrypt("NA");
		if(!empty($tr_desc) && !empty($tr_doctor)){
			if(!empty($tr_type)){
				
				// Setting up default timezone.
				date_default_timezone_set('Asia/Calcutta');
				$date=date("Y-m-d, h:i A");
				$date = aes_encrypt($date);
				
				if(!empty($_FILES["tr_files"]["tmp_name"])){
				
					$fileSize = $_FILES['tr_files']['size'];
					if($fileSize < 10000000){
						
						$target_directory = "../../files/";
						$target_file = $target_directory.basename($_FILES["tr_files"]["name"]); 
						$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
						$newfilename = uniqid('', true).".".$filetype;
						$path = "files/".$newfilename;
						$path = aes_encrypt($path);
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
	else{
		echo "Invalid Access!";
	}
?>