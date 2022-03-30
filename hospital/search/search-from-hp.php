<?php
	//Havind identity codes.
	require_once '../control/identification.php';
	
	if(isset($_POST['name'])){
		$v = $_POST['name'];
		$value = aes_encrypt($_POST['name']);
		$trt_select = "select trt_id, trt_name, user_first_name, user_last_name, user_dob, user_gender, user_card, trt_date, trt_closing_date, trt_completed from treatment_session
			inner join user on user_id=trt_user_id
			where trt_hp_id=$hp_id and (trt_id LIKE '%".$v."%' or trt_name LIKE '%".$value."%' or user_first_name LIKE '%".$value."%' 
			or user_last_name LIKE '%".$value."%' or user_card LIKE '%".$value."%')
			order by trt_id desc
			";
		$trt_result = mysqli_query($conn, $trt_select);
		if(mysqli_num_rows($trt_result)<=0){
			echo "<div class='text-center h5 p-3'>Not Found. Try using ID, Name or Session Name</div>";
		}else{
			while($trt_row = mysqli_fetch_assoc($trt_result)){
				$date = aes_decrypt($trt_row['trt_date']);
				$user_card = aes_decrypt($trt_row['user_card']);
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
					<b><?php echo aes_decrypt($trt_row['trt_name']);?> (<?php echo aes_decrypt($trt_row['user_first_name'])." ".aes_decrypt($trt_row['user_last_name']) ;?>)</b>
				</div>
				ID: <?php echo $trt_row['trt_id'];?>
			</div>
			<p class="card-text mt-1">
				Age: <?php echo aes_decrypt($trt_row['user_dob']);?>, Gender: <?php echo aes_decrypt($trt_row['user_gender']);?><br/>
				Date: <?php echo $date;?>
			</p>
			<p class="card-text text-muted"> Card : <?php echo substr($user_card,0,4)." ".substr($user_card,4,3)." ".substr($user_card,7,4);?> </p>
		  <div class="d-flex justify-content-between align-items-center">
			<div class="btn-group">
			</div> <br>
			<a href="session-details/treatment-session.php?trt_name=<?php echo aes_decrypt($trt_row['trt_name']);?>" class=""> <button type="button" class="btn btn-success btn-sm"><?php echo $acti;?></button> </a>
		  </div>
		</div>
	  </div>
	</div>
	<?php
			}
		}
	}
	?>