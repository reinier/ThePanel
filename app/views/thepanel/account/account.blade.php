@extends('thepanel.layouts.master')

@section('title')
    Your account
@stop

@section('header-title')
	<h1>Hello {{ Auth::user()->name }}</h1>
@stop

@section('content')
		
	@if(Auth::check())
		<p><a href="/account/logout">Logout {{ Auth::user()->username }}</a></p>
	@endif
	
@stop

