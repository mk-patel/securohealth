<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	if(isset($_SESSION['qrres_45']) && isset($_SESSION['trt_id_56']) && isset($_POST['bill_order_id']) && isset($_POST['bill_amount'])){
		$trt_id = aes_decrypt(mysqli_escape_string($conn, $_SESSION['trt_id_56']));
		$qrres = mysqli_escape_string($conn , $_SESSION['qrres_45']);
		$bill_order_id = mysqli_escape_string($conn , $_POST['bill_order_id']);
		$bill_amount = mysqli_escape_string($conn , $_POST['bill_amount']);
		
		$qr_card = explode(".", $qrres);
		
		$user_card = aes_decrypt($qr_card[0]);
		
		$proceed = 0;
		$txn_status = 0;
		// Selecting trt id.
		$select_user_card = "select user_id, user_card, user_card_status from user";
		$select_user_card_result = mysqli_query($conn, $select_user_card);
		while($user_card_row_encrypted = mysqli_fetch_assoc($select_user_card_result)){
			$user_card_row = aes_decrypt($user_card_row_encrypted['user_card']);
			if($user_card_row == $user_card){
				$user_id = $user_card_row_encrypted['user_id'];
				$user_card_status = $user_card_row_encrypted['user_card_status'];
				$proceed = 1;
				break;
			}
		}
		if($proceed = 1){
			if(($user_card_status != 0) || ($user_card_row != $user_card)){
				echo "<script>
						alert('This card has been blocked, suggest to unblock it or generate a new card.');
						window.location.href='../index.php';
					</script>";
			}
			
			// Setting up default timezone.
			date_default_timezone_set('Asia/Calcutta');
			$date=date("Y-m-d");
			$time=date("h:i A");
			$bill_date = aes_encrypt($date." ".$time);
			
			$bill_amount = aes_encrypt($bill_amount);
			$bill_txn_id = aes_encrypt("CASH".rand(00000, 99999));
			
			$bill_order_id = aes_encrypt($bill_order_id);
			
			$update_bill = "update billing set bill_order_id='$bill_order_id', 
						bill_txn_id='$bill_txn_id', bill_amount='$bill_amount',
						bill_date='$bill_date', bill_status='1' 
						where bill_trt_id='$trt_id'
						";
			if(mysqli_query($conn, $update_bill)){
				$txn_status = 1;
			}else{
				$txn_status = 0;
			}
			
		}else{
			header('location:../index.php');
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
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto p-4">
                <div class="card-body">
				<div class="row justify-content-center">
						<h4 class="title text-center user-status p-3 mt-4 col-sm-10 col-md-10 col-lg-10">
							Payment Status
						</h4>
					</div>
					<div class="row justify-content-center">
						<h4 class="title text-center user-status p-3 mt-4 col-sm-6 col-md-6 col-lg-6">
							<b><?php
								
								// On success
								if ($txn_status == 1) {
									echo "Transaction was successful.<br><br>";
									echo "Amount Recieved: ".aes_decrypt($bill_amount)."<br><br>";
									echo "Transaction ID: ".aes_decrypt($bill_txn_id)."<br>";
									echo "Order ID: ".aes_decrypt($bill_order_id)."<br>";
									
								}else{
									echo "Transaction was failed.";
								}
							
							?></b>
						
						</h4>
					</div>
				</div>
            </div>
        </div>
    </div>
</body>
</html>