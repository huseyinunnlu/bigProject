@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Edit Forum Category</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('admin.forum.cat.index') }}">Go Back</a></li>
						<li class="breadcrumb-item active">Edit Forum Category</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="col-md-6 offset-md-3">
			<form action="{{ route('admin.forum.cat.update',$category->id) }}" method="post">
				@csrf
				<div class="form-group">
					<label for="title">Title</label>
					<input class="form-control" type="text" name="title" id="title" value="{{$category->title}}">
					@error('title')
					<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
				<div class="form-group">
					<label for="status">Status</label>
					<select class="form-control" name="status" id="status">
						<option @if($category->status == 'active') selected @endif value="active" selected="">Active</option>
						<option @if($category->status == 'inactive') selected @endif value="inactive">Inactive</option>
					</select>
				</div>
				<button type="submit" class="btn btn-success btn-sm">Update Category</button>
			</form>
		</div>
	</section>
</div>
@endsection