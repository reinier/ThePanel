@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} voeg link to
@stop

@section('header-title')
	<h1>Voeg link toe</h1>
@stop

@section('content')
	{{ Form::open(array('url' => '/backlog/add', 'class' => 'rei-form')) }}
	<fieldset>
		
		<div class="form-group">
			<label for="title">Link title</label>
			<input class="form-control" type="text" name="title" placeholder="Title" value="{{ $theInput['title'] }}">
		</div>
		
		<div class="form-group">
			<label for="url">Link url</label>
			<input class="form-control" type="text" name="url" placeholder="URL" value="{{ $theInput['url'] }}">
		</div>
		
	</fieldset>

	<fieldset>
		De reden waarom iemand <select name="kind">
			<option value="thing">deze link moet bezoeken</option>
			<option value="video">deze video moet zien</option>
			<option value="article">dit artikel moet lezen</option>
			<option value="app">deze app moet proberen</option>
			<option value="song">dit liedje moet beluisteren</option>
			<option value="podcast">deze podcast moet beluisteren</option>
		</select> <small>(optioneel)</small>:<br />
		<textarea id="the-why" name="reason"></textarea>
	</fieldset>

	<fieldset>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-default">Add</button>
	</fieldset>
	{{ Form::close() }}
@stop

