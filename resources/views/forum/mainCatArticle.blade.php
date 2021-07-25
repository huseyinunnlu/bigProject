@extends('layouts.forummaster')
@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<section class="content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3>Category Name</h3>
								<div class="desc d-flex text-muted">
									<small><i class="fas fa-user"></i> {{$post->user->name}} - </small>
									<small><i class="fas fa-clock"></i> {{$post->created_at->diffForHumans()}}</small>
								</div>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="{{ route('forum.index') }}">Posts</a></li>
									<li class="breadcrumb-item">Name</li>
									
								</ol>
							</div>
						</div>
					</div><!-- /.container-fluid -->
				</section>
			</div>
		</div>
	</div>
</div>
@endsection