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
								<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{'storage/'.auth()->user()->profile_photo_path}}" class="rounded-circle"width="40" height="40"> {{auth()->user()->name}}</a>
								<div class="dropdown-menu">
									<a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
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
							<a href="#">Login</a> |
							<a href="#">Register</a>	
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
						<a href="#" class="btn btn-primary btn-sm">Dashboard</a>
						<a href="#" class="btn btn-success btn-sm">News</a>
						<a href="#" class="btn btn-info btn-sm">Market</a>
					</div>
					@if(!auth())
					<div class="login m-1">
						<a href="#">Login</a> or 
						<a href="#">Register</a>
					</div>
					@endif
				</div>
			</div>
		</div>
	</header>
</div>


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
