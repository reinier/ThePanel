@extends('themes.magazine.master')

@section('title')
    @lang('magazine.about', array('sitetitle' => Config::get('site.title')))
@stop

@section('header-title')
	<h1>@lang('magazine.about', array('sitetitle' => Config::get('site.title')))</h1>
@stop

@section('content')

	<h3>@lang('magazine.contributors', array('sitetitle' => Config::get('site.title')))</h3>
	<ul class="bios">
			@foreach ($users as $user_id => $user)
				<li><a href="/profile/{{ $user['username'] }}">{{ $user['name'] }}</a></li>
			@endforeach
	</ul>
@stop

