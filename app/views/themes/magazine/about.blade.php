@extends('themes.magazine.master')

@section('title')
    @lang('magazine.about', array('sitetitle' => Config::get('site.title')))
@stop

@section('header-title')
	<h1>@lang('magazine.about', array('sitetitle' => Config::get('site.title')))</h1>
@stop

@section('content')
	<!-- insert your about text here -->
	<p>This site runs on <a href="https://github.com/reinier/ThePanel">The Panel</a>, a web service to curate links with a small crowd.</p>
	<h3>@lang('magazine.contributors', array('sitetitle' => Config::get('site.title')))</h3>
	<ul class="bios">
			@foreach ($users as $user_id => $user)
				<li><a href="/frontpage/profile/{{ $user['username'] }}">{{ $user['name'] }}</a></li>
			@endforeach
	</ul>
@stop

