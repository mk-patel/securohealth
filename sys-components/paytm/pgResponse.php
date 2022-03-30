<?php
	//Havind identity codes.
	require_once '../../sys-control/connection.php';
	//Havind identity codes.
	require_once '../crypt/pub-encrypt.php';
	
	
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	// following files need to be included
	require_once("./lib/config_paytm.php");
	require_once("./lib/encdec_paytm.php");

	$paytmChecksum = "";
	$paramList = array();
	$isValidChecksum = "FALSE";

	$paramList = $_POST;


	$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

	//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
	$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


	if($isValidChecksum == "TRUE") {
		
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
								if ($_POST["STATUS"] == "TXN_SUCCESS") {
									echo "Transaction was successful.";
									
								}else{
									echo "Transaction was failed.";
								}
							
							?></b>
						
						</h4>
					</div>
					<div class="row justify-content-center">
						<h4 class="title h6 text-center user-status p-3 mt-4 col-sm-6 col-md-6 col-lg-6">
							<?php
								
								if (isset($_POST) && count($_POST)>0 )
								{
									echo "Order ID : ".$_POST['ORDERID']."<br/><br/>";
									echo "Transaction ID : ".$_POST['TXNID']."<br/><br/>";
									echo "<b>Amount Rs. : ".$_POST['TXNAMOUNT']."</b><br/>";
									echo "Date : ".$_POST['TXNDATE']."<br/>";
									
									$bill_amount = aes_encrypt($_POST['TXNAMOUNT']);
									$bill_order_id = $_POST['ORDERID'];
									$bill_txn_id = aes_encrypt($_POST['TXNID']);
									$bill_date = aes_encrypt($_POST['TXNDATE']);
									
									$bill_trt_id_explode = explode("_", $bill_order_id);
									$bill_trt_id = $bill_trt_id_explode[1];
									
									$bill_order_id = aes_encrypt($bill_order_id);
									
									$update_bill = "update billing set bill_order_id='$bill_order_id', 
												bill_txn_id='$bill_txn_id', bill_amount='$bill_amount',
												bill_date='$bill_date', bill_status='1' 
												where bill_trt_id='$bill_trt_id'
												";
									if(mysqli_query($conn, $update_bill)){
										echo "<br/> Success";
									}else{
										echo "<br/> Failed";
									}
									
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
<?php
	}
	else {
		echo "<b>Checksum mismatched.</b>";
		//Process transaction as suspicious.
	}

?>