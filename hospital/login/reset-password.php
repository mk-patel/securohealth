<?php
	// Database connection code.
	require_once "../../sys-control/connection.php";
	
	// Including cryptography codes.
	require_once "../../sys-components/crypt/pub-encrypt.php";
	require_once "../../sys-components/crypt/pub-decrypt.php";
	
	if(isset($_REQUEST["tokan"])){
		$tokan = $_REQUEST["tokan"];
	}else{
		header('location:signin.php');
	}
	
	if(isset($_POST["submit"]) && isset($_POST["tokan"]) && isset($_POST["password"]) && isset($_POST["repeat_password"])){

		$tokan = mysqli_real_escape_string($conn, $_POST["tokan"]);
		$password = mysqli_real_escape_string($conn, $_POST["password"]);
		$repeat_password = mysqli_real_escape_string($conn, $_POST["repeat_password"]);
		
		if(empty($tokan) && empty($password) && empty($repeat_password)){
			echo "<script>
				alert('Empty field not allowed');
			</script>";
		}else{
			if($password != $repeat_password){
				echo "<script>
					alert('Password not matching');
				</script>";
			}else{
				$select_fp = "select fp_hp_id, fp_tokan from forget_pass where fp_tokan='$tokan'";
				$fp_result = mysqli_query($conn, $select_fp);
				
				if(mysqli_num_rows($fp_result)<=0){
					echo "<script>
							alert('Invalid Link');
						</script>";
				}else{
					$fp_row = mysqli_fetch_assoc($fp_result);
					$fp_tokan = $fp_row['fp_tokan'];
					if($fp_tokan != $tokan){
						echo "<script>
							alert('Invalid Link');
						</script>";
					}else{
						$fp_hp_id = $fp_row['fp_hp_id'];
						
						$password = md5($password);
						$password = sha1($password);
						
						$tokan_query = "update hospital set hp_password='$password' where hp_id='$fp_hp_id'";
						
						if(mysqli_query($conn, $tokan_query)){
							echo "<script>
								alert('Successful');
							</script>";
							$delete_fp = "delete from forget_pass where fp_tokan='$tokan' and fp_hp_id='$fp_hp_id'";
							mysqli_query($conn, $delete_fp);
							
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!--using FontAwesome--------------->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
						<h4 class="title text-center user-status p-3 mt-4 col-sm-6 col-md-6 col-lg-6">
							Reset Your Password
						</h4>
					</div>
					<div class="row justify-content-center">
						<form class="form-box px-3" action="" method="post">
							<div class="form-input">
								<span><i class="fa fa-key"></i></span>
								<input type="password" name="password" id="password" placeholder="New Password" tabindex="10" required>
							</div>
							<div class="form-input">
								<span><i class="fa fa-key"></i></span>
								<input type="password" name="repeat_password" id="repeat_password" placeholder="Re Enter New Password" tabindex="10" required>
								
							</div>
							<input type="hidden" name="tokan" id="tokan" value="<?php echo $tokan;?>" required>
							<div class="mb-3 text-center">
								<button type="submit" name="submit" class="btn btn-sm btn-primary">
									Submit
								</button>
							</div>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
	
</body>
</html>