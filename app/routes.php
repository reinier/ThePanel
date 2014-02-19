<?php

Route::get('/', array('as' => 'home', 'uses' => 'FrontpageController@getIndex'));
Route::controller('frontpage','FrontpageController');

Route::get('login', array('as' => 'login', 'uses' => 'AccountController@login'));
Route::post('login', array('before' => 'csrf', 'uses' => 'AccountController@login'));

Route::get('activate/{publichash}', array('uses' => 'AccountController@activate'));

Route::group(array('before' => 'auth'), function()
{

	Route::controller('backlog','BacklogController');
	Route::controller('bookmarklet','BookmarkletController');

	Route::get('logout', array('as' => 'logout', 'uses' => 'AccountController@logout'));
	Route::get('account', array('as' => 'account', 'uses' => 'AccountController@show'));
	
	Route::get('edit', array('as' => 'edit', 'uses' => 'AccountController@edit'));
	Route::post('edit', array('uses' => 'AccountController@edit'));
});

Route::group(array('before' => 'admin'), function()
{
	Route::get('admin', array('as' => 'admin', 'uses' => 'AdminController@index'));
	Route::get('register', array('as' => 'register', 'uses' => 'AccountController@register'));
	Route::post('register', array('before' => 'csrf', 'uses' => 'AccountController@register'));
});

// Laravel provided 'password reset' features
Route::controller('password', 'RemindersController');