<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="health records, health history, health security, online health documents">
		<meta name="author" content="Manish Patel, Pankaj Sahu">
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- Shortcut Icon for Browser-->
		<link rel="shortcut icon" href="sys-images/logo.png" />
		<title>SecuroHealth</title>
		<!-- Inline css to manage the styling in a simple way-->
		<style>
			body{
				background-image:linear-gradient(to bottom,  #fff0f5 ,white);
			}
			.nav-bg{
				background:#f8c8dc;
			}
			.heading-text{
				color:#191970;
			}
			.paragraph-text{
				color:#301934;
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
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light nav-bg">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">
					<img src="sys-images/logo.png" alt="" width="30" height="30" class="d-inline-block align-text-top heading-text">
					SecuroHealth
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse paragraph-text" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Dropdown
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">Action</a></li>
								<li><a class="dropdown-item" href="#">Another action</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="#">Something else here</a></li>
							</ul>
						</li>
					</ul>
					<form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-loose-color" type="submit">Go</button>
					</form>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="text-center p-2">
				<div class="heading-text h3">
					<p>SecuroHealth</p>
				</div>
				<div class="paragraph-text">
					Something new is coming, lets create a new platform to store health related documentation in secured way - <cite title="Source Title">SecuroHealth</cite>
				</div>
			</div>
			<hr/>
			<div class="text-center p-2">
				<div class="heading-text h5">
					<p>Form Standard</p>
				</div>
			</div>
			<form>
				<div class="mb-3">
					<label for="exampleInputEmail1" class="form-label paragraph-text">Email address</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label paragraph-text">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1">
					<div id="passwordHelpBlock" class="form-text">
						Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
					</div>
				</div>
				<div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label paragraph-text" for="exampleCheck1">Check me out</label>
				</div>
				<button type="submit" class="btn btn-strong-color">Submit</button>
				<button type="submit" class="btn btn-loose-color">Cancel</button>
			</form>
			<hr/>
			<div class="text-center p-2">
				<div class="heading-text h5">
					<p>Button Standard</p>
				</div>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-strong-color">Should Be Pressed</button>
				<button type="submit" class="btn btn-loose-color">Should Not Be Pressed</button>
			</div>
			<hr/>
			<div class="text-center p-2 mt-3">
				<div class="heading-text h5">
					<p>Modal Standard (Popup Box)</p>
				</div>
			</div>
			<div class="text-center">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-strong-color" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Launch demo modal
				</button>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title heading-text" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body paragraph-text">
								Go Next ?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-loose-color" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-strong-color">Save changes</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr/>
			<div class="text-center p-4">
				<div class="heading-text h5">
					<p>Table Standard</p>
				</div>
			</div>
			<table class="table table-striped table-hover p-1 paragraph-text">
				<thead>
					<tr>
					  <th scope="col">#</th>
					  <th scope="col">First</th>
					  <th scope="col">Last</th>
					  <th scope="col">Handle</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					  <th scope="row">1</th>
					  <td>Mark</td>
					  <td>Otto</td>
					  <td>@mdo</td>
					</tr>
					<tr>
					  <th scope="row">2</th>
					  <td>Jacob</td>
					  <td>Thornton</td>
					  <td>@fat</td>
					</tr>
					<tr>
					  <th scope="row">3</th>
					  <td>Larry the Bird</td>
					  <td>Mkpatel</td>
					  <td>@twitter</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Bootstrap Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</body>
</html>