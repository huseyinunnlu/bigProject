@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper" id="app">
	<ration-create :userid="{{auth()->user()->id}}"></ration-create>
</div>
@endsection