@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - bookmarklet
@stop

@section('header-title')
	<h1>Bookmarklet</h1>
@stop

@section('content')
		
	<p>Hier is jouw bookmarklet: <a href="javascript:(function()%7Bvar%20b%3Ddocument.createElement('script')%3Bb.setAttribute('src'%2C'http%3A%2F%2F{{ Config::get('bookmarklet.base_url'); }}%2Fbookmarklet%2Fsource%3Fuser%3D{{ $publichash }}')%3Bdocument.body.appendChild(b)%7D)()">{{ Config::get('bookmarklet.title'); }}</a></p>
	
@stop

