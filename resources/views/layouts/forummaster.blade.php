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
	<link rel="stylesheet" href="{{ asset('/asset/plugins/select2/css/select2.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('/asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
	<script src="{{ asset('/asset/plugins/select2/js/select2.full.min.js') }}"></script>
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
			<div class="container">
				<a href="{{ route('welcome') }}" class="navbar-brand">
					<img src="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">Forum</span>
				</a>

				<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse order-3" id="navbarCollapse">
					<!-- Left navbar links -->
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="{{ route('forum.index') }}" class="nav-link">Forum Index</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">Whats New?</a>
						</li>
					</ul>
				</div>

				<!-- Right navbar links -->
				<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
					<!-- Messages Dropdown Menu -->
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="fas fa-search"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<div class="dropdown-item">
								<form>
									<div class="form-group row">
										<input type="text" name="serach" class="form-control form-control-sm">
									</div>
									<div class="form-group row ml-4">
										<input type="checkbox" name="onlyTitle" id="onlyTitle" class="form-check-input">
										<label for="onlyTitle" class="form-check-label">Search Only Title</label>
									</div>
									<a href="#" class="btn btn-primary btn-sm">Search</a>
									<a href="#" class="btn btn-primary btn-sm">Advanced Search</a>
								</form>
							</div>
						</div>
					</li>
					<!-- Notifications Dropdown Menu -->
					<li class="nav-item dropdown" style="margin-top: -7px;">
						@auth
						<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							@if($user->desc)
							@if($user->desc->image)
							<img src="{{asset($user->desc->image)}}" class="rounded-circle"width="40" height="40">
							@else
							@endif
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
		</nav>
		<!-- /.navbar -->

		@yield('content')

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">
				Anything you want
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->
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
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>	