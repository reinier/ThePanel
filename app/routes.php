<?php

Route::get('/', array('as' => 'home', 'uses' => 'FrontpageController@getIndex'));

Route::controller('frontpage','FrontpageController');
Route::controller('account','AccountController');
Route::controller('password', 'RemindersController');

Route::group(array('before' => 'auth'), function()
{
	Route::controller('backlog','BacklogController');
	Route::controller('bookmarklet','BookmarkletController');
});

