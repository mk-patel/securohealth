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
								
								// Setting up default timezone.
								date_default_timezone_set('Asia/Calcutta');
								$date=date("Y-m-d");
								$time=date("h:i A");
								
								// Including cryptography codes.
								require_once "../sys-components/crypt/pub-encrypt.php";
								require_once "../sys-components/crypt/pub-decrypt.php";
								
								$go_ahead = 0;
								
								// On submit button clicked.
								if(
									isset($_POST["user_first_name"]) && isset($_POST["user_last_name"]) && 
									isset($_POST["user_email"]) && isset($_POST["password"]) && 
									isset($_POST["password_repeat"]) && isset($_POST["user_gender"]) && 
									isset($_POST["user_dob"]) && isset($_POST["user_address"]) && 
									isset($_POST["user_city"]) && isset($_POST["user_pincode"])
								){
									$user_first_name = mysqli_real_escape_string($conn, $_POST['user_first_name']);
									$user_last_name =  mysqli_real_escape_string($conn, $_POST['user_last_name']);
									$user_email = trim(mysqli_real_escape_string($conn, $_POST['user_email']));
									$password = mysqli_real_escape_string($conn, $_POST['password']);
									$password_repeat = mysqli_real_escape_string($conn, $_POST['password_repeat']);
									$user_gender = mysqli_real_escape_string($conn, $_POST['user_gender']);
									$user_dob = mysqli_real_escape_string($conn, $_POST['user_dob']);
									$user_address = mysqli_real_escape_string($conn, $_POST['user_address']);
									$user_city = mysqli_real_escape_string($conn, $_POST['user_city']);
									$user_pincode = mysqli_real_escape_string($conn, $_POST['user_pincode']);
									
									// Checking whether the trem checkbox is checked or not.
									if(!empty($_POST["term"])){
										
										// Checking for email existency.
										$proceed = 0;
										$select_user = "select user_email from user";
										$select_result = mysqli_query($conn, $select_user);
										while($user_row_encrypted = mysqli_fetch_assoc($select_result)){
											$user_decrypted_email = aes_decrypt($user_row_encrypted['user_email']);
											if($user_decrypted_email == $user_email){
												$proceed = 1;
												break;
											}
											else{
												$proceed = 0;
											}
										}
										if($proceed == 0){
											
											// Whether the two entered passwords are similar or not.
											if($password != $password_repeat){
												echo "Your entered password is not matching with confirm password.";
											}else{
												$password = md5($password);
												$password = sha1($password);
												
												// Checking if there is any empty value.
												if(
													empty($user_first_name) || empty($user_last_name) || 
													empty($user_email) || empty($password) || 
													empty($password_repeat) || empty($user_gender) || 
													empty($user_dob) || empty($user_address) || 
													empty($user_city) || empty($user_pincode)
												){
													echo "You haven't filled all the input fields.";
												}
												else{
													if(!empty($_FILES["user_image"]["tmp_name"])){
														$fileSize = $_FILES['user_image']['size'];
														if($fileSize < 200000){
															$target_directory = "../images/";
															$target_file = $target_directory.basename($_FILES["user_image"]["name"]); 
															$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
															$newfilename = uniqid('', true).".".$filetype;
															$path = "images/".$newfilename;
															if(move_uploaded_file($_FILES["user_image"]["tmp_name"],$target_directory.$newfilename)){
									
																$user_first_name = aes_encrypt($user_first_name);
																$user_last_name = aes_encrypt($user_last_name);
																$user_email_enc = aes_encrypt($user_email);
																$user_gender = aes_encrypt($user_gender);
																$user_dob = aes_encrypt($user_dob);
																$user_address = aes_encrypt($user_address);
																$user_city = aes_encrypt($user_city);
																$user_pincode = aes_encrypt($user_pincode);
																$path = aes_encrypt($path);
															
																// Generating verification code.
																$otp = mt_rand(000000,999999);
																
																// Genarating Card Number
																function getNumber() {
																	$n = 11;
																	$characters = '012345678977';
																	$randomString = '';
																	for ($i = 0; $i < $n; $i++) {
																		$index = rand(0, strlen($characters) - 1);
																		$randomString .= $characters[$index];
																	}
																	/*
																	$user_card_select = "select user_card from user";
																	$user_card_result = mysqli_query($conn, $user_card_select);
																	while($user_card_row = mysqli_fetch_assoc($user_card_result)){
																		if($randomString == aes_decrypt($user_card_row['user_card'])){
																			getNumber();
																			break;
																		}
																	}*/
																	return $randomString;
																}
																$card_number = getNumber();
																
																// Generating private key
																function getKey() {
																	$n=13;
																	$characters = '0123456789@#$%&*8abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
																	$randomString = '';

																	for ($i = 0; $i < $n; $i++) {
																		$index = rand(0, strlen($characters) - 1);
																		$randomString .= $characters[$index];
																	}

																	return $randomString;
																}

																$private_key = getKey();
																
																$card_number_enc = aes_encrypt($card_number);
																$private_key_enc = aes_encrypt($private_key);
																
																// Inserting user data.
																$user_insert = "insert into user (
																	user_first_name, user_last_name, user_email, password, 
																	user_gender, user_dob, user_address, user_city, user_pincode, 
																	user_otp, user_verified, user_image, user_qrcode, user_card, 
																	user_date, user_time
																	) values (
																	'$user_first_name', '$user_last_name', '$user_email_enc', '$password',  
																	'$user_gender', '$user_dob', '$user_address', '$user_city', '$user_pincode', 
																	'$otp', '0', '$path', 'NA', '$card_number_enc', 
																	'$date', '$time'
																	)";
													
																// Checking whether the data are added or not
																if(mysqli_query($conn, $user_insert)){
																	echo "Successfully Created.";
																	$go_ahead = 1;
																}else{
																	echo "Unsuccessful, Please Try Again.";
																}
															}else{
																echo "Unsuccessful, Image Not Uploaded.";
															}
														}else{
															echo "Unsuccessful, Image Should Be Under 200KB.";
														}
													}else{
														echo "Unsuccessful, Image Is Required.";
													}
												}
											}
										}else{
											echo "Email already exist.";
										}
									}else{
										echo "Please Accept Terms and Conditions.";
									}
								}else{
									echo "Something went wrong.";
								}
								
							?>
						</h4>
					</div>
					<?php
					
						// When the above script will execute successfully then
						if($go_ahead == 1){
							// Selecting user id.
							$select_user = "select user_id, user_email from user";
							$select_result = mysqli_query($conn, $select_user);
							while($user_row_encrypted = mysqli_fetch_assoc($select_result)){
								$user_decrypted_email = aes_decrypt($user_row_encrypted['user_email']);
								if($user_decrypted_email == $user_email){
									$user_id = $user_row_encrypted['user_id'];
									break;
								}
							}
							
							// Including PHPMiler to send otp.
							/*include('../sys-components/smtp/index.php');
							$msg="Hi There,<br/> 
								Let's explore the secured health environment. <br/>
								Your Verification link:<br>
								http://localhost/myprojects/securohealth/login/authentication.php?uid=".$user_id."&vc=".$otp."<br>
								Valid for 10 minutes only.<br/><br/>
								Thanks & Regards<br/>
								Technical Lead - SecuroHealth";
							
							$is_mail_sent = smtp_mailer($user_email,'SecuroHealth Verification',$msg);
							
							// Checking whether the mail sent or not.
							if($is_mail_sent == "Sent"){
								echo "<script>alert('Verification E-Mail Sent.');</script>";
							}else{
								echo "<script>alert('Something went wrong on Mail System.');</script>";
							}*/
							
							// Include the qrlib file
							include '../sys-components/phpqrcode/qrlib.php';
							$text = $card_number_enc.",".$private_key_enc;
							
							// $path variable store the location where to
							// store image and $file creates directory name
							// uniqid creates unique id based on microtime
							$path = '../qrcodes/';
							$file = $path.$user_id.".png";
							$qrcodepath = "qrcodes/".$user_id.".png";
							$qrcodepath_enc = aes_encrypt($qrcodepath);
							
							// $ecc stores error correction capability('L')
							$ecc = 'L';
							$pixel_Size = 15;
							$frame_Size = 3;

							// Generates QR Code and Stores it in directory given
							QRcode::png($text, $file, $ecc, $pixel_Size, $frame_Size);
							
							$user_update = "update user set user_qrcode='$qrcodepath_enc' where user_id=$user_id";
							mysqli_query($conn, $user_update);
							
							// This is a Outside Database Connection code.
							$conn_nic = mysqli_connect("localhost", "root", "", "securohealth_nic_2799");

							// when the connection fails then error message will be printed.
							if(!$conn_nic){
								die("Connection Failed, Please Try Again !!".mysqli_connect_error());
							}else{
								$key_insert = "insert into secure_keys (sk_uid, sk_keys) values ('$user_id', '$private_key_enc')";
								mysqli_query($conn_nic, $key_insert);
							}
							
					?>
                    <h4 class="title text-center mt-4">
                        Verify Your Email
                    </h4>
                    <p class="text-center">Verification mail has sent to <?php echo $user_email;?>.</p>
					<p class="text-center" id="resendNote">Didn't recieve maik ? You can request a new mail after complition of this bar.</p>
					<p class="text-center"><progress value="0" max="10" id="progressBar"></progress></p>
					<div class="form-group d-flex justify-content-center">
						<button type="submit" id="requestotp" name="requestotp" onclick="post();" class="btn btn-loose-color special-button">Request A New Mail</button>
					</div>
					<?php
					
						}	
					?>
				</div>
            </div>
        </div>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script type="text/javascript">
		progressBar();
		
		function post() {
			document.getElementById("requestotp").disabled=true;
			document.getElementById("requestotp").innerHTML="Please Wait...";
			$.ajax({
				url: "request-otp.php",
				method: "post",
				data: {
					uid:1,
					to:<?php echo "'".$user_email."'";?>,
				},
				success: function (response) {
					alert(response);
					document.getElementById("requestotp").style.display="none";
					document.getElementById("resendNote").innerHTML="New email has been Sent.";
				},
			});
		}
		
		function progressBar(){
			document.getElementById("requestotp").style.display="none";
			var timeleft = 10;
			var downloadTimer = setInterval(function(){
			  if(timeleft <= 0){
				clearInterval(downloadTimer);
				document.getElementById("progressBar").style.display="none";
				document.getElementById("requestotp").style.display="block";
			  }
			  document.getElementById("progressBar").value = 10 - timeleft;
			  timeleft -= 1;
			}, 1000);
		}
	</script>
</body>
</html>