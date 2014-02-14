@extends('themes.magazine.master')

@section('title')
	{{ Config::get('site.title'); }} - profile
@stop

@section('header-title')

@stop

@section('content')
<div id="profile">
	<h3>{{ $user['name'] }}</h3>
	<div class="profile-bio">
	{{ $user['bio'] }}
	</div>
</div>
@stop

