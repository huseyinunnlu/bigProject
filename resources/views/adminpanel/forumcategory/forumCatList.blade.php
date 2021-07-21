@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Forum Categories</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Forum Categories</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="col-md-6 offset-md-3">
			@if (Session::has('success'))
			<div class="alert alert-success mb-3 mt-3">
				<i class="fas fa-check-circle"></i> {{ Session::get('success') }}
			</div>
			@endif
			<div class="card">
				<div class="card-header align-items-center">
					<h3 class="card-title">All Forum Categories</h3>
					<h3 class="card-title float-right">
						<a href="{{ route('admin.forum.cat.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Category</a>
					</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Status</th>
								<th>Alt Category Count</th>
								<th>Opr.</th>
							</tr>
						</thead>
						<tbody>
							@if($categories)
							@foreach($categories as $category)
							<tr data-widget="expandable-table" aria-expanded="false">
								<td>{{$loop->iteration}}</td>
								<td>{{$category->title}}</td>
								@if($category->status == 'active')
								<td class="text-success">Active</td>
								@else
								<td class="text-danger">Inactive</td>
								@endif
								<td>{{$category->alt_cat_count}}</td>
								<td>
									<a href="{{ route('admin.forum.alt.cat.create',$category->id) }}" class="btn btn-success btn-sm"> <i class="fas fa-plus"></i> Add Alt Category</a>
									<a href="{{ route('admin.forum.cat.edit',$category->id) }}" class="btn btn-primary btn-sm"> <i class="fas fa-pen"></i></a>
									<a type="button" href="{{ route('admin.forum.cat.delete', $category->id) }}" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i></a>
								</td>
							</tr>
							<tr class="expandable-body">
								<td colspan="5">
									<div>
										<table class="table table-bordered table-repsonsive">
											<thead>
												<tr>
													<th>Title</th>
													<th>Status</th>
													<th>Post Count</th>
													<th>Opr.</th>
												</tr>
											</thead>
											<tbody>
												@if($category->altCat)
												@foreach($category->altCat as $cat)
												<tr>
													<td>{{$cat->title}}</td>
													@if($cat->status == 'active')
													<td class="text-success">Active</td>
													@else
													<td class="text-danger">Inactive</td>
													@endif
													<td>0</td>
													<td>
														<a href="{{ route('admin.forum.alt.cat.edit',$cat->id) }}" class="btn btn-primary btn-sm"> <i class="fas fa-pen"></i></a>
														<a type="button" href="{{ route('admin.forum.alt.cat.delete',$cat->id) }}" class="btn btn-danger btn-sm"> <i class="fas fa-times"></i></a>
													</td>
												</tr>
												@endforeach
												@endif
											</tbody>
										</table>
									</div>	
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>
</div>
@endsection