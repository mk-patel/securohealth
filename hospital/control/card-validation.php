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
			
			$bkh_select = "select bkh_hp_id from blocked_hospital where (bkh_user_id='$user_id' and bkh_hp_id='$hp_id')";
			$bkh_result = mysqli_query($conn, $bkh_select);
			$bkh_row = mysqli_fetch_assoc($bkh_result);
			
			if($bkh_row['bkh_hp_id'] == $hp_id){
				echo "<script>
						alert('You do not have the permission to use this card.');
						window.location.href='../index.php';
					</script>";
			}
			
			// This is a Outside Database Connection code.
			$conn_nic = mysqli_connect("localhost", "root", "", "securohealth_nic_2799");

			// when the connection fails then error message will be printed.
			if(!$conn_nic){
				die("Connection Failed, Please Try Again !!".mysqli_connect_error());
			}else{
				$user_scanned_private_key = aes_decrypt($qr_card[1]);
				
				$key_select = "select sk_keys from secure_keys where sk_uid='$user_id'";
				$key_result = mysqli_query($conn_nic, $key_select);
				$key_row = mysqli_fetch_assoc($key_result);
				if(aes_decrypt($key_row['sk_keys']) != $user_scanned_private_key){
					echo "<script>
						alert('Invalid Card.');
						window.location.href='../index.php';
					</script>";
				}
			}
			
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