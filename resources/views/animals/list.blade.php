@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper" id="app">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Animals</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active"> Animals</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<router-view :userid="{{auth()->user()->id}}"></router-view>
	{{--<animals-list :userid="{{auth()->user()->id}}"></animals-list>--}}
</div>
@endsection