@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper" id="app">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Contact</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
						<li class="breadcrumb-item active">Contact</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<contact :userid="{{Auth()->user()->id}}"></contact>
</div>
@endsection