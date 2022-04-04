<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	if(isset($_REQUEST['tr_type'])){
		$tr_type = mysqli_escape_string($conn, $_REQUEST['tr_type']);
		$trt_id = aes_decrypt($_SESSION['trt_id_56']);
	}else{
		header('location:../index.php');
	}
	
	//Having card validation codes.
	require_once '../control/card-validation.php';
	
	$user_private_key = aes_decrypt($qr_card[1]);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
  <meta name="keywords" content="health records, health history, health security, online health documents">
  <meta name="author" content="Manish Patel, Pankaj Sahu">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!--using FontAwesome--------------->
  <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Shortcut Icon for Browser-->
  <link rel="shortcut icon" href="sys-images/logo.png" />
  <title>SecuroHealth</title>
  <!-- Internal css to manage the styling in a simple way-->
  <style>
    body {
      background-image: linear-gradient(to bottom, #fff0f5, white);
    }

    .nav-bg {
      background: #f8c8dc;
    }
	
	.header-navi{
		display:none;
	}
	
	.header-navi-1{
		display:block;
	}
	
    .heading-text {
      color: #191970;
    }

    .paragraph-text {
      color: #301934;
    }

    .btn-strong-color {
      background: #ff69b4;
      color: #191970;
      font-weight: 600;
    }

    .btn-strong-color:hover {
      background: #ff10f0;
    }

    .btn-loose-color {
      background: white;
      color: #ff69b4;
      font-weight: 600;
      border: 1px solid #191970;
    }

    .feather {
      width: 16px;
      height: 16px;
      vertical-align: text-bottom;
    }

    .text-opd-medicine {
      padding: 10px;
      margin: 10px;
    }

    /*
 * Sidebar
 */

    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
      /* Behind the navbar */
      padding: 0;
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar-sticky {
      position: -webkit-sticky;
      position: sticky;
      top: 48px;
      /* Height of navbar */
      height: calc(100vh - 48px);
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto;
      /* Scrollable contents if viewport is shorter than content. */
    }

    .sidebar .nav-link {
      font-weight: 500;
      color: #333;
    }

    .sidebar .nav-link .feather {
      margin-right: 4px;
      color: #999;
    }

    .sidebar .nav-link.active {
      color: #007bff;
    }

    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
      color: inherit;
    }

    .sidebar-heading {
      font-size: .75rem;
      text-transform: uppercase;
    }

    /*
 * Navbar
 */

    .navbar-brand {
      padding-top: .2rem;
      padding-bottom: .2rem;
      font-size: 1.4rem;
      background: #f8c8dc;
      color: black;
    }

    .navbar-brand:hover {
      color: inherit;
    }

    /*
 * Utilities
 */

    .border-top {
      border-top: 1px solid #e5e5e5;
    }

    .border-bottom {
      border-bottom: 1px solid #e5e5e5;
    }
	
	.sub-info{
		font-size:13px;
	}
	
	@media(max-width:991px){
		.header-navi{
			display:block;
		}
		.header-navi-1{
			display:none;
		}
		.container-fluid{
			display:none;
		}
	}
  </style>
</head>

<body>
	<nav class="navbar navbar-expand-lg nav-bg sticky-top flex-md-nowrap navbar-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="../../sys-images/long-logo.png" alt="" width="200" height="30" class="rounded bg-white d-inline-block align-text-top heading-text">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav header-navi-1 mr-auto">
					<li class="nav-item">
					</li>
					<li class="nav-item">
					</li>
				</ul>
				<ul class="navbar-nav header-navi mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">
						<span>
							<i class="fa fa-home" aria-hidden="true"></i>
						</span>
						Dashboard
					  </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../patient-files/">
						<span>
							<i class="fas fa-book-medical" aria-hidden="true"></i>
						</span>
						History
					  </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../billing/bills.php">
						<span>
							<i class="fas fa-file-invoice-dollar" aria-hidden="true"></i>
						</span>
						Billing
					  </a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="../login/logout.php">
						<span>
						  <i class="fas fa-address-card"></i>
						</span>
						Logout
					  </a>
					</li>
				</ul>
				<div class="d-flex">
				  <ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<b><i class="fas fa-user"></i> <?php echo $hp_name;?></b>
					</li>
					<li class="nav-item">
					</li>
				</ul>
				</div>
			</div>
		</div>
	</nav>
  
  <!-- SIDEBAR  -->
  <div class="container-fluid">
    <div class="row">
		  <nav class="col-md-2 d-none d-md-block bg-light sidebar">
			<div class="sidebar-sticky">
			  <ul class="nav flex-column p-3">
				<li class="nav-item p-2">
				  <a class="nav-link" href="../index.php">
					<i class="feather fa fa-home" aria-hidden="true">&nbsp;&nbsp;Dashboard</i>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link active" href="#">
					<span>
						<i class="fas feather fa-qrcode" aria-hidden="true">&nbsp;&nbsp;Session</i>
					</span>
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="../patient-files/">
					<span>
						<i class="fas feather fa-book-medical" aria-hidden="true">&nbsp;&nbsp;History</i>
					</span>
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="../billing/bills.php">
					<span>
						<i class="fas feather fa-file-invoice-dollar" aria-hidden="true">&nbsp;&nbsp;Billing</i>
					</span>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="../login/logout.php">
					<span>
					  <i class="fas feather fa-address-card">&nbsp;&nbsp;Logout</i>
					</span>
					
				  </a>
				</li>
			  </ul>
			</div>
		  </nav>
		</div>
	</div>
	<?php
	
		//Private encryption.
		require_once '../../sys-components/crypt/pvt-decrypt.php';
	
		// Selecting user details.
		$select_user_details = "select user_first_name, user_last_name, user_dob, user_gender, user_card
			from user where user_id=$user_id";
		$user_details_result = mysqli_query($conn, $select_user_details);
		$user_details_row = mysqli_fetch_assoc($user_details_result);
		$user_card = aes_decrypt($user_details_row['user_card']);
		
		// Selecting treatment_session details.
		$select_trt_details = "select trt_name, trt_inf, trt_dis, trt_srt, trt_corm, trt_date, trt_closing_date, trt_hp_id, trt_completed from treatment_session where trt_id=$trt_id";
		$trt_details_result = mysqli_query($conn, $select_trt_details);
		$trt_details_row = mysqli_fetch_assoc($trt_details_result);
		$trt_hp_id = $trt_details_row['trt_hp_id'];
		
		// Selecting hospital details.
		$select_hp_details = "select hp_name from hospital where hp_id=$trt_hp_id";
		$trt_hp_result = mysqli_query($conn, $select_hp_details);
		$trt_hp_row = mysqli_fetch_assoc($trt_hp_result);
		
		// Setting up default timezone.
		date_default_timezone_set('Asia/Calcutta');
		$current_date=date("Y-m-d");
		$diff = date_diff(date_create(aes_decrypt($user_details_row['user_dob'])), date_create($current_date));
		$age = $diff->format('%y');
	?>		
    <!-- CONTENT ON BODY -->
    <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h3 heading-text">
			<b>
				<i class="fas fa-book-medical"></i>
				<?php
					if($tr_type==1)
						echo "OPD";
					else if($tr_type==2)
						echo "Medicines";
					else if($tr_type==3)
						echo "Lab Reports";
					else if($tr_type==4)
						echo "Dignosises";
					else if($tr_type==5)
						echo "Immunizations";
					else if($tr_type==6)
						echo "Allergies";
					else if($tr_type==7)
						echo "Certificates";
					else if($tr_type==8)
						echo "Other Records";
					else if($tr_type==9)
						echo "Instructions";
					else if($tr_type==10)
						echo "Billing";
					else
						echo "Unknown";
				?>
			</b>
		</h1>
      </div>
      <div class="d-flex">
        <div class="p-2 mr-auto">Name : <b><?php echo aes_decrypt($user_details_row['user_first_name'])." ".aes_decrypt($user_details_row['user_last_name']);?></b> </div>
        <div class="p-2 h6">Age: <?php echo $age;?>,</div>
        <div class="">
          <div class="p-2 h6"><?php echo aes_decrypt($user_details_row['user_gender']);?></div>
        </div>
      </div>
      <div class="d-flex">
        <div class="p-2 mr-auto">Date : <?php echo aes_decrypt($trt_details_row['trt_date']);?>, <span class="text-muted">Card No. : <?php echo substr($user_card,0,4)." ".substr($user_card,4,3)." ".substr($user_card,7,4);?></span></div>
      </div>
	  <hr/>
	  <div class="row pl-4 p-2">
		Hospital: <?php echo aes_decrypt($trt_hp_row['hp_name']);?>
	  </div>
      <div class="d-flex justify-content-between">
        <div class="p-2">
			<small>
				Infection: <b><?php echo aes_decrypt($trt_details_row['trt_inf']);?></b>
			</small>
        </div>
		<div class="p-2">
			<small>
				Disease: <b><?php echo aes_decrypt($trt_details_row['trt_dis']);?></b>
			</small>
        </div>
		<div class="p-2">
			<small>
				Severty: <b><?php echo aes_decrypt($trt_details_row['trt_srt']);?></b>
			</small>
        </div>
		<div class="p-2">
			<small>
				Cormobideties: <b><?php echo aes_decrypt($trt_details_row['trt_corm']);?></b>
			</small>
        </div>
        </div>
      <hr/>
	<br/>
	<?php
	$select_ref_trt = "select trt_ref_id from treatment_session where trt_id='$trt_id'";
	$ref_id_result = mysqli_query($conn, $select_ref_trt);
	$ref_id_row = mysqli_fetch_assoc($ref_id_result);
	$trt_ref_id = $ref_id_row['trt_ref_id'];
	if($trt_ref_id != 0){
		$select_trt_from_ref = "select trt_id, trt_name from treatment_session where trt_id='$trt_ref_id'";
		$trt_from_ref_result = mysqli_query($conn, $select_trt_from_ref);
		$trt_from_ref_row = mysqli_fetch_assoc($trt_from_ref_result);
		$trt_from_ref_name = $trt_from_ref_row['trt_name'];
	?>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
			<h5 class="heading-text"><b>Taking Reference (<?php echo aes_decrypt($trt_from_ref_name);?>)</b></h5>
		</div>
		
		<table class="table table-striped table-hover p-1 paragraph-text">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Head/Title</th>
					<th scope="col">Description</th>
					<th scope="col">Doctor</th>
					<th scope="col">Files</th>
					<?php
						if($trt_hp_id==$hp_id){
					?>
					<th scope="col">Charges</th>
					<?php
						}
					?>
				</tr>
			</thead>
			<tbody>
			<?php
				
				$record_select = "select tr_id, tr_title, tr_desc, tr_files, tr_cost, tr_doctor from treatment_record where tr_trt_id=$trt_ref_id and tr_type=$tr_type";
				$recode_result = mysqli_query($conn, $record_select);
				if(mysqli_num_rows($recode_result)<=0){
					echo "<div class='text-center p-3'>No Records</div>";
				}else{
					$sr = 1;
					while($record_row = mysqli_fetch_assoc($recode_result)){
			?>
				<tr>
				  <th scope="row"><?php echo $sr;?></th>
				  <td><?php echo aes_pvt_decrypt($record_row['tr_title'], $user_private_key);?></td>
				  <td><?php echo aes_pvt_decrypt($record_row['tr_desc'], $user_private_key);?></td>
				  <td><?php echo aes_pvt_decrypt($record_row['tr_doctor'], $user_private_key);?></td>
				  <td>
					<?php 
						if(aes_pvt_decrypt($record_row['tr_files'], $user_private_key) != "NA" ){
					?>
						<a href="../../<?php echo aes_pvt_decrypt($record_row['tr_files'], $user_private_key);?>">
							<?php echo aes_pvt_decrypt($record_row['tr_files'], $user_private_key);?>
						</a>
					<?php
						}else{
							echo "NA";
						}
					  ?>
				  </td>
					<?php
						if($trt_hp_id==$hp_id){
					?>
					<td><?php echo "Rs. ".aes_pvt_decrypt($record_row['tr_cost'], $user_private_key)." /-";?></td>
					<?php
						}
					?>
				  
				</tr>
			<?php
				$sr = $sr++;
					}
				}
			?>
			</tbody>
		</table>
	
	<?php
		}
	?>
	<br/>
	<hr/>
	<br/>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
        <h5 class="heading-text"><b>Records</b></h5>
		<?php
			if($trt_hp_id==$hp_id && $trt_details_row['trt_completed']==0){
		?>
			<div class="p-2"> <a href="record-insert.php?tr_type=<?php echo $tr_type;?>" class="ml-3 btn btn-sm btn-block btn-success"> Insert New </a> </div>
		<?php
			}
		?>
	</div>
	
	<table class="table table-striped table-hover p-1 paragraph-text">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Head/Title</th>
				<th scope="col">Description</th>
				<th scope="col">Doctor</th>
				<th scope="col">Files</th>
				<?php
					if($trt_hp_id==$hp_id){
				?>
				<th scope="col">Charges</th>
				<?php
					}
				?>
			</tr>
		</thead>
		<tbody>
		<?php
			
			$record_select = "select tr_id, tr_title, tr_desc, tr_files, tr_cost, tr_doctor from treatment_record where tr_trt_id=$trt_id and tr_type=$tr_type";
			$recode_result = mysqli_query($conn, $record_select);
			if(mysqli_num_rows($recode_result)<=0){
				echo "<div class='text-center p-3'>No Records</div>";
			}else{
				$sr = 1;
				while($record_row = mysqli_fetch_assoc($recode_result)){
		?>
			<tr>
			  <th scope="row"><?php echo $sr;?></th>
			  <td><a href="edit-record.php?tr_id=<?php echo $record_row['tr_id'];?>"><?php echo aes_pvt_decrypt($record_row['tr_title'], $user_private_key);?></a></td>
			  <td><?php echo aes_pvt_decrypt($record_row['tr_desc'], $user_private_key);?></td>
			  <td><?php echo aes_pvt_decrypt($record_row['tr_doctor'], $user_private_key);?></td>
			  <td>
				<?php 
						if(aes_pvt_decrypt($record_row['tr_files'], $user_private_key) != "NA" ){
					?>
						<a href="../../<?php echo aes_pvt_decrypt($record_row['tr_files'], $user_private_key);?>">
							Attached
						</a>
					<?php
						}else{
							echo "NA";
						}
					  ?>
			  </td>
				<?php
					if($trt_hp_id==$hp_id){
				?>
				<td><?php echo "Rs. ".aes_pvt_decrypt($record_row['tr_cost'], $user_private_key)." /-";?></td>
				<?php
					}
				?>
			  
			</tr>
		<?php
			$sr = $sr++;
				}
			}
		?>
		</tbody>
	</table>
	<br/>
	<hr/>
	<div class="form-group d-flex justify-content-center">
		<button type="submit" id="printCard" name="printCard" onclick="window.print()" class="btn btn-strong-color special-button">Print</button>
	</div>
	<br/>
	<br/>
	<br/>
	
<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>