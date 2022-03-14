<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <meta name="keywords" content="health records, health history, health security, online health documents">
    <meta name="author" content="Manish Patel, Pankaj Sahu">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!--using FontAwesome--------------->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Shortcut Icon for Browser-->
    <link rel="shortcut icon" href="sys-images/logo.png" />
    <title>SecuroHealth</title>
    <!-- Internal css to manage the styling in a simple way-->
    <style>
        body {
            /* background: #0062E6 !important; */
            background:#fff0f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card {
            overflow: hidden;
            border: 0 !important;
            border-radius: 20px !important;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }
		.btn-strong-color{
			background:#ff69b4;
			color:#191970;
			font-weight:600;
		}
		.btn-strong-color:hover{
			background:#ff10f0;
		}
		.btn-loose-color{
			background:white;
			color:#ff69b4;
			font-weight:600;
			border:1px solid #191970;
		}
        .title {
            margin-bottom: 2rem;
        }
		#progressBar{
			width:250px;
			
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
	<header class="continer-fluid p-2 pb-5">
        <div id="menu-jk" class="header-bottom mt-5">
            <div class="container">
                <div class="row nav-row mt-5">
                    <div class="col-lg-12 col-md-12 logo pl-5">
                        <a class="navbar-brand" href="#">
                            <img src="../sys-images/long-logo.png" alt="" width="260" height="35"
                                class="d-inline-block align-text-top heading-text"> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto">
                <div class="card-body">
					<div class="row justify-content-center">
						<h4 class="title text-center user-status p-3 mt-4 col-sm-4 col-md-4 col-lg-4">
							<?php
								// Database connection code.
								require_once "../sys-control/connection.php";
								
								// Including cryptography codes.
								require_once "../sys-components/crypt/pub-decrypt.php";
								
								$go_ahead = 0;
								
								if(isset($_REQUEST['uid']) && isset($_REQUEST['vc'])){
									
									$user_id = mysqli_real_escape_string($conn, $_REQUEST['uid']);
									$verification_code = mysqli_real_escape_string($conn, $_REQUEST['vc']);
									
									// Selecting user otp.
									$user_select = "select user_otp,user_verified from user where user_id=$user_id";
									$user_result = mysqli_query($conn, $user_select);
									$user_otp_row = mysqli_fetch_assoc($user_result);
									$user_otp = $user_otp_row['user_otp'];
									
									if($user_otp_row['user_verified']==0){
										if($user_otp == $verification_code){
											$user_update = "update user set user_verified=1 where user_id=$user_id";
											if(mysqli_query($conn, $user_update)){
												echo "Account Successfully Verified.";
												$go_ahead = 1;
											}
										}else{
											echo "Invalid OTP.";
										}
									}else{
										echo "Invalid.";
									}
								}else{
									header('location:../index.html');
								}
							?>
						</h4>
					</div>
					<?php
						// When the above script will execute successfully then
						if($go_ahead == 1){
							
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
                    <h4 class="title text-center mt-4">
                        <b>Curo Card</b>
                    </h4>
                    <p class="text-center">Always keep your curo card with you while visiting the hospital. Don't share your <b>Curo Card</b> with unauthorized hospital or individual.</p>
					<div class="p-5">
						<div class="row justify-content-center">
							<div style="font-family:helvetica,sans-serif;padding:5px;">
								<div style="border:1px solid black;background:#ff69b4;width:350px;height:220px;">
									<div style="width:348px;background:white;">
										<div style="font-size:18px;width:180px;padding:10px;float:left;">
										<img src="../sys-images/long-logo.png" width="150px" height="20px"/>
										</div>
										<div style="font-size:18px;margin-left:240px;width:120px;padding:10px;">
										<b>Curo Card</b>
										</div>
									</div>
									<div style="font-size:15px;font-weight:600;width:350px;height:130px;">
										<div style="">
											<div style="float:left;width:100px;padding:15px;">
												<img src="../<?php echo $user_image;?>" width="100px" height="100px"/>
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
										<b><?php echo $user_card;?></b>
									</div>
								</div>
							</div>
							<hr/>
							<div style="font-family:helvetica,sans-serif;padding:5px;">
								<div style="border:1px solid black;background:#ff69b4;width:350px;height:220px;">
									<div style="width:348px;background:white;">
										<div style="font-size:18px;width:180px;padding:10px;float:left;">
											<img src="../sys-images/long-logo.png" width="150px" height="20px"/>
										</div>
										<div style="font-size:18px;margin-left:240px;width:120px;padding:10px;">
										<b>Curo Card</b>
										</div>
									</div>
									<div style="font-size:15px;font-weight:600;width:350px;height:130px;">
										<div style="">
											<div style="float:left;width:100px;padding:15px;">
												<img src="../<?php echo $user_qrcode;?>" width="100px" height="100px"/>
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
										<b><?php echo $user_card;?></b>
									</div>
								</div>
							</div>
						</div>
					</div>
					<p class="text-center" id="resendNote">Wish you a good health.</p>
					<div class="form-group d-flex justify-content-center">
						<button type="submit" id="printCard" name="printCard" onclick="window.print()" class="btn btn-strong-color special-button">Print</button>
					</div>
					<?php
					
						}	
					?>
				</div>
            </div>
        </div>
    </div>
	<script>
		function printCard(){
			var iframe = document.createElement('iframe');
			iframe.onload = function() {
				var doc = iframe.contentDocument ? iframe.contentDocument : iframe.contentWindow.document;
				doc.getElementsByTagName('html')[0].innerHTML='<div class="p-2 card-name text-primary"><b>Curo Card</b></div>';

				iframe.contentWindow.focus(); // This is key, the iframe must have focus first
				iframe.contentWindow.print();
			}
			document.getElementsByTagName('html')[0].appendChild(iframe);
		}
	</script>
</body>
</html>