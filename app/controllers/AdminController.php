<?php

class AdminController extends \BaseController {

	public function index()
	{
		return View::make('thepanel.admin.index');
	}
}