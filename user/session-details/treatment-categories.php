<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	if(isset($_SESSION['qrres_45']) && isset($_SESSION['trt_id_56'])){
		$trt = aes_decrypt(mysqli_escape_string($conn, $_SESSION['trt_id_56']));
		$qrres = mysqli_escape_string($conn , $_SESSION['qrres_45']);
		
		$qr_card = explode(".", $qrres);
		
		$user_card = aes_decrypt($qr_card[0]);
		
		$select_card = "select user_card, user_card_status from user where user_id=$user_id";
		$card_result = mysqli_query($conn, $select_card);
		$card_row = mysqli_fetch_assoc($card_result);
		
		if(($card_row['user_card_status'] !=0) || (aes_decrypt($card_row['user_card']) != $user_card)){
			echo "<script>
					alert('Your card has been blocked, please unblock it or generate a new card.');
					window.location.href='../index.php';
				</script>";
		}		
		
	}else{
		header('location:../index.php');
	}
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
						<a class="nav-link" href="../index.html">
						<span>
							<i class="fa fa-home" aria-hidden="true"></i>
						</span>
						Dashboard
					  </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../billing/index.html">
						<span>
							<i class="fas fa-file-invoice-dollar" aria-hidden="true"></i>
						</span>
						Billing
					  </a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="#">
						<span>
						  <i class="fas fa-calculator" aria-hidden="true"></i>
						</span>
						Statistics
					  </a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="#">
						<span>
						  <i class="fas fa-address-card"></i>
						</span>
						Profile
					  </a>
					</li>
				</ul>
				<div class="d-flex">
				  <ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<b><i class="fas fa-user"></i> <?php echo $user_first_name;?></b>
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
				  <a class="nav-link" href="../index.html">
					<i class="feather fa fa-home" aria-hidden="true">&nbsp;&nbsp;Dashboard</i>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="../billing/index.html">
					<span>
						<i class="fas feather fa-file-invoice-dollar" aria-hidden="true">&nbsp;&nbsp;Billing</i>
					</span>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="#">
					<span>
					  <i class="fas feather fa-calculator" aria-hidden="true">&nbsp;&nbsp;Statistics</i>
					</span>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="#">
					<span>
					  <i class="fas feather fa-address-card">&nbsp;&nbsp;Profile</i>
					</span>
					
				  </a>
				</li>
			  </ul>
			</div>
		  </nav>
		</div>
	</div>
	<?php
		
		// Selecting user details.
		$select_user_details = "select user_first_name, user_last_name, user_dob, user_gender, user_card
			from user where user_id=$user_id";
		$user_details_result = mysqli_query($conn, $select_user_details);
		$user_details_row = mysqli_fetch_assoc($user_details_result);
		
		// Selecting treatment_session details.
		$select_trt_details = "select trt_name, trt_inf, trt_dis, trt_srt, trt_corm, trt_date, trt_closing_date, trt_hp_id, trt_completed from treatment_session where trt_id=$trt";
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
        <h1 class="h3 heading-text"><b><i class="fas fa-book-medical"></i> Treatment Session</b></h1>
      </div>
      <div class="d-flex">
        <div class="p-2 mr-auto">Name : <b><?php echo aes_decrypt($user_details_row['user_first_name'])." ".aes_decrypt($user_details_row['user_last_name']);?></b> </div>
        <div class="p-2 h6">Age: <?php echo $age;?>,</div>
        <div class="">
          <div class="p-2 h6"><?php echo aes_decrypt($user_details_row['user_gender']);?></div>
        </div>
      </div>
      <div class="d-flex">
        <div class="p-2 mr-auto">Date : <?php echo $trt_details_row['trt_date'];?>, <span class="text-muted">Card No. : <?php echo substr($user_card,0,4)." ".substr($user_card,4,3)." ".substr($user_card,7,4);?></span></div>
        <div class="p-2"> <a href="" class="ml-3 btn btn-sm btn-block btn-danger"> Discharge </a> </div>
      </div>
	  <hr/>
	  <div class="row pl-4 p-2">
		Hospital: <?php echo $trt_hp_row['hp_name'];?>
	  </div>
	  <form method="post">
		  <div class="d-flex justify-content-between">
			<div class="p-2">
			  <small>
				<div class="form-group">
				<label>Infection</label>
				  <select name="trt_inf" id="trt_inf" class="custom-select">
					<?php
						if(aes_decrypt($trt_details_row['trt_inf']) != '0'){
							echo "<option value='".aes_decrypt($trt_details_row['trt_inf'])."' selected>".aes_decrypt($trt_details_row['trt_inf'])."</option>";
						}else{
							echo "<option value='' disabled selected>Select</option>";
						}
					?>
					<option value="Bacterial">Bacterial</option>
					<option value="Fungal">Fungal</option>
					<option value="Viral">Viral</option>
					<option value="Other">Other</option>
				  </select>
				  <div class="valid-feedback">Valid.</div>
				  <div class="invalid-feedback">Please fill out this field.</div>
				</div>
			  </small>
			</div>
			<div class="p-2">
			  <small>
				<div class="form-group">
				<label>Disease</label>
				  <select name="trt_dis" id="trt_dis" class="custom-select">
					<?php
						if(aes_decrypt($trt_details_row['trt_dis']) != '0'){
							echo "<option value='".aes_decrypt($trt_details_row['trt_dis'])."' selected>".aes_decrypt($trt_details_row['trt_dis'])."</option>";
						}else{
							echo "<option value='' disabled selected>Select</option>";
						}
					?>
					<option value="Cold">Cold</option>
					<option value="Fever">Fever</option>
					<option value="100000">Other</option>
				  </select>
				  <div class="valid-feedback">Valid.</div>
				  <div class="invalid-feedback">Please fill out this field.</div>
				</div>
			  </small>
			</div>
			<div class="p-2">
			  <small>
				<div class="form-group">
				<label>Severty</label>
				  <select name="trt_srt" id="trt_srt" class="custom-select">
					<?php
						if(aes_decrypt($trt_details_row['trt_srt']) != '0'){
							echo "<option value='".aes_decrypt($trt_details_row['trt_srt'])."' selected>".aes_decrypt($trt_details_row['trt_srt'])."</option>";
						}else{
							echo "<option value='' disabled selected>Select</option>";
						}
					?>
					<option value="Low">Low</option>
					<option value="Medium">Medium</option>
					<option value="High">High</option>
				  </select>
				  <div class="valid-feedback">Valid.</div>
				  <div class="invalid-feedback">Please fill out this field.</div>
				</div>
			  </small>
			</div>
			<div class="p-2">
			  <small>
				<div class="form-group">
				<label>Cormobideties</label>
				  <select name="trt_corm" id="trt_corm" class="custom-select">
					<?php
						if(aes_decrypt($trt_details_row['trt_corm']) != '0'){
							echo "<option value='".aes_decrypt($trt_details_row['trt_corm'])."' selected>".aes_decrypt($trt_details_row['trt_corm'])."</option>";
						}else{
							echo "<option value='' disabled selected>Select</option>";
						}
					?>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
				  </select>
				  <div class="valid-feedback">Valid.</div>
				  <div class="invalid-feedback">Please fill out this field.</div>
				</div>
			  </small>
			</div>
		  </div>
		</form>
      <div class="d-flex flex-row-reverse">
        <div class="p-2"> <button class="ml-3 btn btn-sm btn-block btn-success" id="trtdetails" onclick="return trtDetails();"> Update </button> </div>
      </div>
      <hr/>
	<div class="row">
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=1";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=1"><div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>OPD</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=2";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=2"><div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>Medecines</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=3";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=3"><div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>Lab Reports</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=4";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=4">
			<div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>Diagnosis</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=5";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=5"><div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>Immunizations</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=6";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=6"><div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>Allergies</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=7";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=7"><div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>Certificates</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	<?php
		$select_record_count = "select sum(tr_cost),count(tr_id) from treatment_record where tr_trt_id=$trt and tr_type=8";
		$record_count_result = mysqli_query($conn, $select_record_count);
		$record_count_row = mysqli_fetch_assoc($record_count_result);
		$count = mysqli_num_rows($record_count_result);
	?>
		<div class="col-md-6 p-3">
			<!-- OPD CARDS -->
			<a href="treatment-records.php?ttid=8"><div class="card">
				<div class="d-flex">
					<div class="p-2 order-3 heading-text text-opd-medicine h5"> <b>Other Records</b> </div>
				</div>
				<div class="d-flex justify-content-between sub-info text-secondary">
					<div class="p-2 ml-2 flex-fill"> Entries : <?php echo $record_count_row['count(tr_id)'];?> </div>
					<div class="p-2 mr-2 flex-fill"> Total Charges : Rs. <?php echo $record_count_row['sum(tr_cost)'];?> /-</div>
				</div>
			</div></a>
		</div>
	</div>
    </main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script type="text/javascript">
		
		function trtDetails() {
			document.getElementById("trtdetails").disabled=true;
			document.getElementById("trtdetails").innerHTML="Please Wait...";
			var trt_inf = document.getElementById("trt_inf").value;
			var trt_dis = document.getElementById("trt_dis").value;
			var trt_srt = document.getElementById("trt_srt").value;
			var trt_corm = document.getElementById("trt_corm").value;
			$.ajax({
				url: "trt_details_update.php",
				method: "post",
				data: {
					trt_inf:trt_inf,
					trt_dis:trt_dis,
					trt_srt:trt_srt,
					trt_corm:trt_corm,
				},
				success: function (response) {
					alert(response);
					document.getElementById("trtdetails").disabled=false;
					document.getElementById("trtdetails").innerHTML="Updated";
				},
			});
			return false;
		}
		</script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>