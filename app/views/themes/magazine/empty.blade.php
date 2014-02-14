@extends('themes.magazine.master')

@section('title')
    {{ Config::get('site.title'); }}
@stop

@section('header-title')
	<h1>{{ Config::get('site.title'); }}</h1>
@stop

@section('content')

	<p><em>No links public yet</em></p>

@stop

