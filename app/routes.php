<?php

Route::get('/', array('as' => 'home', 'uses' => 'MagazineController@index'));
Route::get('/about', array('as' => 'about', 'uses' => 'MagazineController@about'));
Route::get('/detail/{link_id}', array('as' => 'detail', 'uses' => 'MagazineController@detail'));
Route::get('/profile/{username}', array('as' => 'profile', 'uses' => 'MagazineController@profile'));

Route::get('login', array('as' => 'login', 'uses' => 'AccountController@login'));
Route::post('login', array('before' => 'csrf', 'uses' => 'AccountController@login'));

Route::get('activate/{publichash}', array('uses' => 'AccountController@activate'));

Route::group(array('before' => 'auth'), function()
{
	Route::get('backlog/add', array('as' => 'backlog-add', 'uses' => 'BacklogController@add'));
	Route::post('backlog/add', array('uses' => 'BacklogController@create'));
	Route::post('backlog/vote', array('as' => 'backlog-vote', 'uses' => 'BacklogController@vote'));

	Route::get('backlog/{sort?}', array('as' => 'backlog', 'uses' => 'BacklogController@index'));

	Route::get('yourbookmarklet', array('as' => 'yourbookmarklet', 'uses' => 'BookmarkletController@index'));
	Route::get('thebookmarklet', array('as' => 'thebookmarklet', 'uses' => 'BookmarkletController@source'));

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