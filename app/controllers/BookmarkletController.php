<?php

class BookmarkletController extends \BaseController {

	public function getIndex()
	{
		$publichash = Auth::user()->publichash;
		return View::make('thepanel.bookmarklet.index')->with('publichash',$publichash);
	}

	public function getSource()
	{
		$userhash	= Input::get('user');
		return View::make('thepanel.bookmarklet.source')->with('user',$userhash);
	}

}