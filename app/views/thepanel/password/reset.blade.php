@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - forgot password
@stop

@section('header-title')
	<h1>Help, I forgot my password</h1>
@stop

@section('content')
	
	<form action="{{ action('RemindersController@postReset') }}" method="POST">
	<fieldset>
		
		<input type="hidden" name="token" value="{{ $token }}">
		
		<div class="form-group">
			<label for="email">Your email address</label>
			<input class="form-control" type="email" name="email">
		</div>
		
		<div class="form-group">
			<label for="password">Your new password</label>
			<input class="form-control" type="password" name="password">
		</div>
		
		<div class="form-group">
			<label for="password_confirmation">Your new password (again)</label>
			<input class="form-control" type="password" name="password_confirmation">
		</div>

	</fieldset>

	<fieldset>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-default">Reset password</button>
	</fieldset>
	</form>



@stop

