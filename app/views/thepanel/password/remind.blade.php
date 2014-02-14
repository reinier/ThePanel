@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - forgot password
@stop

@section('header-title')
	<h1>Help, I forgot my password</h1>
@stop

@section('content')
	
	<form action="{{ action('RemindersController@postRemind') }}" method="POST">
	<fieldset>
		<div class="form-group">
			<label for="email">Your email address</label>
			<input class="form-control" type="text" name="email" placeholder="Email" value="">
		</div>
	</fieldset>

	<fieldset>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-default">Let me create a new password</button>
	</fieldset>
	</form>


@stop

