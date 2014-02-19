@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} - login
@stop

@section('header-title')
	<h1>Login</h1>
@stop

@section('content')

{{ Form::open(array('url' => '/account/login', 'class' => 'rei-form')) }}
<fieldset>
<div class="form-group">
	<label for="username">Your username</label>
	<input type="text" name="username" class="form-control" placeholder="Username" value="{{ $oldInput['username'] }}">
</div>

<div class="form-group">
	<label for="password">Your password</label>
	<input type="password" name="password" class="form-control" placeholder="Password">
</div>
<div class="checkbox">
	<label>
		<input type="checkbox" name="remember_me" value="yes"> Remember me
	</label>
</div>
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<button type="submit" class="btn btn-default">Login</button>
</fieldset>
{{ Form::close() }}

<p><small><a href="/password/remind">Help, ik ben mijn wachtwoord vergeten</a></small></p>

@stop

