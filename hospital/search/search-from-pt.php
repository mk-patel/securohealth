<?php
	//Havind identity codes.
	require_once '../control/identification.php';
	
	if(isset($_SESSION['qrres_45'])){
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
		}else{
			echo "<script>
				alert('Invalid Card');
				window.location.href='../index.php';
			</script>";
		}
	}else{
		header('location:../index.php');
	}
	
	
	if(isset($_POST['name'])){
		$v = $_POST['name'];
		$value = aes_encrypt($_POST['name']);
		
		$trt_select = "select trt_id, trt_name, trt_date, trt_closing_date, trt_completed, hp_name from treatment_session
			inner join hospital on hp_id=trt_hp_id
			where trt_user_id='$user_id' and (trt_id LIKE '%".$v."%' or trt_name LIKE '%".$value."%')
			order by trt_id desc
			";
		$trt_result = mysqli_query($conn, $trt_select);
		if(mysqli_num_rows($trt_result)<=0){
			echo "<div class='text-center h5 p-3'>Not Found. Try using ID or Session Name</div>";
		}else{
			while($trt_row = mysqli_fetch_assoc($trt_result)){
				$date = aes_decrypt($trt_row['trt_date']);
				$bg = "background:white";
				$acti = "Open";
				if($trt_row['trt_completed']==1){
					$bg = "background:#ccffda";
					$date = aes_decrypt($trt_row['trt_closing_date']);
					$acti = "View";
				}
  ?>
  <div class="col-md-4">
	  <div class="card mb-4 box-shadow" style="<?php echo $bg;?>">
		<div class="card-body">
			<div class="d-flex justify-content-between">
				<div class="btn-group">
					<b><?php echo aes_decrypt($trt_row['trt_name']);?></b>
				</div>
				ID: <?php echo $trt_row['trt_id'];?>
			</div>
			<p class="card-text mt-1">
				<?php echo aes_decrypt($trt_row['hp_name']);?>
			</p>
			<p class="card-text text-muted"> 
				Opened: <?php echo aes_decrypt($trt_row['trt_date']);?><br/> 
				<?php
				if($trt_row['trt_completed']==1){
					echo "Discharged: ".aes_decrypt($trt_row['trt_closing_date']);
				}else{
					echo "Treatment running...";
				}
				?>
			</p>
			
		  <div class="d-flex justify-content-between align-items-center">
			<div class="btn-group">
			</div> <br>
			<a href="../session-details/treatment-categories.php?trt_id=<?php echo $trt_row['trt_id'];?>" class=""> <button type="button" class="btn btn-success btn-sm"><?php echo $acti;?></button> </a>
		  </div>
		</div>
	  </div>
	</div>
	<?php
			}
		}
	}
	?>