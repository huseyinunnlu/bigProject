@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Active Rations Preparation Guide</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
						<li class="breadcrumb-item active">Guide</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="row">
							@foreach ($guides as $guide)
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<h5 class="card-tittle text-center">{{$guide->name->name}}</h5>
									</div>
									<div class="card-body p-0 m-0">
										<ul class="list-group">
											<li class="list-group-item"><strong class="text-primary">Type Name:</strong><span class="float-right">{{$guide->name->type->name}}</span></li>
											<li class="list-group-item"><strong class="text-primary">Number Of Using The Ration:</strong><span class="float-right">{{$guide->count}} Animals</span></li>
											<li class="list-group-item"><strong class="text-primary">Weight of ration to be prepared:</strong><span class="float-right">{{$guide->name->sumfood}}(KG)</span></li>
											<li class="list-group-item"><strong class="text-primary">Price: / 1Kg Price:</strong><span class="float-right">{{$guide->sumprice}} Tl&$ / {{$guide->name->price}} Tl&$</span></li>
											<li class="list-group-item active"><strong class="text-center">Ration Recipe({{$guide->foodCount}} foods)</strong></li>
											@foreach ($guide->name->food as $food)
												<li class="list-group-item"><strong class="text-primary">{{$food->name->name}}:</strong><span class="float-right"><span class="badge badge-primary">{{$food->amount}} Kg</span> / <span class="badge badge-primary">{{$food->price}} Tl&$</span></span></li>
											@endforeach
										</ul>	
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection