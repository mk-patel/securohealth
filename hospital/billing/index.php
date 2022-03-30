<?php
	
	//Havind identity codes.
	require_once '../control/identification.php';
	
	if(isset($_REQUEST['tr_id'])){
		$tr_t = mysqli_escape_string($conn, $_REQUEST['tr_id']);
		$trt_id = aes_decrypt($_SESSION['trt_id_56']);
	}else{
		header('location:../index.php');
	}
	
	//Havind identity codes.
	require_once '../control/card-validation.php';
	
	$user_private_key = aes_decrypt($qr_card[1]);
	
	//Private encryption.
	require_once '../../sys-components/crypt/pvt-decrypt.php';
		
	// Selecting user details.
	$select_user_details = "select user_first_name, user_last_name, user_dob, user_gender, user_card
		from user where user_id=$user_id";
	$user_details_result = mysqli_query($conn, $select_user_details);
	$user_details_row = mysqli_fetch_assoc($user_details_result);
	$user_card = aes_decrypt($user_details_row['user_card']);
	
	// Selecting treatment_session details.
	$select_trt_details = "select trt_name, trt_inf, trt_dis, trt_srt, trt_corm, trt_date, trt_closing_date, trt_hp_id, trt_completed from treatment_session where trt_id=$trt_id";
	$trt_details_result = mysqli_query($conn, $select_trt_details);
	$trt_details_row = mysqli_fetch_assoc($trt_details_result);
	$trt_hp_id = $trt_details_row['trt_hp_id'];
	
	if($trt_hp_id!=$hp_id && $trt_details_row['trt_completed']!=0){
		header('location:../index.php');
	}
	
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
        <h1 class="h3 heading-text">
			<b>
				<i class="fas fa-book-medical"></i>
				Billing
			</b>
		</h1>
      </div>
      <div class="d-flex">
        <div class="p-2 mr-auto">Name : <b><?php echo aes_decrypt($user_details_row['user_first_name'])." ".aes_decrypt($user_details_row['user_last_name']);?></b> </div>
        <div class="p-2 h6">Age: <?php echo $age;?>,</div>
        <div class="">
          <div class="p-2 h6"><?php echo aes_decrypt($user_details_row['user_gender']);?></div>
        </div>
      </div>
      <div class="d-flex">
        <div class="p-2 mr-auto">Date : <?php echo aes_decrypt($trt_details_row['trt_date']);?>, <span class="text-muted">Card No. : <?php echo substr($user_card,0,4)." ".substr($user_card,4,3)." ".substr($user_card,7,4);?></span></div>
      </div>
	  <hr/>
	  <div class="row pl-4 p-2">
		Hospital: <?php echo aes_decrypt($trt_hp_row['hp_name']);?>
	  </div>
      <div class="d-flex justify-content-between">
        <div class="p-2">
			<small>
				Infection: <b><?php echo aes_decrypt($trt_details_row['trt_inf']);?></b>
			</small>
        </div>
		<div class="p-2">
			<small>
				Disease: <b><?php echo aes_decrypt($trt_details_row['trt_dis']);?></b>
			</small>
        </div>
		<div class="p-2">
			<small>
				Severty: <b><?php echo aes_decrypt($trt_details_row['trt_srt']);?></b>
			</small>
        </div>
		<div class="p-2">
			<small>
				Cormobideties: <b><?php echo aes_decrypt($trt_details_row['trt_corm']);?></b>
			</small>
        </div>
        </div>
      </div>
      <hr/>
	<br/>
	
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
        <h5 class="heading-text"><b>Invoice</b></h5>
	</div>
	<div class="d-flex btn-strong-color justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
        <button class="btn mt-2 btn-loose-color">
			Status : 
			<?php
				$select_bill = "select bill_status from billing where bill_trt_id='$trt_id'";
				$bill_result = mysqli_query($conn, $select_bill);
				$bill_row = mysqli_fetch_assoc($bill_result);
				
				if($bill_row['bill_status'] == 0){
					echo "Not Paid";
				}else{
					echo "Successfully Paid";
				}
			?>
		</button>
	</div>
	<table class="mt-5 table table-striped table-hover p-1 paragraph-text">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Category</th>
				<th scope="col">Total Cost</th>
			</tr>
		</thead>
		<tbody>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=1";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">1</th>
			  <td>OPD</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=2";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">2</th>
			  <td>Medicines</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=3";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">3</th>
			  <td>Lab Reports</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=4";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">4</th>
			  <td>Diagnosis</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=5";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">5</th>
			  <td>Immunizations</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=6";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">6</th>
			  <td>Allergies</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=7";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">7</th>
			  <td>Certificates</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=8";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">8</th>
			  <td>Other Records</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id and tr_type=9";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr>
			  <th scope="row">9</th>
			  <td>Instructions</a></td>
			  <td>Rs. <?php echo $cost;?> /-</td>
			</tr>
		<?php
			
			$record_select = "select tr_cost from treatment_record where tr_trt_id=$trt_id";
			$recode_result = mysqli_query($conn, $record_select);
			$cost=0;
			if(mysqli_num_rows($recode_result)<=0){
				$cost=0;
			}else{
				while($record_row = mysqli_fetch_assoc($recode_result)){
					$cost = $cost + (int)aes_pvt_decrypt($record_row['tr_cost'], $user_private_key);
				}
			}
		?>
			<tr class="h5 bg-secondary">
			  <th scope="row"></th>
			  <td class="h4 text-white"><b>Grand Total</b></a></td>
			  <td class="h4 text-white">Rs. <?php echo $cost;?> /-</td>
			</tr>
		</tbody>
	</table>
	<br/>
	<?php
		if($bill_row['bill_status'] == 0){
			if(mysqli_num_rows($bill_result)<=0){
				$na = aes_encrypt("NA");
				$cost_enc = aes_encrypt($cost);
				
				$insert_bill = "insert into billing values('', '$na', '$na', '$cost_enc', '$trt_id', '$user_id', '$hp_id', '$na', '0')";
				mysqli_query($conn, $insert_bill);
			}else{
				$cost_enc = aes_encrypt($cost);
				
				$update_bill = "update billing set bill_amount='$cost_enc' where bill_trt_id='$trt_id'";
				mysqli_query($conn, $update_bill);
			}
			
	?>
	<div class="d-flex justify-content-center text-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
		<p>For Online Payments</p>
	</div>
	<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
		<form method="post" action="../../sys-components/paytm/pgRedirect.php">
			<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
				name="ORDER_ID" autocomplete="off"
				value="<?php echo  "ORDS_".$trt_id."_". rand(10000,99999999)?>">
			<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST<?php echo $trt_id;?>">
			<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">	
			<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
				size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
			<input type="hidden" title="TXN_AMOUNT" tabindex="10"
				type="text" name="TXN_AMOUNT"
				value="<?php echo $cost;?>">
			<button type="submit" onclick="" class="btn btn-strong-color">Pay Throgh Paytm Gateway</button>
		</form>
	</div>
	<hr/>
	<br/>
	<div class="d-flex justify-content-center text-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
		<p>For Cash Payments <br/>Mark as paid after collecting cash.<br/>(In case of Rs. 0, mark as paid to process discharge.)</p>
	</div>
	<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
		<button class="btn btn-loose-color">
			<a href="#" data-toggle="modal" data-target="#createnewtreatmentsession1">
				Mark as Paid
			</a>
		</button>
	</div>
	<?php
		}
	?>
	<br/>
	<br/>
	<br/>
	<hr/>
	<div class="form-group d-flex justify-content-center">
		<button type="submit" id="printCard" name="printCard" onclick="window.print()" class="btn btn-strong-color special-button">Print</button>
	</div>
	<br/>
	<br/>
	<br/>
	<br/>
	<div class="modal fade" id="createnewtreatmentsession1" tabindex="-1" aria-labelledby="createnewtreatmentsession1"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header d-block">
            <h5 class="modal-title text-center" id="exampleModalLabel">Are You Sure?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
				<div class="mb-3 text-center">
					<p><b>Once marked as paid, it cannot be reversed.</b></p>
				</div>
             </div>
              <div class="mb-3 text-center">
				<form method="post" action="mark-paid.php">
					<input type="hidden" id="bill_order_id" tabindex="1" maxlength="20" size="20"
						name="bill_order_id" autocomplete="off"
						value="<?php echo  "ORDS_".$trt_id."_". rand(10000,99999999)?>">
					<input type="hidden" title="bill_amount" tabindex="10"
						type="text" name="bill_amount"
						value="<?php echo $cost;?>">
					<button class="btn btn-loose-color">
						Mark as Paid
					</button>
				</form>
              </div>
          </div>
        </div>
      </div>
    </div>
    </main>

<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>