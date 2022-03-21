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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!--using FontAwesome--------------->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Shortcut Icon for Browser-->
    <link rel="shortcut icon" href="../../sys-images/logo.png" />
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
						<h4 class="title text-center user-status p-3 mt-4 col-sm-6 col-md-6 col-lg-6">
							<?php
								
								if(isset($_POST['cid'])){
									
									$id = $_POST['cid'];
									
									if($id==1){
										
										// Selecting user status.
										$user_select = "select user_status from user where user_id=$user_id";
										$user_result = mysqli_query($conn, $user_select);
										$user_status_row = mysqli_fetch_assoc($user_result);
										$user_status = $user_status_row['user_status'];
										
										if($user_status=='1'){
											$user_update = "update user set user_status='2' where user_id=$user_id";
											if(mysqli_query($conn, $user_update)){
												echo "Deactivated";
											}else{
												echo "Invalid Access!";
											}
										}else if($user_status=='2'){
											// Selecting user status.
											$user_update = "update user set user_status='1' where user_id=$user_id";
											if(mysqli_query($conn, $user_update)){
												echo "Successfully Reactivated.";
											}else{
												echo "Invalid Access!";
											}
										}
									}
									else if($id==2){
										
										// Selecting card status.
										$user_select = "select user_card_status from user where user_id=$user_id";
										$user_result = mysqli_query($conn, $user_select);
										$user_card_status_row = mysqli_fetch_assoc($user_result);
										$user_card_status = $user_card_status_row['user_card_status'];
										
										if($user_card_status==0){
											$user_update = "update user set user_card_status=1 where user_id=$user_id";
											if(mysqli_query($conn, $user_update)){
												echo "Successfully Blocked.";
											}else{
												echo "Invalid Access!";
											}
										}else{
											// Selecting user status.
											$user_update = "update user set user_card_status=0 where user_id=$user_id";
											if(mysqli_query($conn, $user_update)){
												echo "Successfully Unblocked.";
											}else{
												echo "Invalid Access!";
											}
										}
									}
									else if($id==3){
										
										// Selecting card status.
										$user_select = "select user_govt from user where user_id=$user_id";
										$user_result = mysqli_query($conn, $user_select);
										$user_govt_row = mysqli_fetch_assoc($user_result);
										$user_govt = $user_govt_row['user_govt'];
										
										if($user_govt==1){
											$user_update = "update user set user_govt=0 where user_id=$user_id";
											if(mysqli_query($conn, $user_update)){
												echo "Successfully Disallowed.";
											}else{
												echo "Invalid Access!";
											}
										}else{
											// Selecting user status.
											$user_update = "update user set user_govt=1 where user_id=$user_id";
											if(mysqli_query($conn, $user_update)){
												echo "Successfully Allowed.";
											}else{
												echo "Invalid Access!";
											}
										}
									}
								}else{
									header('location:index.php');
								}
							?>
						</h4>
					</div>
				</div>
            </div>
        </div>
    </div>
</body>
</html>