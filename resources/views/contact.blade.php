@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Contact us</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
						<li class="breadcrumb-item active">Contact us</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-body row">
				<div class="col-md-5">
					@if (Session::has('success'))
					<div class="alert alert-success mb-3 mt-3">
						<i class="fas fa-check-circle"></i> {{ Session::get('success') }}
					</div>
					@endif
					<form action="{{ route('contact.store') }}" method="post">
						@csrf
						<div class="form-group">
							<label for="inputSubject">Subject</label>
							<input name="subject" type="text" id="inputSubject" class="form-control" value="{{ old('subject') }}"/>
							@error('subject')
							<small class="text-danger">{{ $message }}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="selectSubject">Message Type</label>
							<select name="type" id="selectSubject" class="form-control">
								<option value="" selected="">Select Type</option>
								<option value="other">Other</option>
							</select>
							@error('type')
							<small class="text-danger">{{ $message }}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="inputMessage">Message</label>
							<textarea name="message" id="inputMessage" class="form-control" rows="4">{!! old('message') !!}"</textarea>
							@error('message')
							<small class="text-danger">{{ $message }}</small>
							@enderror
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary btn-sm" value="Send message">
						</div>
					</form>
				</div>
				<div class="col-md-7">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Last Sended Messages</h3>
						</div>
						<!-- ./card-header -->
						<div class="card-body">
							<table class="table table-bordered table-hover table-responsive">
								<thead>
									<tr>
										<th style="width:20%;">Subject</th>
										<th>Type</th>
										<th>Status</th>
										<th style="width:20%;">Date</th>
										<th style="width:100%;">Message</th>
									</tr>
								</thead>
								<tbody>
									@if($messages)
									@foreach ($messages as $message)
									<tr data-widget="expandable-table" aria-expanded="false">
										<td>{{$message->subject}}</td>
										<td>{{$message->type}}</td>
										<td>
											@if($message->status == 'answered')
											<span class="badge badge-success">Answered <i class="fas fa-check"></i></span>
											@else
											<span class="badge badge-danger">Unanswered <i class="fas fa-times"></i></span>
											@endif
										</td>
										<td>{{$message->created_at->diffForHumans()}}</td>
										<td>{{ Str::limit($message->message, 20) }}</td>
									</tr>
									<tr class="expandable-body">
										<td colspan="5">
											<div class="direct-chat-msg right">
												<div class="direct-chat-infos clearfix">
													<span class="direct-chat-name float-right">Me</span>
													<span class="direct-chat-timestamp float-left">{{$message->created_at->diffForHumans()}}</span>
												</div>
												<img class="direct-chat-img" src="https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png" alt="message user image">
												<div class="direct-chat-text">
													{!!$message->message!!}
												</div>
											</div>
											@if($message->answer)
											@foreach ($message->answer as $answer)
											@if ($answer->user_id == Auth()->user()->id)
											<div class="direct-chat-msg right">
												<div class="direct-chat-infos clearfix">
													<span class="direct-chat-name float-right">Me</span>
													<span class="direct-chat-timestamp float-left">{{$answer->created_at->diffForHumans()}}</span>
												</div>
												<img class="direct-chat-img" src="https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png" alt="message user image">
												<div class="direct-chat-text">
													{!!$answer->message!!}
												</div>
											</div>	
											@else

											<div class="direct-chat-msg">
												<div class="direct-chat-infos clearfix">
													<span class="direct-chat-name float-left">Admin or Moderator</span>
													<span class="direct-chat-timestamp float-right">{{$answer->created_at->diffForHumans()}}</span>
												</div>
												<img class="direct-chat-img" src="https://i.pinimg.com/originals/51/f6/fb/51f6fb256629fc755b8870c801092942.png" alt="message user image">
												<div class="direct-chat-text">
													{!!$answer->message!!}
												</div>
											</div>
											@endif

											@endforeach
											@endif
											<div class="card-footer">
												<form action="{{ route('answer.store') }}" method="post">
													@csrf
													<div class="input-group">
														<input type="text" name="message" placeholder="Type Message ..." class="form-control form-control-sm">
														<input type="hidden" name="contact_id" value="{{$message->id}}">
														<span class="input-group-append">
															<button type="submit" class="btn btn-primary btn-sm">Send</button>
														</span>
													</div>
													@error('message')
														<small class="text-danger">{{ $message }}</small>
														@enderror
												</form>
											</div>
										</td>
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
@endsection