@extends('themes.magazine.master')

@section('title')
    {{ Config::get('site.title'); }} - over
@stop

@section('header-title')
	<h1>Over {{ Config::get('site.title'); }}</h1>
@stop

@section('content')

	<p>{{ Config::get('site.title'); }} werkt als volgt:</p>
	<ol>
		<li>Een deelnemer voegt een link toe aan het (besloten) backlog</li>
		<li>Andere deelnemers kunnen de link een stem geven</li>
		<li>Bij drie stemmen komt de link publiek op de voorpagina</li>
	</ol>
	<p>Op deze manier krijg je enkel tips voor artikelen, video's, apps en meer die door meerdere mensen zijn aanbevolen.</p>
	<p>Aan {{ Config::get('site.title'); }} werken de volgende mensen mee:</p>
	<ul class="bios">
			@foreach ($users as $user_id => $user)
				<li><a href="/profile/{{ $user['username'] }}">{{ $user['name'] }}</a></li>
			@endforeach
	</ul>
@stop

