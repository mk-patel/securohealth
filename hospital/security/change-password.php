<?php

	// This ("connetion.php") file contains Database Connection code.
	require_once '../control/identification.php';
	
	if(isset($_POST["submit"]) && isset($_POST["current_password"]) && isset($_POST["password"]) && isset($_POST["repeat_password"])){

		$current_password = $_POST["current_password"];
		$password = mysqli_real_escape_string($conn, $_POST["password"]);
		$repeat_password = mysqli_real_escape_string($conn, $_POST["repeat_password"]);
		
		if(empty($current_password) && empty($password) && empty($repeat_password)){
			echo "<script>
				alert('Empty field not allowed');
			</script>";
		}else{
			if($password != $repeat_password){
				echo "<script>
						alert('New password is not matching with re-enter password');
					</script>";
			}else{
				$select_pwd = "select hp_password from hospital where hp_id='$hp_id'";
				$pwd_result = mysqli_query($conn, $select_pwd);
				
				if(mysqli_num_rows($pwd_result)<=0){
					echo "<script>
							alert('Invalid Access');
						</script>";
				}else{
					$pwd_row = mysqli_fetch_assoc($pwd_result);
					$pwd = $pwd_row['hp_password'];
					
					$cpwd = md5($current_password);
					$cpwd = sha1($cpwd);
					
					if($pwd != $cpwd){
						echo "<script>
							alert('Current password is wrong');
						</script>";
					}else{
						$password = md5($password);
						$password = sha1($password);
						
						$pwd_query = "update hospital set hp_password='$password' where hp_id='$hp_id'";
						
						if(mysqli_query($conn, $pwd_query)){
							echo "<script>
								alert('Successfully Changed, Please Login Again');
							</script>";
						}else{
							echo "<script>
								alert('Unsuccessful, try again.');
							</script>";
						}
					}
				}	
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">  
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>  
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"> </script>  
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
	.loose-color{
		color: #ff69b4;
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
	
		.user-status{
			background:#fff0f5;
			border-radius:40px;
		}
		 .form-input {
            position: relative;
        }

        .form-input input {
            width: 100%;
            height: 45px;
            padding-left: 40px;
            margin-bottom: 20px;
            box-sizing: border-box;
            box-shadow: none;
            border: 1px solid #00000020;
            border-radius: 50px;
            outline: none;
            background: transparent;
        }

        .form-input span {
            position: absolute;
            top: 10px;
            padding-left: 15px;
            color: #007bff;
        }

        .form-group {
            width: 100%;
            height: 45px;
            padding-left: 40px;
            margin-bottom: 20px;
            box-sizing: border-box;
            box-shadow: none;
            border: 1px solid #00000020;
            border-radius: 50px;
            outline: none;
            background: transparent;
        }

        .form-group span {
            position: absolute;
            top: 10px;
            padding-left: 15px;
            color: #007bff;
        }

        .form-input input::placeholder {
            color: black;
            padding-left: 0px;
        }

        .form-input input:focus,
        .form-input input:valid {
            border: 2px solid #007bff;
        }

        .form-input input:focus::placeholder {
            color: #454b69;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #007bff !important;
            border: 0px;
        }

        /* .form-box button[type="submit"]{
		  margin-top: 10px;
		  border: none;
		  cursor: pointer;
		  border-radius: 50px;
		  background: #007bff;
		  color: #fff;
		  font-size: 90%;
		  font-weight: bold;
		  letter-spacing: .1rem;
		  transition: 0.5s;
		  padding: 12px;
		} */

		/* .form-box button[type="submit"]:hover{
		  background: #0069d9;
		} */
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
							<i class="fas fa-home" aria-hidden="true"></i>
						</span>
						Dashboard
					  </a>
					</li>
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
				  <a class="nav-link" href="../index.php">
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
				  <a class="nav-link active" href="#">
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
        <h1 class="h3 heading-text"><b><i class="fas fa-calculator"></i> Change Password</b></h1>
      </div>
      <!-- <div class="card"> -->
	  <br>
		<div class="container pb-5">
        <div class="row">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto p-4">
                <div class="card-body">
					<div class="row justify-content-center">
						<h4 class="title text-center user-status p-3 mt-4 col-sm-6 col-md-6 col-lg-6">
							Change Your Password
						</h4>
					</div>
					<div class="mt-3 row justify-content-center">
						<form class="form-box px-3" action="" method="post">
							<div class="form-input">
								<span><i class="fa fa-key"></i></span>
								<input type="password" name="current_password" id="current_password" placeholder="Current Password" tabindex="10" required>
							</div>
							<div class="form-input">
								<span><i class="fa fa-key"></i></span>
								<input type="password" name="password" id="password" placeholder="New Password" tabindex="10" required>
							</div>
							<div class="form-input">
								<span><i class="fa fa-key"></i></span>
								<input type="password" name="repeat_password" id="repeat_password" placeholder="Re-Enter New Password" tabindex="10" required>
								
							</div>
							<input type="hidden" name="tokan" id="tokan" value="<?php echo $tokan;?>" required>
							<div class="mb-3 text-center">
								<button type="submit" name="submit" class="btn btn-sm btn-primary">
									Change
								</button>
							</div>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
	  <br>
	  <br>
	  <br>
    </main>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
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