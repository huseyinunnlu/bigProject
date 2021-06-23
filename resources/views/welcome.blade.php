<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AdminLTE 3 | Dashboard</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/asset/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="{{ asset('/asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{ asset('/asset/plugins/jqvmap/jqvmap.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('/asset/dist/css/adminlte.min.css') }}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('/asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('/asset/plugins/daterangepicker/daterangepicker.css') }}">
	<!-- summernote -->
	<link rel="stylesheet" href="{{ asset('/asset/plugins/summernote/summernote-bs4.min.css') }}">
</head>
<body>
	<div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<img src="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">
				<a class="ml-2 navbar-brand" href="#">Company Name</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsExample07">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">News</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Market</a>
						</li>
					</ul>
					<div class=" my-2 my-md-0">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								@auth
								<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									@if($user->desc->image)
									<img src="{{asset($user->desc->image)}}" class="rounded-circle"width="40" height="40">
									@endif
									 {{auth()->user()->name}}</a>
								<div class="dropdown-menu">
									<a href="{{ route('profile',[auth()->user()->id,auth()->user()->slug]) }}" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
									<form method="POST" action="{{ route('logout') }}">
										@csrf
										<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
										this.closest('form').submit();">
										{{ __('Log Out') }}
									</a>
								</form>
							</div>
							@else
							<a href="{{ route('login') }}">Login</a> |
							<a href="{{ route('register') }}">Register</a>	
							@endif
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<header>
		<div class="header">
			<div class="body d-flex">
				<div class="body-left">
					<img src="{{ asset('asset/background.jpg') }}">
				</div>	
				<div class="body-right">
					<h3>Welcome To <br> Company Name</h3>
					<div class="links">
						<a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
						<a href="#" class="btn btn-success btn-sm">News</a>
						<a href="#" class="btn btn-info btn-sm">Market</a>
					</div>
					@if(!auth()->user())
					<div class="login m-1">
						<a href="{{ route('login') }}">Login</a> or 
						<a href="{{ route('register') }}">Register</a>
					</div>
					@endif
				</div>
			</div>
		</div>
	</header>
</div>
<section>
	<div class="container">
		<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
			<h1 class="display-4">About Us</h1>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<h1 class="display-4 text-center mb-3">Our Services</h1>
		<div class="card-deck mb-3 text-center">
			<div class="card mb-4 box-shadow">
				<div class="card-header">
					<h4 class="my-0 font-weight-normal">Farm Managment</h4>
				</div>
				<div class="card-body">
					<ul class="list-unstyled mt-3 mb-4">
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Animal Managment</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Milk Manangment</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Ration Manangment</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Some Calculation Systems</li>
					</ul>
					<a href="#" class="btn btn-lg btn-block btn-outline-primary">
						@if(!auth()->user())

							Login Or Register
						@elseif(auth()->user()->type=='user')
							Contact Us For Verified User Type
						@elseif(auth()->user()->type=='admin' || auth()->user()->type=='verified' || auth()->user()->type=='moderator')
							Go Dashboard
						@endif
					</a>
				</div>
			</div>
			<div class="card mb-4 box-shadow">
				<div class="card-header">
					<h4 class="my-0 font-weight-normal">News</h4>
				</div>
				<div class="card-body">
					<ul class="list-unstyled mt-3 mb-4">
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Lastest News</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> FULL NEUTRALIY</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Right News</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Less Advertisement</li>
					</ul>
					<a href="" class="btn btn-lg btn-block btn-outline-primary">
						Go News
					</a>
				</div>
			</div>
			<div class="card mb-4 box-shadow">
				<div class="card-header">
					<h4 class="my-0 font-weight-normal">Marketplace</h4>
				</div>
				<div class="card-body">
					<ul class="list-unstyled mt-3 mb-4">
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Sell Machines and Crops</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Basic UI</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Right Test</li>
						<li class="text-success h6"><i class="fas fa-check-circle"></i> Right Test</li>
					</ul>
					<a href="" class="btn btn-lg btn-block btn-outline-primary">
						Go Marketplace
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>


<!-- jQuery -->
<script src="{{ asset('/asset/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ asset('/asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('/asset/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('/asset/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('/asset/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('/asset/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('/asset/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('/asset/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/asset/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('/asset/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/asset/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/asset/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/asset/dist/js/pages/dashboard.js') }}"></script>
</body>
</html>
