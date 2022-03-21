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
	.card {
		overflow: hidden;
		border: 0 !important;
		border-radius: 20px !important;
		box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
	}
	.title {
		margin-bottom: 2rem;
	}
	.user-status{
		background:#fff0f5;
		border-radius:40px;
	}
	.main-block{
		border:1px solid black;
		background:#ff69b4;
		width:350px;
		height:220px;
	}
	.header-block{
		font-size:18px;
		background:white;
	}
	.data-block{
		font-size:14px;
		font-weight:600;
	}
	.address-block{
		font-size:12px;
		font-weight:600;
	}
	.line{
		background:#301934;
	}
	hr {
	  border: none;
	  border-top: 1px dotted #f00;
	  color: #fff;
	  background-color: #fff;
	  height: 1px;
	  width: 80%;
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
				  <a class="nav-link" href="../index.php">
					<i class="feather fa fa-home" aria-hidden="true">&nbsp;&nbsp;Dashboard <span class="sr-only">(current)</span></i>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link active" href="curocard/index.php">
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

    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto">
                <div class="card-body">
					<div class="row justify-content-center">
						<h4 class="title text-center user-status p-3 mt-4 col-sm-4 col-md-4 col-lg-4">
							<b>Curo Card</b>
						</h4>
					</div>
					<?php
							
						// Selecting user details.
						$user_select = "select user_first_name,user_last_name,user_gender,user_dob,user_address,user_city,user_pincode,user_image,user_qrcode,user_card from user where user_id=$user_id";
						$user_result = mysqli_query($conn, $user_select);
						$user_row = mysqli_fetch_assoc($user_result);
						$user_first_name = aes_decrypt($user_row['user_first_name']);
						$user_last_name = aes_decrypt($user_row['user_last_name']);
						$user_gender = aes_decrypt($user_row['user_gender']);
						$user_dob = aes_decrypt($user_row['user_dob']);
						$user_address = aes_decrypt($user_row['user_address']);
						$user_city = aes_decrypt($user_row['user_city']);
						$user_pincode = aes_decrypt($user_row['user_pincode']);
						$user_image= aes_decrypt($user_row['user_image']);
						$user_qrcode = aes_decrypt($user_row['user_qrcode']);
						$user_card = aes_decrypt($user_row['user_card']);
							
					?>
                    <p class="text-center">Always keep your curo card with you while visiting the hospital. Don't share your <b>Curo Card</b> with unauthorized hospital or individual.</p>
					<div class="p-5">
						<div class="row justify-content-center">
							<div style="font-family:helvetica,sans-serif;padding:5px;">
								<div style="border:1px solid black;background:#ff69b4;width:350px;height:220px;">
									<div style="width:348px;background:white;">
										<div style="font-size:18px;width:180px;padding:10px;float:left;">
										<img src="../../sys-images/long-logo.png" width="150px" height="20px"/>
										</div>
										<div style="font-size:18px;margin-left:240px;width:120px;padding:10px;">
										<b>Curo Card</b>
										</div>
									</div>
									<div style="font-size:15px;font-weight:600;width:350px;height:130px;">
										<div style="">
											<div style="float:left;width:100px;padding:15px;">
												<img src="../../<?php echo $user_image;?>" width="100px" height="100px"/>
											</div>
											<div style="margin-left:120px;width:180;padding:15px;">
												<?php echo $user_first_name;?> <?php echo $user_last_name;?><br/>
												DOB: <?php echo $user_dob;?> <br/>
												<?php echo $user_gender;?>
											</div>
										</div>
									</div>
									<div style="background:#301934;padding:2px;width:348px">
									</div>
									<div style="float:left;width:100%;text-align:center; margin-top:5px;color:white;font-size:20px;">
										<b><?php echo substr($user_card,0,4)." ".substr($user_card,4,3)." ".substr($user_card,7,4);?></b>
									</div>
								</div>
							</div>
							<hr/>
							<div style="font-family:helvetica,sans-serif;padding:5px;">
								<div style="border:1px solid black;background:#ff69b4;width:350px;height:220px;">
									<div style="width:348px;background:white;">
										<div style="font-size:18px;width:180px;padding:10px;float:left;">
											<img src="../../sys-images/long-logo.png" width="150px" height="20px"/>
										</div>
										<div style="font-size:18px;margin-left:240px;width:120px;padding:10px;">
										<b>Curo Card</b>
										</div>
									</div>
									<div style="font-size:15px;font-weight:600;width:350px;height:130px;">
										<div style="">
											<div style="float:left;width:100px;padding:15px;">
												<img src="../../<?php echo $user_qrcode;?>" width="100px" height="100px"/>
											</div>
											<div style="margin-left:120px;width:180;padding:15px;font-size:12px;">
												Address: <br/>
												<?php echo $user_address;?><br/>
												<?php echo $user_city.", ".$user_pincode;?>
											</div>
										</div>
									</div>
									<div style="background:#301934;padding:2px;width:348px">
									</div>
									<div style="float:left;width:100%;text-align:center; margin-top:5px;color:white;font-size:20px;">
										<b><?php echo substr($user_card,0,4)." ".substr($user_card,4,3)." ".substr($user_card,7,4);?></b>
									</div>
								</div>
							</div>
						</div>
					</div>
					<p class="text-center" id="resendNote">Wish you a good health.</p>
					<div class="form-group d-flex justify-content-center">
						<button type="submit" id="printCard" name="printCard" onclick="window.print()" class="btn btn-strong-color special-button">Print</button>
					</div>
				</div>
            </div>
        </div>
    </div>
    </main>
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