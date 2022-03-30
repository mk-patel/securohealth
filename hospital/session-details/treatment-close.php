<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';

	//Having card validation codes.
	require_once '../control/card-validation.php';
	
	if(isset($_POST['trt_id']) && !empty($trt_id)){
		$select_bill = "select bill_status from billing where bill_trt_id='$trt_id'";
		$bill_result = mysqli_query($conn, $select_bill);
		$bill_row = mysqli_fetch_assoc($bill_result);
		if($bill_row['bill_status'] == 0){
			echo "<script>
					alert('Bill not paid yet, collect the bill and try again');
					window.location.href='../index.php';
				</script>";
			echo "Bill not paid yet, collect the bill and try again";
		}else{
			
			// Setting up default timezone.
			date_default_timezone_set('Asia/Calcutta');
			$date=date("Y-m-d");
			$time=date("h:i A");
			$date = aes_encrypt($date." ".$time);
			
			$select_trt = "select trt_completed from treatment_session where trt_id='$trt_id'";
			$trt_result = mysqli_query($conn, $select_trt);
			$trt_row = mysqli_fetch_assoc($trt_result);
			if($trt_row['trt_completed']==0){
			
				$update_trt = "update treatment_session set trt_completed='1', trt_closing_date='$date' where trt_id='$trt_id'";
				if(mysqli_query($conn, $update_trt)){
					
					echo "<script>
							alert('Successfully Completed Discharge Process');
							window.location.href='../index.php';
						</script>";
					echo "Successfully Completed Discharge Process.";
				}else{
					echo "<script>
							alert('Unsuccessful!');
							window.location.href='../index.php';
						</script>";
					echo "Unsuccessful!";
				}
			}else{
				echo "<script>
						alert('Already Discharged');
						window.location.href='../index.php';
					</script>";
				echo "Successfully Re-Opened The File";
			}
		}
	}else{
		echo "Invalid Access!";
	}
?>