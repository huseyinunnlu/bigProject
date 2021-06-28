@extends('layouts.dashboardmaster')
@section('content')
<div class="content-wrapper" id="app">
	<router-view :userid="{{auth()->user()->id}}"></router-view>
	{{--<animals-list :userid="{{auth()->user()->id}}"></animals-list>--}}
</div>
@endsection