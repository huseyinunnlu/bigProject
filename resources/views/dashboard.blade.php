@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Dashboard</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Dashboard v1</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				@foreach ($animalCount as $ac)
				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							@if($ac->count)
							<h3>{{$ac->count}}</h3>
							<p>{{$ac->type}}</p>
							@else
							<h3>0</h3>
							<p>Animals</p>
							@endif
						</div>
						<div class="icon">
							<i class="fas fa-paw"></i>
						</div>
					</div>
				</div>
				@endforeach
				@if($animalCount)
				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							@if($sumDayMilk)
							<h3>{{$sumDayMilk}} L</h3>
							<p>Todays Sum Milk</p>
							@else
							<h3>No Milk</h3>
							<p>Todays Sum Milk</p>
							@endif
						</div>
						<div class="icon">
							<i class="fas fa-paw"></i>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							@if($sumMounthMilk)
							<h3>{{$sumMounthMilk}} L</h3>
							<p>This mounth's sum milk</p>
							@else
							<h3>No Milk</h3>
							<p>This mounth's sum milk</p>
							@endif
						</div>
						<div class="icon">
							<i class="fas fa-paw"></i>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							@if($sumYearMilk)
							<h3>{{$sumYearMilk}} L</h3>
							<p>This year's sum milk</p>
							@else
							<h3>No Milk</h3>
							<p>This year's sum milk</p>
							@endif
						</div>
						<div class="icon">
							<i class="fas fa-paw"></i>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</section>
</div>
@endsection