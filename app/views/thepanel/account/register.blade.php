@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - login
@stop

@section('header-title')
	<h1>Create new account</h1>
@stop

@section('content')
	
{{ Form::open(array('url' => '/account/register', 'class' => 'rei-form')) }}
<fieldset>
	
	<div class="form-group">
		<label for="name">Your name</label>
		<input class="form-control" type="text" name="name" placeholder="Name" value="{{ $oldInput['name'] }}">
	</div>
	
	<div class="form-group">
		<label for="email">Your email address</label>
		<input class="form-control" type="text" name="email" placeholder="Email" value="{{ $oldInput['email'] }}">
	</div>
	
	<div class="form-group">
		<label for="username">Your prefered username</label>
		<input class="form-control" type="text" name="username" placeholder="Username" value="{{ $oldInput['username'] }}">
	</div>
	
</fieldset>
<fieldset>
	
	<div class="form-group">
		<label for="password">Your prefered password</label>
		<input class="form-control" type="password" name="password" placeholder="Password">
	</div>
	
	<div class="form-group">
		<label for="password_again">Your prefered password (again)</label>
		<input class="form-control" type="password" name="password_again" placeholder="Password again">
	</div>
	
</fieldset>
<fieldset>
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<button type="submit" class="btn btn-default">Create</button>
</fieldset>
{{ Form::close() }}

@stop

