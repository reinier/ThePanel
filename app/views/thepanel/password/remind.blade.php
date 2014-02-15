@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - @lang('thepanel.helpforgotpassword')
@stop

@section('header-title')
	<h1>@lang('thepanel.helpforgotpassword')</h1>
@stop

@section('content')
	<form action="{{ action('RemindersController@postRemind') }}" method="POST">
	<fieldset>
		<div class="form-group">
			<label for="email">@lang('thepanel.youremail')</label>
			<input class="form-control" type="text" name="email" placeholder="Email" value="">
		</div>
	</fieldset>

	<fieldset>
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-default">@lang('thepanel.yescreatenewpassword')</button>
	</fieldset>
	</form>
@stop

