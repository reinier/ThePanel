@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }}
@stop

@section('header-title')
    <h1>Page not found</h1>
@stop

@section('content')
	<p>404 error</p>
@stop

