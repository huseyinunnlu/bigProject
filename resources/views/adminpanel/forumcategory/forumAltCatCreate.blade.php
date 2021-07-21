@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Create Alt Category</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('admin.forum.cat.index') }}">Go Back</a></li>
						<li class="breadcrumb-item active">Create Forum Alt Category</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="col-md-6 offset-md-3">
			<form action="{{ route('admin.forum.alt.cat.store',$category->id) }}" method="post">
				@csrf
				<div class="form-group">
					<label for="title">Title</label>
					<input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
					<input type="hidden" name="main_cat_id" value="{{$category->id}}">
					@error('title')
					<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<select class="form-control" name="status" id="status">
						<option value="active" selected="">Active</option>
						<option value="inactive">Inactive</option>
					</select>
				</div>
				<button type="submit" class="btn btn-success btn-sm">Create Alt Category</button>
			</form>
		</div>
	</section>
</div>
@endsection