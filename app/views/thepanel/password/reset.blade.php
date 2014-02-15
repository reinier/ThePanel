@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - @lang('thepanel.helpforgotpassword')
@stop

@section('header-title')
	<h1>@lang('thepanel.helpforgotpassword')</h1>
@stop

@section('content')
	
	<form action="{{ action('RemindersController@postReset') }}" method="POST">
	<fieldset>
		
		<input type="hidden" name="token" value="{{ $token }}">
		
		<div class="form-group">
			<label for="email">@lang('thepanel.youremail')</label>
			<input class="form-control" type="email" name="email">
		</div>
		
		<div class="form-group">
			<label for="password">@lang('thepanel.yournewpassword')</label>
			<input class="form-control" type="password" name="password">
		</div>
		
		<div class="form-group">
			<label for="password_confirmation">@lang('thepanel.yournewpasswordagain')</label>
			<input class="form-control" type="password" name="password_confirmation">
		</div>

	</fieldset>

	<fieldset>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-default">@lang('thepanel.resetpassword')</button>
	</fieldset>
	</form>



@stop

