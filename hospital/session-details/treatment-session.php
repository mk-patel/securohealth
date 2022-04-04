<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	if(isset($_REQUEST['trt_name'])){
		$trt_name = mysqli_escape_string($conn, $_REQUEST['trt_name']);
	}else{
		header('location:../index.php');
	}
	if(isset($_REQUEST['ref_id'])){
		$trt_ref_id = aes_decrypt($_REQUEST['ref_id']);
	}else{
		$trt_ref_id = 0;
	}
	if(isset($_POST['qrres']) && isset($_POST['trt_name'])){
		$trt_name = mysqli_escape_string($conn, $_POST['trt_name']);
		$qrres = mysqli_escape_string($conn ,$_POST['qrres']);
		
		$trt_name_enc = aes_encrypt($trt_name);
		
		$qr_card = explode(".", $qrres);
		
		$user_card = aes_decrypt($qr_card[0]);
		
		$proceed = 0;
		
		// Selecting user_id.
		$select_user_card = "select user_id, user_email, user_card, user_card_status from user";
		$select_user_card_result = mysqli_query($conn, $select_user_card);
		while($user_card_row_encrypted = mysqli_fetch_assoc($select_user_card_result)){
			$user_card_row = aes_decrypt($user_card_row_encrypted['user_card']);
			if($user_card_row == $user_card){
				$user_id = $user_card_row_encrypted['user_id'];
				$user_email = aes_decrypt($user_card_row_encrypted['user_email']);
				$user_card_status = $user_card_row_encrypted['user_card_status'];
				$proceed = 1;
				break;
			}
		}
		
		
		if($proceed == 1){
			
			// Setting up default timezone.
			date_default_timezone_set('Asia/Calcutta');
			$date_as = date("Y-m-d");
			$time = date("h:i A");
			
			$date = aes_encrypt($date_as." ".$time);
			
			$cs_select = "select cs_id from card_scanned where cs_user_id='$user_id' and cs_hp_id='$hp_id'";
			$cs_result = mysqli_query($conn, $cs_select);
			$cs_row = mysqli_fetch_assoc($cs_result);
			
			if(mysqli_num_rows($cs_result)<=0){
				$trt_query = "insert into card_scanned (cs_user_id, cs_hp_id, cs_date, cs_time)
				values('$user_id', '$hp_id', '$date_as', '$time')";
			}else{
				$cs_id = $cs_row['cs_id'];
				$trt_query = "update card_scanned set cs_date='$date_as', cs_time='$time' where (cs_user_id='$user_id' and cs_hp_id='$hp_id' and cs_id='$cs_id')";
			}
			
			if(mysqli_query($conn, $trt_query)){
				// Including PHPMiler to send otp.
				/*include('../../sys-components/smtp/index.php');
				$msg="Hi There,<br/> 
					Your data security is the most important for us.<br/>
					Your Curo Card is scanned in:<br/><br/>
					".$hp_name."<br/><br/>
					At ".$date_as.", ".$time."<br/><br/>
					If you did not scan your card, immediatly block this hospital from accessing your data.<br/>
					Go to -> <b>Privacy</b> visible on left side or nav bar<br/>
					Then go to -> <b>Your Card Scanned At</b> section on bottom of right side, and click <b>Block This Hospital</b>
					Thanks & Regards<br/>
					Technical Lead - SecuroHealth";
				
				$is_mail_sent = smtp_mailer($user_email,'Security Alert, Card Scanned - SecuroHealth',$msg);
				
				// Checking whether the mail sent or not.
				if($is_mail_sent == "Sent"){
					echo "<script>alert('Verification E-Mail Sent.');</script>";
				}else{
					echo "<script>alert('Something went wrong on Mail System.');</script>";
				}*/
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
			}else{
				
				// Selecting trt id.
				$select_trt_id = "select trt_id, trt_name from treatment_session";
				$select_trt_result = mysqli_query($conn, $select_trt_id);
				while($trt_row_encrypted = mysqli_fetch_assoc($select_trt_result)){
					$trt_name_row = aes_decrypt($trt_row_encrypted['trt_name']);
					if($trt_name_row == $trt_name){
						$trt_id = $trt_row_encrypted['trt_id'];
						$proceed = 0;
						break;
					}
				}
				if($proceed == 1){
					$user_status_select = "select user_status from user where user_id='$user_id'";
					$user_status_result = mysqli_query($conn, $user_status_select);
					$user_status_row = mysqli_fetch_assoc($user_status_result);
					
					if($user_status_row['user_status'] == 2){
						echo "<script>
								alert('This account has been Deactivated.');
								window.location.href='../index.php';
							</script>";
					}else{
						$trt_insert = "insert into treatment_session (trt_name, trt_inf, trt_dis, trt_srt, trt_corm, trt_date, trt_closing_date, trt_user_id, trt_hp_id, trt_completed, trt_ref_id)
							values('$trt_name_enc', '0', '0', '0', '0', '$date', 'NA', '$user_id', '$hp_id', '0', '$trt_ref_id')";
						
						if(mysqli_query($conn, $trt_insert)){
							// Selecting trt id.
							$select_trt_id = "select trt_id, trt_name from treatment_session";
							$select_trt_result = mysqli_query($conn, $select_trt_id);
							while($trt_row_encrypted = mysqli_fetch_assoc($select_trt_result)){
								$trt_name_row = aes_decrypt($trt_row_encrypted['trt_name']);
								if($trt_name_row == $trt_name){
									$trt_id = $trt_row_encrypted['trt_id'];
									break;
								}
							}
							
							$_SESSION['trt_id_56'] = aes_encrypt($trt_id);
							$_SESSION['qrres_45'] = $qrres;
							header('location:treatment-categories.php');
						}else{
							echo "<script>
								alert('Unsuccessful, please try again.');
								window.location.href='../index.php';
							</script>";
						}
					}
				}else{
					$_SESSION['trt_id_56'] = aes_encrypt($trt_id);
					$_SESSION['qrres_45'] = $qrres;
					header('location:treatment-categories.php');
				}
			}
		}else{
			header('location:../index.php');
		}
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

    <!-- CONTENT ON BODY -->
    <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h3 heading-text"><b><i class="fas fa-book-medical"></i> Creating Treatment Session</b></h1>
		</div>
		<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h4 heading-text"><b><i class="fas fa-qrcode"></i> Scan The Curo Card</b></h1>
		</div>
        <div class="container pt-2">
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" style="border:7px solid pink;border-radius:10px;" width="100%"></video>
                </div>
                <div class="col-md-6">
					<form action="" method="post">
						<label>Or, enter the scanned QR result here</label>
						<input type="text" name="qrres" id="qrres"  placeholder="Enter Scanned QR Result" class="form-control" required>
						<input type="hidden" name="trt_name" id="trt_name" value="<?php echo $trt_name;?>">
						<br/>
						<button type="submit" name="submit" id="submit" class="btn btn-loose-color">Submit</button>
					</form>
				</div>
            </div>
        </div>
		<hr/>
		<div class="row justify-content-center">
			<div class="p-3">
				You have to scan the QR Code, which is placed on backside of the card. Card should be clean and properly visible.
			</div>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		
    </main>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
	<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    
        <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('qrres').value=c;
			   document.getElementById('submit').click();
			   
           });

        </script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>