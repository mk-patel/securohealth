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
                            <img src="../../sys-images/long-logo.png" alt="" width="260" height="35"
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
								require_once "../../sys-control/connection.php";
								
								
								
								// Including cryptography codes.
								require_once "../../sys-components/crypt/pub-encrypt.php";
								require_once "../../sys-components/crypt/pub-decrypt.php";
								
								$go_ahead = 0;
								
								// On submit button clicked.
								if(
									isset($_POST["hp_license"]) && isset($_POST["hp_name"]) && 
									isset($_POST["hp_type"]) && isset($_POST["hp_speciality"]) && 
									isset($_POST["hp_desc"]) && isset($_POST["hp_email"]) && 
									isset($_POST["hp_password"]) && isset($_POST["password_repeat"]) && 
									isset($_POST["hp_address"]) && isset($_POST["hp_city"]) && 
									isset($_POST["hp_district"]) && isset($_POST["hp_state"]) && 
									isset($_POST["hp_pincode"])
								){
									$hp_license = mysqli_real_escape_string($conn, $_POST['hp_license']);
									$hp_name =  mysqli_real_escape_string($conn, $_POST['hp_name']);
									$hp_type = mysqli_real_escape_string($conn, $_POST['hp_type']);
									$hp_speciality = mysqli_real_escape_string($conn, $_POST['hp_speciality']);
									$hp_desc = mysqli_real_escape_string($conn, $_POST['hp_desc']);
									$hp_email = mysqli_real_escape_string($conn, $_POST['hp_email']);
									$password = mysqli_real_escape_string($conn, $_POST['hp_password']);
									$password_repeat = mysqli_real_escape_string($conn, $_POST['password_repeat']);
									$hp_address = mysqli_real_escape_string($conn, $_POST['hp_address']);
									$hp_city = mysqli_real_escape_string($conn, $_POST['hp_city']);
									$hp_district = mysqli_real_escape_string($conn, $_POST['hp_district']);
									$hp_state = mysqli_real_escape_string($conn, $_POST['hp_state']);
									$hp_pincode = mysqli_real_escape_string($conn, $_POST['hp_pincode']);
									
									// Checking whether the trem checkbox is checked or not.
								if(!empty($_POST["term"]) || !empty($hp_license) || !empty($hp_name) || 
								   !empty($hp_type) || !empty($hp_speciality) || !empty($hp_desc) || 
								   !empty($hp_email) || !empty($password) || !empty($password_repeat) || 
								   !empty($hp_address) || !empty($hp_city) || !empty($hp_district) || 
								   !empty($hp_state) || !empty($hp_pincode)
								){
										
										// Checking for email existency.
										$proceed = 0;
										$select_hp = "select hp_email,hp_license from hospital";
										$select_result = mysqli_query($conn, $select_hp);
										while($hp_row_encrypted = mysqli_fetch_assoc($select_result)){
											$hp_decrypted_email = aes_decrypt($hp_row_encrypted['hp_email']);
											$hp_decrypted_license = aes_decrypt($hp_row_encrypted['hp_license']);
											if($hp_decrypted_email == $hp_email || $hp_decrypted_license == $hp_license){
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
												
												if(!empty($_FILES["hp_files"]["tmp_name"])){
													$fileSize = $_FILES['hp_files']['size'];
													if($fileSize < 5000000){
														$target_directory = "../hospital-licenses/";
														$target_file = $target_directory.basename($_FILES["hp_files"]["name"]); 
														$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
														$newfilename = uniqid('', true).".".$filetype;
														$path = "hospital-licenses/".$newfilename;
														if(move_uploaded_file($_FILES["hp_files"]["tmp_name"],$target_directory.$newfilename)){
								
															$hp_license = aes_encrypt($hp_license);
															$hp_name =  aes_encrypt($hp_name);
															$hp_type = aes_encrypt($hp_type);
															$hp_speciality = aes_encrypt($hp_speciality);
															$hp_desc = aes_encrypt($hp_desc);
															$hp_address = aes_encrypt($hp_address);
															$hp_city = aes_encrypt($hp_city);
															$hp_district = aes_encrypt($hp_district);
															$hp_state = aes_encrypt($hp_state);
															$hp_pincode = aes_encrypt($hp_pincode);
															$path = aes_encrypt($path);
															
															$hp_email_enc = aes_encrypt($hp_email);
															
															// Setting up default timezone.
															date_default_timezone_set('Asia/Calcutta');
															$date=date("Y-m-d");
															$time=date("h:i A");
															
															$date = aes_encrypt($date);
															$time = aes_encrypt($time);
															
															// Inserting user data.
															$hp_insert = "insert into hospital (
																hp_email, hp_password, hp_name, hp_type, hp_speciality, 
																hp_license, hp_address, hp_city, hp_district, hp_state, 
																hp_pincode, hp_desc, hp_files, hp_date, hp_time, hp_status
																) values (
																'$hp_email_enc', '$password', '$hp_name', '$hp_type', '$hp_speciality',  
																'$hp_license', '$hp_address', '$hp_city', '$hp_district', '$hp_state', 
																'$hp_pincode', '$hp_desc', '$path', '$date', '$time', '0'
																)";
												
															// Checking whether the data are added or not
															if(mysqli_query($conn, $hp_insert)){
																echo "Successfully Registered.";
																$go_ahead = 1;
															}else{
																echo "Unsuccessful, Please Try Again.";
															}
														}else{
															echo "Unsuccessful, File Not Uploaded.";
														}
													}else{
														echo "Unsuccessful, File Should Be Under 5MB.";
													}
												}else{
													echo "Unsuccessful, File Is Required.";
												}
											}
										}else{
											echo "Email/License already exist.";
										}
									}else{
										echo "Please Fill All The Input Boxes And Accept Terms and Conditions.";
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
							
					?>
                    <h4 class="title text-center mt-4">
                        Registration is in review. It may take 2 days to be approved.
                    </h4>
					<?php
						}
					?>
				</div>
            </div>
        </div>
    </div>
</body>
</html>