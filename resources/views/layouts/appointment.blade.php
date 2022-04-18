
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content=" ">

	<title>Customize Tailor</title>
    <link href="{{ asset('assets/css/light.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/media.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<header>
		<nav class="navbar fixed-top navbar-expand-lg  ">
		  <div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"> <i class="fa fa-navicon"></i> </span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			  <div class="row">
				  <div class="col-md-1 col-2 p-0">
					  <a class="navbar-brand" href="#"><img src="{{ asset('assets/img/logo.jpg') }}" height="40" alt="logo"></a>
				  </div>
				  <div class="col-md-5 menu-top col-10 p-0">
					  <ul>
						  <li>
							  <a href="">MEN</a>
						  </li>
						  <li>
							  <a href="">WOMEN</a>
						  </li>
						  <li>
							  <a href="/appointment">BOOK APPOINTMENT</a>
						  </li>
					  </ul>
				  </div>
				  <div class="col-md-3 col-12 p-0">
					  <!-- <form class="navbar-left search-box">
						  <input class="form-control me-2" type="search" value="Search" placeholder="Search" aria-label="Search">
						  <i class="fa fa-search search-icon"></i>
						 </form> -->
				  </div>
				  <div class="col-md-3 login-menu-top d-flex justify-content-end col-12">
					  <!-- <ul>
						  <li>
							  <a href="#">Login</a>
						  </li>
						  <li>
							  <a href="#">Sing Up</a>
						  </li>
						  <li>
							  <a href="#"> <i class="fa fa-user"></i> </a>
						  </li>
						  <li>
							  <a href="#"><i class="fa fa-cart-plus"> </i> </a>
						  </li>
					  </ul> -->
				  </div>
			  </div>
		   
			</div>
		  </div>
		</nav>
  </header>
	<!-- <section class="banner-section position-relative">
		<img src="{{ asset('assets/img/banner.jpg') }}" alt="Los Angeles" class="d-block" style="width:100%" height="400">
		<div class="banner-text">
			 <h2>Welcome <br>
				To Customize Tailor
			</h2>
		</div>
		 
	</section> -->
    <div class="container mt-7">
		<!-- <div class="breadcrumb-menu mt-4 mb-4">
			<ul class="m-0 p-0 d-flex">
				<li>
					<a href="">Home</a>
				</li>
				<li class="pl-1">
					<a href="">Men</a>
				</li>
			</ul>
		</div> -->

		<div class="row">
			  <div class="col-md-8 m-auto">
					
				<div class="row mb-5">
					<div class="col-md-3 d-flex align-items-center">
						<p class="mb-0 font-weight-500 f-16">Select  what to  stitch</p>
					</div>
					<div class="col-md-6">
						<select class="form-control"> 
							<option value="shirt">Shirt</option>
                            <option value="Pant">Pant</option>
                            <option value="Kurta">Kurta</option>
						</select>
					</div>
				</div>
				
				<h3 class="font-weight-500 mb-4">SHRITS MEASUREMENT</h3>

				<div class="row">
					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16">Type Of Collar</p>
						<select class="form-control"> 
							<option></option>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16 d-flex justify-content-between">Collar 
							<i class="fa fa-info-circle"></i>
						</p>
						<input class="form-control" type="text">
					</div>

					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16">Type Of Shoulder</p>
						<select class="form-control"> 
							<option></option>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16 d-flex justify-content-between">Shoulder 
							<i class="fa fa-info-circle"></i>
						</p>
						<input class="form-control" type="text">
					</div>


					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16">Type Of Neck</p>
						<select class="form-control"> 
							<option></option>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16 d-flex justify-content-between">Neck 
							<i class="fa fa-info-circle"></i>
						</p>
						<input class="form-control" type="text">
					</div>


					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16">Type Of Cuff</p>
						<select class="form-control"> 
							<option></option>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16 d-flex justify-content-between">Cuff 
							<i class="fa fa-info-circle"></i>
						</p>
						<input class="form-control" type="text">
					</div>


					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16">Body Posture Details</p>
						<select class="form-control"> 
							<option></option>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<p class="mb-1 f-16 d-flex justify-content-between">No of shrits 
							<i class="fa fa-info-circle"></i>
						</p>
						<select class="form-control"> 
							<option></option>
						</select>
					</div>


				</div>

			  </div>
		</div>
	</div>
	<footer>
		<div class="container-fluid"> 
		<div class="row">
			<div class="col-md-6 d-flex align-items-center">
				<p class="m-0"> © 2022 Customize Tailor. All rights reserved</p>
			</div>
			<!-- <div class="col-md-6 d-flex justify-content-end align-items-center">
				<ul>
					<li><a href="#">Footer Link</a></li>
					<li><a href="#">Footer Link</a></li>
					<li><a href="#">Footer Link</a></li>
				</ul>
			</div> -->
		</div>
		</div>
	</footer>
	

	<script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>