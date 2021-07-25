@extends('layouts.forummaster')
@section('content')
<div class="content-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if (session('message'))
				<div class="alert alert-success">
					{{ session('message') }}
				</div>
				@endif
				<div class="col-md-9">
					<div class="header-titles d-flex justify-content-between mt-3 mb-3">
						<div class="title">
							<h3>Forum</h3>
						</div>
						<div class="buttons">
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPost"><i class="fas fa-plus"></i> New Post</button>
						</div>
					</div>
					<div id="app">
						<posts :userid="{{auth()->user()->id}}"/>
						</div>
						<section>
							<div id="accordion">
								@if($catPosts)
								@foreach($catPosts as $catPost)
								<div class="card card-primary">
									<div class="card-header">
										<h4 class="card-title w-100">
											<a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
												{{$catPost->title}}
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="collapse show" data-parent="#accordion">
										<div class="card-body p-0 m-0">
											<ul class="list-group">
												@if(count($catPost->altcat) != 0)
												@foreach($catPost->altcat as $altcat)
												<li class="list-group-item d-flex justify-content-between pt-1 pb-1 pl-3 pr-3">
													<div class="title">
														<span style="position: relative; top: 12px; font-size: 105%;">
															<a href="#" class="text-default">{{$altcat->title}}</a>
														</span>
													</div>
													<div class="desc d-flex">
														<div class="message-count mr-5">
															<span class="text-primary">Posts</span><br>
															<h5 class="text-center">{{$catPost->post_count_count}}</h5>
														</div>
														<div class="last-post d-flex justify-content-between">
															@if(!empty($altcat->lastpost))
															<div>
																<img
																@if($altcat->lastpost->postcontent->user->desc)
																src="{{ asset($altcat->lastpost->postcontent->user->desc->image) }}"
																@else
																src="{{ asset('https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png') }}"
																@endif
																style="width: 45px; height: 45px;" class="rounded-circle mr-2">
															</div>
															<div>
																<span>
																	<a href="{{ route('forum.post.article',[$altcat->lastpost->postcontent->slug,$altcat->lastpost->postcontent->id]) }}">{{Str::limit($altcat->lastpost->postcontent->title,20)}}</a><br>
																	{{$altcat->lastpost->postcontent->created_at->diffForHumans()}} -
																	<a href="{{ route('profile',[$altcat->lastpost->postcontent->user->id,$altcat->lastpost->postcontent->user->slug]) }}">{{Str::limit($altcat->lastpost->postcontent->user->name,15)}}</a>
																</span>
															</div>
															@else
															<div>
																<img src="{{ asset('https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png') }}"  style="width: 45px; height: 45px;" class="rounded-circle mr-2">
															</div>
															<div class="mr-5">
																<span class="mr-2">
																	No Post<br>	
																	No Time - No Post
																</span>
															</div>
															@endif
														</div>
													</div>
												</li>
												@endforeach
												@else
												<h4 class="text-center m-3">No Alt Category</h4>	
												@endif							
											</ul>
										</div>
									</div>
								</div>
								@endforeach
								@endif
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="addPost">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create Post</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<form method="post" action="{{ route('forum.storePost') }}">
								@csrf
								<div class="form-group row">
									<input type="text" name="title" placeholder="Your questions or informations or other thinks..." class="form-control">
									@error('title')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
								<div class="form-group row">
									<label for="mainCat">Category</label><br>
									<select class="form-control select2" style="width:100%;" name="category">
										@foreach($categories as $category)
										@foreach ($category->altcat as $altcat)
										<option value="{{$category->id}},{{$altcat->id}}">{{$category->title}} / {{$altcat->title}}</option>
										@endforeach
										@endforeach
									</select>
									@error('category')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
								<div class="form-group">
									<textarea name="content"></textarea>
									@error('content')
									<small class="text-danger">{{$message}}</small>
									@enderror
								</div>
								<button class="btn btn-success">Create Post</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ mix('js/app.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

	<script>

		$('.select2').select2({
			theme: 'bootstrap4'
		})
		CKEDITOR.replace( 'content' );
	</script>
	@endsection