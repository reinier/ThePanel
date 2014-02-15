@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - {{ Lang::get('thepanel.helpforgotpassword') }}
@stop

@section('header-title')
	<h1>{{ Lang::get('thepanel.helpforgotpassword') }}</h1>
@stop

@section('content')
	
	<form action="{{ action('RemindersController@postReset') }}" method="POST">
	<fieldset>
		
		<input type="hidden" name="token" value="{{ $token }}">
		
		<div class="form-group">
			<label for="email">{{ Lang::get('thepanel.youremail') }}</label>
			<input class="form-control" type="email" name="email">
		</div>
		
		<div class="form-group">
			<label for="password">{{ Lang::get('thepanel.yournewpassword') }}</label>
			<input class="form-control" type="password" name="password">
		</div>
		
		<div class="form-group">
			<label for="password_confirmation">{{ Lang::get('thepanel.yournewpasswordagain') }}</label>
			<input class="form-control" type="password" name="password_confirmation">
		</div>

	</fieldset>

	<fieldset>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-default">{{ Lang::get('thepanel.resetpassword') }}</button>
	</fieldset>
	</form>



@stop

