<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	//Having card validation codes.
	require_once '../control/card-validation.php';
	
	if(isset($_POST['trt_inf']) && isset($_POST['trt_dis']) && isset($_POST['trt_srt']) && isset($_POST['trt_corm'])){
		$trt_inf = aes_encrypt(mysqli_escape_string($conn, $_POST['trt_inf']));
		$trt_dis = aes_encrypt(mysqli_escape_string($conn, $_POST['trt_dis']));
		$trt_srt = aes_encrypt(mysqli_escape_string($conn, $_POST['trt_srt']));
		$trt_corm = aes_encrypt(mysqli_escape_string($conn, $_POST['trt_corm']));
		
		if(empty($trt_id) || empty($trt_inf) || empty($trt_dis) || empty($trt_srt) || empty($trt_corm)){
			echo "Empty field not allowed.";
		}else{
		
			$update_trt = "update treatment_session set trt_inf='$trt_inf', trt_dis='$trt_dis', trt_srt='$trt_srt', trt_corm='$trt_corm' where trt_id='$trt_id'";
			if(mysqli_query($conn, $update_trt)){
				echo "Successfully updated.";
			}else{
				echo "Unsuccessful!";
			}
		}
	}else{
		echo "Invalid Access!";
	}
?>