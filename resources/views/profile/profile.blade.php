@extends('layouts.dashboardmaster')
@section('content')
<div id="app">
	<index :userid="{{$userid}}" :auth="{{auth()->user()->id}}"></index>
</div>
@endsection