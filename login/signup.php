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
            background: url(../sys-images/login-banner.jpeg) center;
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
	<header class="continer-fluid p-2 pb-5">
        <div id="menu-jk" class="header-bottom mt-5">
            <div class="container">
                <div class="row nav-row mt-5">
                    <div class="col-lg-12 col-md-12 logo">
                        <a class="navbar-brand" href="#">
                            <img src="../sys-images/long-logo.png" alt="" width="260" height="35"
                                class="d-inline-block align-text-top heading-text"> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container pb-5">
        <div class="row px-3">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
                <div class="img-left d-none d-md-flex"></div>
                <div class="card-body">
                    <h4 class="title text-center mt-4">
                        Create Account
                    </h4>
					<p class="title text-center mt-4">
                        All details should to genuine. Future updation will become complex.
                    </p>
                    <form class="form-box px-3" action="verify-email.php" method="post" enctype="multipart/form-data">
                        <div class="form-input">
                            <span><i class="fa fa-user-o"></i></span>
                            <input type="text" name="user_first_name" id="user_first_name" placeholder="First Name" tabindex="" required>
                        </div>
						<div class="form-input">
                            <span><i class="fa fa-user-o"></i></span>
                            <input type="text" name="user_last_name" id="user_last_name" placeholder="Last Name" tabindex="" required>
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-envelope-o"></i></span>
                            <input type="email" name="user_email" id="user_email" placeholder="Email Address" tabindex="10" required>
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" name="password" id="password" placeholder="Password" required>
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" name="password_repeat" id="password_repeat" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-input">
						<span><i class="fa fa-male"></i></span>
                            <select name="user_gender" id="user_gender" class="form-group">
                                <option value="none" disabled selected>Gender</option>
                                <option value="male">Male</option>
                                <option value="femal">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
						<hr/>
						<div class="row">
							<div class="form-input col-sm-5">
								<span><i class="fa fa-calendar-o"></i> Date Of Birth</span>
							</div>
							<div class="form-input col-sm-7">
								<input type="date" class="pl-3" name="user_dob" id="user_dob" placeholder="Date of Birth" required>
							</div>
						</div>
						<hr/>
						<div class="form-input">
                            <span><i class="fa fa-map-marker"></i></span>
                            <input type="address" name="user_address" id="user_address" placeholder="Address" required>
                        </div>
						<div class="row">
							<div class="form-input col-sm-7">
								<span><i class="fa fa-map-marker"></i></span>
								<input type="address" name="user_city" id="user_city" placeholder="City" required>
							</div>
							<div class="form-input col-sm-5">
								<span><i class="fa fa-map-marker"></i></span>
								<input type="number" name="user_pincode" id="user_pincode" placeholder="Pincode" required>
							</div>
						</div>
						<hr/>
						<div class="row pb-2">
							<div class="form-input col-sm-5">
								<span><i class="fa fa-file-image-o"></i> Profile Picture</span>
							</div>
							<div class="form-input col-sm-7">
								<input class="pt-2 pl-3" type="file" name="user_image" id="user_image" required>
							</div>
							
						</div>
							<p class=" text-center">
								Profile Picture's size should be under <b>80KB</b>.
							</p>
						<hr/>
						<div class="form-control">
							<input type="checkbox" name="term" id="term" required> <span class="term"> <a href="#" class="text-secondary">Agree Terms & Conditions</a></span>
						</div>
						<br/>
                        <div class="mb-3">
                            <button type="submit" onclick="return sub();" class="btn btn-sm btn-primary btn-block text-uppercase" name="submit" id="submit">
                                Sign Up
                            </button>
                        </div>
						<div class="mb-3">
                            <p class="text-center p-2" id="notify"><span id="notify"><img src="../sys-images/loading.gif" width="70px" height="70px"></span></p>
                        </div>
                        <hr class="my-4">
                        <div class="text-center mb-2">
                            If you have an account?
                            <a href="signin.php" class="register-link">
                                Sign in here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript">
		document.getElementById("notify").style.display="none";
		function sub() {
			document.getElementById("submit").style.display="none";
			document.getElementById("notify").style.display="block";
			return true;
		}
	</script>
</body>

</html>