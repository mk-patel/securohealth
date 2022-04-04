<?php
	// Starting the session to keep the user logged in.
	session_start();

	// This ("connetion.php") file contains Database Connection code.
	require_once '../sys-control/connection.php';
	
	// Including cryptography codes.
	require_once "../sys-components/crypt/pub-encrypt.php";
	require_once "../sys-components/crypt/pub-decrypt.php";

	/**
	* Taking mobile number and password from session.
	* Validating the user.
	*/
	$hp_id = aes_decrypt($_SESSION['hp_id']);
	$hp_email = aes_decrypt($_SESSION['hp_email']);
	$hp_password = aes_decrypt($_SESSION['hp_password']);
	
	if(empty($hp_id) || empty($hp_email) || empty($hp_password)){
		header("location: login/signin.php");
	}else{
			
		$query = "select hp_email,hp_password,hp_name,hp_status from hospital where hp_id='$hp_id' and hp_password='$hp_password'";
		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result)<=0){
			header('location: login/signin.php');
		}
		
		else{
			$row = mysqli_fetch_assoc($result);
			$hp_name = aes_decrypt($row["hp_name"]);
			$hp_email_dec = aes_decrypt($row["hp_email"]);
			$hp_status = $row["hp_status"];

			if(empty($hp_id) || empty($hp_email) || empty($hp_password)){
				header("location: login/signin.php");
			}
			else if($hp_status == 0){
				header("location: ../login/issue.php?i=1");
			}else if($hp_status == 2){
				header("location: ../login/issue.php?i=2");
			}
			else if($hp_email != $hp_email_dec){
				header("location: login/signin.php");
			}
			else if($hp_password != $row["hp_password"]){
				header("location: login/signin.php");
			}
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
	.trt-history {
      background: url(../sys-images/login-banner.jpeg) center;
      background-size: cover;
    }
	.trt-history-cover{
		background: rgba(0, 0, 0, 0.6);
	}
  </style>

</head>

<body>
	<nav class="navbar navbar-expand-lg nav-bg sticky-top flex-md-nowrap navbar-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="../sys-images/long-logo.png" alt="" width="200" height="30" class="rounded bg-white d-inline-block align-text-top heading-text">
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
						<a class="nav-link" href="patient-files/">
						<span>
							<i class="fas fa-book-medical" aria-hidden="true"></i>
						</span>
						History
					  </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="billing/bills.php">
						<span>
							<i class="fas fa-file-invoice-dollar" aria-hidden="true"></i>
						</span>
						Billing
					  </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="security/index.php">
						<span>
							<i class="fas fa-calculator" aria-hidden="true"></i>
						</span>
						Security
					  </a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="login/logout.php">
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
						<b><i class="fas fa-building"></i> <?php echo $hp_name;?></b>
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
				  <a class="nav-link active" href="#">
					<i class="feather fa fa-home" aria-hidden="true">&nbsp;&nbsp;Dashboard <span class="sr-only">(current)</span></i>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="patient-files/">
					<span>
						<i class="fas feather fa-book-medical" aria-hidden="true">&nbsp;&nbsp;History</i>
					</span>
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="billing/bills.php">
					<span>
						<i class="fas feather fa-file-invoice-dollar" aria-hidden="true">&nbsp;&nbsp;Billing</i>
					</span>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="security/index.php">
					<span>
						<i class="fas feather fa-calculator" aria-hidden="true">&nbsp;&nbsp;Security</i>
					</span>
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="login/logout.php">
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
    <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h3 heading-text"><b><i class="fas fa-home"></i> Dashboard</b></h1>
      </div>
	  <a href="patient-files/">
	  <div class="card create-trt-session mt-3 trt-history">
		  <div class="trt-history-cover">
			<div class="d-flex flex-row justify-content-center p-3">
			    <div class="p-2">
					<div class="heading-text h5 text-center text-white">
						<b>Treatment History of Individual</b>
					</div>
					<div class="text-center">
						<img src="../sys-images/shqr.png" width-="70px" height="70px">
					</div>
					<div class="text-center mt-2">
						<button class="btn btn-loose-color  btn-sm text-dark">
							View Treatment History
						</button>
					</div>
					 
				</div>
			</div>
		  </div>
      </div>
	  </a>
	  
      <div class="card create-trt-session mt-4 p-3">
        <div class="d-flex flex-row justify-content-between">
          <div class="p-2 mt-1 ml-2 heading-text h5"><b>Create New Treatment Session</b></div>
          <div class="p-2 mr-2"><a href="#" data-toggle="modal" data-target="#createnewtreatmentsession1"
              class="btn btn-strong-color">Create Treatment Session</a> </div>
        </div>
      </div>
      <!-- <div class="card"> -->
      <div class="d-flex flex-row justify-content-between border-bottom pt-4">
        <div class="p-2 heading-text h5">Treatment Sessions</div>
        <div class="p-2">
          <div class="d-flex">
            <div class="input-group">
              <input id="searchValue" type="search" class="form-control form-control-md" placeholder="Search..."
                aria-label="Recipient's username" aria-describedby="button-addon2">
				<button class="btn btn-sm btn-success" type="submit" id="search"><i
                  class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div> <br>

      <!-- THE LIST OF CARDS FOR PRINTING -->
      <div class="row" id="output">
	  
	  <?php
		$trt_select = "select trt_id, trt_name, user_first_name, user_last_name, user_dob, user_gender, user_card, trt_date, trt_closing_date, trt_completed from treatment_session
			inner join user on user_id=trt_user_id
			where trt_hp_id=$hp_id
			order by trt_id desc
			";
		$trt_result = mysqli_query($conn, $trt_select);
		if(mysqli_num_rows($trt_result)<=0){
			echo "<div class='text-center h5 p-3'>You don't have any treatment history.</div>";
		}else{
			while($trt_row = mysqli_fetch_assoc($trt_result)){
				$date = aes_decrypt($trt_row['trt_date']);
				$user_card = aes_decrypt($trt_row['user_card']);
				$bg = "background:white";
				$acti = "Open";
				if($trt_row['trt_completed']==1){
					$bg = "background:#ccffda";
					$date = aes_decrypt($trt_row['trt_closing_date']);
					$acti = "View";
				}
	  ?>
	  <div class="col-md-4">
          <div class="card mb-4 box-shadow" style="<?php echo $bg;?>">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
						<b><?php echo aes_decrypt($trt_row['trt_name']);?> (<?php echo aes_decrypt($trt_row['user_first_name'])." ".aes_decrypt($trt_row['user_last_name']) ;?>)</b>
					</div>
					ID: <?php echo $trt_row['trt_id'];?>
				</div>
				<p class="card-text mt-1">
					Age: <?php echo aes_decrypt($trt_row['user_dob']);?>, Gender: <?php echo aes_decrypt($trt_row['user_gender']);?><br/>
					Date: <?php echo $date;?>
				</p>
				<p class="card-text text-muted"> Card : <?php echo substr($user_card,0,4)." ".substr($user_card,4,3)." ".substr($user_card,7,4);?> </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-session.php?trt_name=<?php echo aes_decrypt($trt_row['trt_name']);?>" class=""> <button type="button" class="btn btn-success btn-sm"><?php echo $acti;?></button> </a>
              </div>
            </div>
          </div>
        </div>
		<?php
			}
		}
		?>
      </div>
    </main>

    <!-- BOOTSTRAP MODAL FOR POP UP -->
    <div class="modal fade" id="createnewtreatmentsession1" tabindex="-1" aria-labelledby="createnewtreatmentsession1"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header d-block">
            <h5 class="modal-title text-center" id="exampleModalLabel">Create New Treatment Session</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="session-details/treatment-session.php" method="get">
              <div class="mb-3">
			  
			  <?php 
				// Genarating Card Number
				function getTrtName() {
					$n = 8;
					$characters = 'ABCDEFG123456';
					$randomString = '';
					for ($i = 0; $i < $n; $i++) {
						$index = rand(0, strlen($characters) - 1);
						$randomString .= $characters[$index];
					}
					
					$conn = mysqli_connect("localhost", "root", "", "securohealth_2799");
					
					$trt_name_select = "select trt_name from treatment_session";
					$trt_name_result = mysqli_query($conn, $trt_name_select);
					while($trt_name_card_row = mysqli_fetch_assoc($trt_name_result)){
						if($randomString == aes_decrypt($trt_name_card_row['trt_name'])){
							getTrtName();
							break;
						}
					}
					return $randomString;
				}
				$trt_name = getTrtName();
			  ?>
				<div class="mb-3 text-center">
					<p>Unique Session Name: <b><?php echo $trt_name;?></b></p>
				</div>
                <input type="hidden" class="form-control form-control-md" name="trt_name" value="<?php echo $trt_name;?>" required>
              </div>
              <div class="mb-3 text-center">
                <button type="submit" class="btn btn-sm btn-strong-color">Scan QR Code</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#search").click(function(){
				$('#output').html('')
			  $.ajax({
				type:'POST',
				url:'search/search-from-hp.php',
				data:{
				  name:$("#searchValue").val(),
				},
				success:function(data){
				  $("#output").html(data);
				}
			  });
			});
		});
	</script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"></script>

</body>

</html>