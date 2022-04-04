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
	<br/>
    <div class="container">
        <div class="row px-3">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
                <div class="img-left d-none d-md-flex"></div>
                <div class="card-body">
                    <h4 class="title text-center mt-4">
                        Reset Password
                    </h4>
                    <p class="text-center">
                        Please enter your email address
                    </p>
                    <form class="form-box px-3" id="add_new_products">
                        <div class="form-input">
                            <span><i class="fa fa-envelope-o"></i></span>
                            <input type="email" name="hp_email" id="hp_email" placeholder="Email Address" tabindex="10" required>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" id="submit" class="btn btn-sm btn-primary">
                                Send Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script>
	$(document).ready(function (){
		$("#submit").click(function(event){
			event.preventDefault();
			var formdata = new FormData($("#add_new_products")[0]);
			document.getElementById("submit").disabled=true;
			document.getElementById("submit").innerHTML="Please Wait...";
			$.ajax({
				type : "post",
				url : "pass-change-mail.php",
				processData : false,
				contentType : false,
				data : formdata,
				success : function(response){
					alert(response);
					document.getElementById("submit").disabled=false;
					document.getElementById("submit").innerHTML="Email Successfully Sent";
				},
			});
		});
	});
	</script>
	<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>