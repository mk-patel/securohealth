<?php
	// Database connection code.
	require_once "../../sys-control/connection.php";

	// Including cryptography codes.
	require_once "../../sys-components/crypt/pub-encrypt.php";
	require_once "../../sys-components/crypt/pub-decrypt.php";
	
	$status = 0;
	
			
	// On submit button clicked.
	if(isset($_POST["hp_email"]) && isset($_POST["hp_password"])){
		$hp_email = trim(mysqli_real_escape_string($conn, $_POST['hp_email']));
		$hp_password = mysqli_real_escape_string($conn, $_POST['hp_password']);
		
		if(!empty($hp_email) && !empty($hp_password)){
			
			// Checking for email existency.
			$select_hp = "select hp_id,hp_email,hp_password,hp_status from hospital";
			$select_result = mysqli_query($conn, $select_hp);
			
			while($hp_row_encrypted = mysqli_fetch_assoc($select_result)){
				$hp_decrypted_email = aes_decrypt($hp_row_encrypted['hp_email']);
				$hp_id = $hp_row_encrypted['hp_id'];
					
				if($hp_row_encrypted['hp_status']==1){
					
					if($hp_decrypted_email == $hp_email){
						$hp_row_password = $hp_row_encrypted['hp_password'];
						$hp_id = $hp_row_encrypted['hp_id'];
						$status = 200;
						break;
					}
					else{
						$status = 1;
					}
				}else{
					header('location:issue.php?i=1');
				}
			}
		}else{
			echo "<script>alert('All Fields Are Required.');</script>";
		}
	}
	if($status == 1){
		echo "<script>alert('Warning! Invalid Access.');</script>";
	}
	else if($status == 200){ 
		$hp_password = md5($hp_password);
		$hp_password = sha1($hp_password);
		
		if($hp_password != $hp_row_password){
			echo "<script>alert('Warning! Invalid Access.');</script>";
		}else{
			
			// Starting the session to keep the hp logged in.
			session_start();
			
			$_SESSION['hp_id'] = aes_encrypt($hp_id);
			$_SESSION['hp_email'] = aes_encrypt($hp_email);
			$_SESSION['hp_password'] = aes_encrypt($hp_password);
			header('location:../index.php');
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
      height: 100vh;
      /* background: #0062E6 !important; */
      background-image: linear-gradient(to bottom, #fff0f5, white);
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

    .img-left {
      width: 45%;
      background: url(../../sys-images/login-banner.jpeg) center;
      background-size: cover;
    }

    .card-body {
      padding: 2rem;
    }

    .title {
      margin-bottom: 2rem;
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

    .forget-link,
    .register-link {
      color: #007bff;
      font-weight: bold;
    }

    .forget-link:hover,
    .register-link:hover {
      color: #0069d9;
      text-decoration: none;
    }
  </style>
</head>
<body>
	<nav class="continer-fluid pb-5">
        <div id="menu-jk" class="header-bottom">
            <div class="container">
                <div class="row nav-row">
                    <div class="col-lg-12 col-md-12 logo">
                        <a class="navbar-brand" href="#">
                            <img src="../../sys-images/long-logo.png" alt="" width="260" height="35"
                                class="d-inline-block align-text-top heading-text"> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
          <h4 class="title text-center mt-4">
			Sign In Carefully
        </h4>
        <form class="form-box px-3" action="" method="post">
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="email" name="hp_email" placeholder="Email Address" tabindex="10" required>
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="hp_password" name="hp_password" placeholder="Password" required>
            </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-sm btn-primary btn-block text-uppercase">
                Sign In
              </button>
            </div>
            <hr class="my-4">
            <div class="text-center mb-2">
              Don't have an account?
              <a href="signup.php" class="register-link">
                Register here
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>