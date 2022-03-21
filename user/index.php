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
	$user_id = aes_decrypt($_SESSION['uid']);
	$user_email = aes_decrypt($_SESSION['email']);
	$password = aes_decrypt($_SESSION['password']);
	
	if(empty($user_id) || empty($user_email) || empty($password)){
		header("location: ../index.html");
	}else{
			
		$query = "select user_email,password,user_first_name,user_verified,user_status from user where user_id='$user_id' and password='$password'";
		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result)<=0){
			header('location: ../index.html');
		}
		
		else{
			$row = mysqli_fetch_assoc($result);
			$user_first_name = aes_decrypt($row["user_first_name"]);
			$user_email_dec = aes_decrypt($row["user_email"]);
			$user_verified = $row['user_verified'];
			$user_status = $row["user_status"];

			if(empty($user_verified) || empty($user_status) || empty($user_first_name)){
				header("location: ../index.html");
			}
			else if($user_verified != 1 || $user_status == 3){
				header("location: ../index.html");
			}
			else if($user_email != $user_email_dec){
				header("location: ../index.html");
			}
			else if($password != $row["password"]){
				header("location: ../index.html");
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
				  <a class="nav-link active" href="#">
					<i class="feather fa fa-home" aria-hidden="true">&nbsp;&nbsp;Dashboard <span class="sr-only">(current)</span></i>
					
				  </a>
				</li>
				<li class="nav-item p-2">
				  <a class="nav-link" href="curocard/index.php">
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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h3 heading-text"><b><i class="fas fa-home"></i> Dashboard</b></h1>
      </div>

      <!-- <div class="card"> -->
      <div class="d-flex flex-row justify-content-between border-bottom pt-5">
        <div class="p-2 heading-text h4">Treatment Sessions</div>
        <div class="p-2">
          <form class="d-flex">
            <div class="input-group">
              <input type="search" class="form-control form-control-md" placeholder="Search..."
                aria-label="Recipient's username" aria-describedby="button-addon2">
              <button class="btn btn-sm btn-success" type="submit" id="button-addon2"><i
                  class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
      </div> <br> <br>

      <!-- THE LIST OF CARDS FOR PRINTING -->
      <div class="row">
	  <?php
		$trt_select = "select trt_id, trt_name, hp_name, trt_closing_date, trt_completed from treatment_session
			inner join hospital on hp_id=trt_hp_id
			where trt_user_id=$user_id
			order by trt_id desc
			";
		$trt_result = mysqli_query($conn, $trt_select);
		if(mysqli_num_rows($trt_result)<=0){
			echo "<div class='text-center h5 p-3'>You don't have any treatment history.</div>";
		}else{
			while($trt_row = mysqli_fetch_assoc($trt_result)){
				if($trt_row['trt_completed']==1){
					$bg = "background:#ccffda";
				}
	  ?>
        <div class="col-md-4">
          <div class="card mb-4 box-shadow" style="<?php echo $bg;?>">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b><?php echo $trt_row['trt_name'];?></b>
					</div>
					TID: <?php echo $trt_row['trt_id'];?>
				</div>
				<p class="card-text mt-1">
					<?php echo $trt_row['hp_name'];?><br/>
					<?php 
						if($trt_row['trt_closing_date']==0){
							echo "Currently Running...";
						}else{
							echo "Discharge Date: ".$trt_row['trt_closing_date'];
						}
					?>
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-session.php?trt=<?php echo aes_encrypt($trt_row['trt_id']);?>" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<?php
			}
		}
		?>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
              </div>
            </div>
          </div>
        </div>
		<div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <div class="card-body">
				<div class="d-flex justify-content-between">
					<div class="btn-group">
					<b>Treatment Session</b>
					</div>
					TID: 1
				</div>
				<p class="card-text mt-1">
					Hospital Name<br/>
					Discharge Date: 03/03/2022
				</p>
				<p class="card-text text-muted">  </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div> <br>
                <a href="session-details/treatment-categories.html" class=""> <button type="button" class="btn btn-success btn-sm">Open</button> </a>
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