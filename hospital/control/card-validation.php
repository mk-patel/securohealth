<?php
	
	if(isset($_SESSION['qrres_45']) && isset($_SESSION['trt_id_56'])){
		$trt_id = aes_decrypt(mysqli_escape_string($conn, $_SESSION['trt_id_56']));
		$qrres = mysqli_escape_string($conn , $_SESSION['qrres_45']);
		
		$qr_card = explode(".", $qrres);
		
		$user_card = aes_decrypt($qr_card[0]);
		
		$proceed = 0;
		
		// Selecting trt id.
		$select_user_card = "select user_id, user_card, user_card_status from user";
		$select_user_card_result = mysqli_query($conn, $select_user_card);
		while($user_card_row_encrypted = mysqli_fetch_assoc($select_user_card_result)){
			$user_card_row = aes_decrypt($user_card_row_encrypted['user_card']);
			if($user_card_row == $user_card){
				$user_id = $user_card_row_encrypted['user_id'];
				$user_card_status = $user_card_row_encrypted['user_card_status'];
				$proceed = 1;
				break;
			}
		}
		if($proceed = 1){
			if(($user_card_status != 0) || ($user_card_row != $user_card)){
				echo "<script>
						alert('This card has been blocked, suggest to unblock it or generate a new card.');
						window.location.href='../index.php';
					</script>";
			}
			
			$select_trt_user_id = "select trt_user_id from treatment_session where trt_id='$trt_id'";
			$trt_user_id_result = mysqli_query($conn, $select_trt_user_id);
			$trt_user_id_row = mysqli_fetch_assoc($trt_user_id_result);
			$trt_user_id = $trt_user_id_row['trt_user_id'];
			
			if($trt_user_id != $user_id){
				echo "<script>
						alert('It is not associated with this treatment session.');
						window.location.href='../index.php';
					</script>";
			}
		}else{
			header('location:../index.php');
		}
	}else{
		header('location:../index.php');
	}
?>