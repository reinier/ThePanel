<?php

class AccountController extends \BaseController {

	/**************************************
	View controllers
	***************************************

	Here be view controllers

	**************************************/ 
	
	function __construct() {
        $this->beforeFilter('auth', array('except' => array('getLogin','postLogin','getActivate')));
        $this->beforeFilter('admin', array('only' => array('getRegister','postRegister')));
    }

	// POST and GET
	public function getRegister()
	{
		$oldInput = Input::old();
		
		if(empty($oldInput['name'])){
			$oldInput['name'] = '';
		}
		
		if(empty($oldInput['email'])){
			$oldInput['email'] = '';
		}
		
		if(empty($oldInput['username'])){
			$oldInput['username'] = '';
		}
		
		return View::make('thepanel.account.register')->with('oldInput', $oldInput);
	}
	
	// POST and GET
	public function getLogin()
	{
		$oldInput = Input::old();
		if(empty($oldInput['username'])){
			$oldInput['username'] = '';
		}
		
		return View::make('thepanel.account.login')->with('oldInput', $oldInput);
	}
	
	public function getShow()
	{
		return View::make('thepanel.account.account');
	}
	
	// POST and GET
	public function getEdit()
	{	
		return View::make('thepanel.account.edit');
	}
	
	public function getActivate($publichash)
	{
		$userWithPublicHash = User::whereRaw('publichash = ? AND activated = 0', array($publichash))->get();
		
		if(!empty($userWithPublicHash[0])){
			
			$activateUser = $userWithPublicHash[0];
			
			$activateUser->activated = 1;
			$activateUser->save();
			
			Auth::login($activateUser);
			
			return Redirect::to('/backlog/list')->with('status', 'You are successfully logged in.');
			
		} else {
			App::abort(404, 'Page not found');
		}
	}
	
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/')->with('status', 'You are successfully logged out.');
	}
	
	/**************************************
	Class functions
	***************************************

	Here be class functions

	**************************************/ 
	
	public function postRegister()
	{
		$flash_error = array();
		
		$user = array(
			'name' 				=> Input::get('name'),
			'email' 			=> Input::get('email'),
			'username' 			=> Input::get('username'),
			'password' 			=> Input::get('password'),
			'password_again' 	=> Input::get('password_again')
		);
		
		/* Check name */
		if(empty($user['name'])){
			$flash_error[] = 'You have to provide a name';
		}
		
		/* Check email */
		if(empty($user['email'])){
			$flash_error[] = 'You have to provide an email address';
		} else {
			$userWithEmail = User::where('email',$user['email'])->get();
			if(!empty($userWithEmail[0])){
				$flash_error[] = 'There is already an account with this email address';
			}
		}
		
		/* Check username */
		if(empty($user['username'])){
			$flash_error[] = 'You have to provide a username';
		} else {
			$userWithUsername = User::where('username',$user['username'])->get();
			if(!empty($userWithUsername[0])){
				$flash_error[] = 'There is already an account with this username';
			}
		}
		
		/* Check password */
		if(empty($user['password'])){
			$flash_error[] = 'You have to provide a password';
		}
		
		if($user['password'] != $user['password_again'])
		{
			$flash_error[] = 'Your passwords do not match';	
		}
		
		/* Process errors or add data to database */
		if(!empty($flash_error)){
	
			return Redirect::to('/account/register')
				->with('error', '<ul><li>'.implode('</li><li>',$flash_error).'</li></ul>')
				->withInput();
	
		} else {
			
			$now = date('Y-m-d H:i:s');
			
			$newUser = new User;
			
			$newUser->publichash	= AccountController::generatePublicHash();
			
			$newUser->username 		= $user['username'];
			$newUser->email 		= $user['email'];
			$newUser->password 		= Hash::make($user['password']);
			$newUser->name 			= $user['name'];
			$newUser->bio 			= 'No information yet';
			$newUser->activated		= 0;
			$newUser->created_at 	= $now;
			$newUser->updated_at 	= $now;
			
			$newUser->save();

			// Mail activation link to this human being
			$data['hash'] = $newUser->publichash;
			
			Mail::send('thepanel.account.emails.activate', $data, function($message) use ($newUser)
			{
			    $message->to($newUser->email, $newUser->name)->subject('Activate your account');
			});
			
			return Redirect::to('/')
				->with('status', 'We have sent you an activation link to '.$newUser->email);
		}
	}
	
	public function postEdit()
	{
		$updateUser = User::find(Auth::user()->id);
		$updateUser->name 	= Input::get('name');
		$updateUser->bio 	= Input::get('bio');
		$updateUser->save();

		return Redirect::to('/account/edit')
				->with('status', 'Your information is succesfully saved');
	}
	
	public function postLogin()
	{
		$userInput = array(
			'username' 	=> Input::get('username'),
			'password' 	=> Input::get('password'),
			'activated' => 1
		);
		
		$remember_me = Input::get('remember_me');
		
		$remember = FALSE;
		if($remember_me == 'yes')
		{
			$remember = TRUE;
		}
		
		if (Auth::attempt($userInput,$remember)) {
			return Redirect::to('backlog/list')
				->with('status', 'You are successfully logged in.');
		}

		// Try with email address
		if (Auth::attempt(array('email' => $userInput['username'], 'password' => $userInput['password'])))
		{
		    return Redirect::to('backlog/list')
				->with('status', 'You are successfully logged in.');
		}
        
		// authentication failure! lets go back to the login page
		return Redirect::to('/account/login')
			->with('error', 'You are not logged in.')
			->withInput();
	}
	
	public function generatePublicHash()
	{
		$publichash = Str::random(16);	
		$checkPublicHash = User::where('publichash',$publichash)->get();
		
		if(!empty($checkPublicHash[0])){
			return AccountController::generatePublicHash();
		} else {
			return $publichash;
		}
	}

	/* --------------------------------------- */ 

}