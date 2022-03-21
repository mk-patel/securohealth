<?php

	// This ("connetion.php") file contains Database Connection code.
	require_once '../control/identification.php';
	
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
	<meta name="keywords" content="health records, health history, health security, online health documents">
	<meta name="author" content="Manish Patel, Pankaj Sahu">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!--using FontAwesome--------------->
	<script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Shortcut Icon for Browser-->
	<link rel="shortcut icon" href="../sys-images/logo.png" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">  
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>  
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"> </script>  
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
	.loose-color{
		color: #ff69b4;
	}

    .feather {
      width: 16px;
      height: 16px;
      vertical-align: text-bottom;
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
	
	.create-trt-session{
		border-radius:10px;
	}
	
	.card-text{
		font-size:14px;
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
	.user-status{
		background:white;
		border-radius:40px;
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
						<a class="nav-link" href="billing/index.html">
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
	<div class="container-fluid">
		<div class="row">
		  <nav class="col-md-2 d-none d-md-block bg-light sidebar">
			<div class="sidebar-sticky">
			  <ul class="nav flex-column p-3">
				<li class="nav-item p-2">
				  <a class="nav-link active" href="../index.php">
					<i class="feather fa fa-home" aria-hidden="true">&nbsp;&nbsp;Dashboard <span class="sr-only">(current)</span></i>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="curocard/index.php">
					<span>
						<i class="fas feather fa-file-invoice-dollar" aria-hidden="true">&nbsp;&nbsp;Card</i>
					</span>
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="privacy/index.index">
					<span>
						<i class="fas feather fa-file-invoice-dollar" aria-hidden="true">&nbsp;&nbsp;Privacy</i>
					</span>
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="billing/index.html">
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
    <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h3 heading-text"><b><i class="fas fa-home"></i> Privacy Control</b></h1>
      </div>
		<?php
			// Selecting user status.
			$user_select = "select user_status,user_card_status,user_govt from user where user_id=$user_id";
			$user_result = mysqli_query($conn, $user_select);
			$user_status_row = mysqli_fetch_assoc($user_result);
			$user_status_txt="Deactivate";
			$user_card_status_txt="Block";
			$user_govt_txt="Allow";
			$user_status_bg="loose";
			$user_card_status_bg="loose";
			$user_govt_bg="strong";
			if($user_status_row['user_status']==2){
				$user_status_txt="Reactivate";
				$user_status_bg="strong";
			}
			if($user_status_row['user_card_status']==1){
				$user_card_status_txt="Unblock";
				$user_card_status_bg="strong";
			}
			if($user_status_row['user_govt']==1){
				$user_govt_txt="Disallow";
				$user_govt_bg="loose";
			}
		?>
      <!-- <div class="card"> -->
	  <br>
		<div class="row d-flex user-status flex-row justify-content-center pt-3 p-2 col-lg-10 mx-auto">
			<div class="text-center col-sm-8 col-md-8 col-lg-8">
				<div class="d-flex flex-row justify-content-between ">
					<div class="p-1 heading-text h6">
						Deactivate My Account <br/>
						<small class="text-muted">If you deactivated the account, you won't get any kind of service.</small>
					</div>
					
					<div class="p-1">
						<form action="account-action.php" method="post">  
							<div class="custom-control custom-switch">  
								<input type="hidden" name="cid" value="1">  
								<button type="submit" class="btn btn-<?php echo $user_status_bg;?>-color btn-sm" name="trt-run"><?php echo $user_status_txt;?></button> 
							</div>  
						</form>  
					</div>
				</div> 
			</div> 
		</div>
		<br>
		<div class="row d-flex user-status flex-row justify-content-center pt-3 p-2 col-lg-10 mx-auto">
			<div class="text-center col-sm-8 col-md-8 col-lg-8">
				<div class="d-flex flex-row justify-content-between ">
					<div class="p-1 heading-text h6">
						Block My Curo Card <br/>
						<small class="text-muted">If the card information has compromised, you can block the card.</small>
					</div>
					<div class="p-1">
						<form action="account-action.php" method="post">  
							<div class="custom-control custom-switch">  
								<input type="hidden" name="cid" value="2">  
								<button type="submit" class="btn btn-<?php echo $user_card_status_bg;?>-color btn-sm" name="trt-run"><?php echo $user_card_status_txt;?></button> 
							</div>  
						</form>  
					</div>
				</div> 
			</div> 
		</div>
		<br>
		
		<div class="row d-flex user-status flex-row justify-content-center pt-3 p-2 col-lg-10 mx-auto">
			<div class="text-center col-sm-8 col-md-8 col-lg-8">
				<div class="d-flex flex-row justify-content-between ">
					<div class="p-1 heading-text h6">
						Allow Government to Access My Data <br/>
						<small class="text-muted">It will help govt to initiate camp through social medical statatics.</small>
					</div>
					<div class="p-1">
						<form action="account-action.php" method="post">  
							<div class="custom-control custom-switch">  
								<input type="hidden" name="cid" value="3">  
								<button type="submit" class="btn btn-<?php echo $user_govt_bg;?>-color btn-sm" name="trt-run"><?php echo $user_govt_txt;?></button> 
							</div>  
						</form>  
					</div>
				</div> 
			</div> 
		</div>
		<br>
	  <br>
		<div class="row user-status p-2 col-lg-10 mx-auto">
		<?php
			$trt_select = "select trt_id, hp_name, hp_id, trt_date from treatment_session
				inner join hospital on hp_id=trt_hp_id
				where trt_user_id=$user_id and trt_completed=0
				";
			$trt_result = mysqli_query($conn, $trt_select);
			if(mysqli_num_rows($trt_result)<=0){
				echo "<div class='text-center h5 p-3'>You don't have any running treatment.</div>";
			}else{
				while($trt_row = mysqli_fetch_assoc($trt_result)){
				
					$hp_id = $trt_row['hp_id'];
					$block_select = "select bkh_id, bkh_hp_id, bkh_user_id from blocked_hospital where bkh_hp_id=$hp_id and bkh_user_id=$user_id";
					$block_result = mysqli_query($conn, $block_select);
					
					$block_this_hospital_txt="Block This Hospital";
					$block_this_hospital_bg="loose";
					
					if(mysqli_num_rows($block_result)>=1){
						
						$block_this_hospital_txt="Unblock This Hospital";
						$block_this_hospital_bg="strong";
					}
		?>
			<div class="col-sm-11 col-md-11 col-lg-11">
				<div class="d-flex flex-row justify-content-between border-bottom">
					<div class="p-2 heading-text h5">Currently Running Treatment</div>
				</div> 
				<div class="d-flex flex-row justify-content-between border-bottom">
					<div class="pl-5 p-3">
						<div class="h6"><?php echo $trt_row['hp_name'];?></div>
						<div class="h6 text-muted">Date Started: <?php echo $trt_row['trt_date'];?></div>
						<div class="h6 text-muted">TRT ID: <?php echo $trt_row['trt_id'];?></div>
					</div>
					<div class="pr-5 p-3">
						<form action="block-hospital.php" method="post">
							<div class=""> 
								<input type="hidden" name="hid" value="<?php echo $trt_row['hp_id'];?>">  
								<button type="submit" class="btn btn-<?php echo $block_this_hospital_bg;?>-color btn-sm" name="trt-run"><?php echo $block_this_hospital_txt;?></button> 
							</div>  
						</form>  
					</div> 
				</div>
			</div>
		<?php
				}
			}
		?>
		<?php
			$trt_select = "select hp_id,hp_name from hospital where 
				(select distinct(trt_hp_id) from treatment_session where trt_user_id=$user_id)
				";
			$trt_result = mysqli_query($conn, $trt_select);
			if(mysqli_num_rows($trt_result)<=0){
				echo "<div class='text-center h5 p-3'>You haven't visited any hospital.</div>";
			}else{
				while($trt_row = mysqli_fetch_assoc($trt_result)){
					
					$hp_id = $trt_row['hp_id'];
					$block_select = "select bkh_id, bkh_hp_id, bkh_user_id from blocked_hospital where bkh_hp_id=$hp_id and bkh_user_id=$user_id";
					$block_result = mysqli_query($conn, $block_select);
					
					$block_this_hospital_txt="Block This Hospital";
					$block_this_hospital_bg="loose";
					
					if(mysqli_num_rows($block_result)>=1){
						
						$block_this_hospital_txt="Unblock This Hospital";
						$block_this_hospital_bg="strong";
					}
		?>
			<div class="col-sm-11 col-md-11 col-lg-11 pt-4">
				<div class="d-flex flex-row justify-content-between border-bottom">
					<div class="p-2 heading-text h5">Hospital That You Have Visited</div>
				</div> 
				<div class="d-flex flex-row justify-content-between border-bottom">
					<div class="pl-5 p-3">
						<div class="h6"><?php echo $trt_row['hp_name'];?></div>
					</div>
					<div class="pr-5 p-3">
						<form action="block-hospital.php" method="post">
							<div class=""> 
								<input type="hidden" name="hid" value="<?php echo $trt_row['hp_id'];?>">  
								<button type="submit" class="btn btn-<?php echo $block_this_hospital_bg;?>-color btn-sm" name="trt-run"><?php echo $block_this_hospital_txt;?></button> 
							</div>  
						</form>  
					</div> 
				</div>
			</div>
		<?php
				}
			}
		?>
		</div>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
    </main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"></script>

</body>

</html>