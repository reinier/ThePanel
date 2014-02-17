<?php

class BacklogController extends \BaseController {

	public function getIndex()
	{
		return Redirect::to('backlog/list');
	}

	public function getList($sort = null)
	{

		if($sort == 'votes')
		{
			$db_links = Link::backlog()->with('user', 'votes')->orderBy('vote_count','desc')->get(array('count_the_votes' => DB::raw('*, (SELECT COUNT(*) FROM votes WHERE links.id = votes.link_id) AS vote_count')));
		} else {
			$db_links = Link::backlog()->orderBy('created_at','desc')->with('user', 'votes')->get();
		}

		foreach ($db_links as $link)
		{
		    $date = new Date($link->created_at);
		    $link->date_ago = $date->ago();
		    
		    /* Move to function */
		    $link->domain = parse_url($link->url, PHP_URL_HOST);
		    if(substr($link->domain, 0, 4) == 'www.'){
		    	$link->domain = substr($link->domain, 4);
		    }


		    if($link->votes)
		    {
			    $votes = array();
			    $user_has_already_voted = FALSE;
			    foreach ($link->votes as $vote) {
			    	
			    	if($link->user->username == $vote->user->username)
			    	{
			    		$size = '48';	
			    	} else {
			    		$size = '32';
			    	}

			    	$gravatar = '<img src="http://www.gravatar.com/avatar/'.md5(strtolower(trim($vote->user->email))).'?s='.$size.'&d=identicon" title="'.$vote->user->name.' ('.$vote->user->email.')" class="img-circle">';
			    	$votes[] = $gravatar;

			    	if(Auth::user()->username == $vote->user->username)
			    	{
			    		$user_has_already_voted = TRUE;
			    	}
			    }
			}

		    $link->voted = implode(' ', $votes);
		    $link->user_has_already_voted = $user_has_already_voted;

		    $links[] = $link;
		}

		if(!empty($links)){
			return View::make('thepanel.backlog.index')->with('links',$links);
		} else {
			return View::make('thepanel.backlog.empty');
		}

	}

	public function getAdd()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			return $this->create();
		}
		
		// Default values
		$theInput['title'] = '';
		$theInput['url'] = '';
		$theInput['kind'] = '';
		$theInput['reason'] = '';

		// Input from form
		$oldInput = Input::old();

		// Input from bookmarklet
		$newInput['title'] 	= htmlspecialchars(Input::get('title'));
		$newInput['url'] 	= Input::get('url');
		
		if(!empty($newInput['title']))
		{
			$theInput['title'] = $newInput['title'];
		} elseif (!empty($oldInput['title'])) {
			$theInput['title'] = $oldInput['title'];
		}

		if(!empty($newInput['url']))
		{
			$check_link = Link::whereRaw("url LIKE '".$newInput['url']."%'")->get();
			if(!empty($check_link[0]))
			{
				$flash_error[] = 'Link already exsists';
				return Redirect::route('backlog')
				->with('error', '<ul><li>'.implode('</li><li>',$flash_error).'</li></ul>');
			}

			$theInput['url'] = $newInput['url'];
		} elseif (!empty($oldInput['url'])) {
			$theInput['url'] = $oldInput['url'];
		}

		if (!empty($oldInput['kind'])) {
			$theInput['kind'] = $oldInput['kind'];
		}

		if (!empty($oldInput['reason'])) {
			$theInput['reason'] = $oldInput['reason'];
		}
		
		return View::make('thepanel.backlog.add')->with('theInput', $theInput);
	}

	public function postVote()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			return $this->create_vote();
		}
	}

	/**************************************
	Database interaction
	**************************************/ 

	public function postAdd()
	{
		$flash_error = array();

		$link = array(
			'title' 			=> Input::get('title'),
			'url' 				=> Input::get('url'),
			'kind' 				=> Input::get('kind'),
			'reason' 			=> Input::get('reason')
		);

		if(empty($link['title'])){
			$flash_error[] = 'You have to provide a title';
		}

		if(empty($link['url'])){
			$flash_error[] = 'You have to provide a URL';
		}

		if(empty($link['kind'])){
			$flash_error[] = 'You have to provide the type of link';
		}

		if(!empty($flash_error)){
	
			return Redirect::route('backlog-add')
				->with('error', '<ul><li>'.implode('</li><li>',$flash_error).'</li></ul>')
				->withInput();
	
		} else {
			
			$newLink = new Link;
			
			$newLink->title 		= $link['title'];
			$newLink->url 			= $link['url'];
			$newLink->kind 			= $link['kind'];
			$newLink->reason 		= $link['reason'];
			$newLink->user_id		= Auth::user()->id;
			
			// Add link
			$newLink->save();

			// Add vote
			$vote = new Vote();
			$vote->user_id = Auth::user()->id;
			$newLink->votes()->save($vote);

			return Redirect::route('backlog')
				->with('status', 'Link added succesfully');
		}
	}

	public function create_vote()
	{
		$flash_error = array();

		$link_id = Input::get('link_id');
		$link = Link::where('id', '=', $link_id)->with('votes')->get();
		$link_single = $link[0];

		$user_has_already_voted = FALSE;
		

		if($link_single->votes)
	    {
		    foreach ($link_single->votes as $vote) {
		    	if(Auth::user()->id == $vote->user->id)
		    	{
		    		$user_has_already_voted = TRUE;
		    	}
		    }
		}

		if($user_has_already_voted == TRUE)
		{
			$flash_error[] = 'Je hebt al op deze link gestemd.';
		}

		if(!empty($flash_error)){
	
			return Redirect::route('backlog')
				->with('error', '<ul><li>'.implode('</li><li>',$flash_error).'</li></ul>')
				->withInput();
	
		} else {

			$vote = new Vote();
			$vote->user_id = Auth::user()->id;
			$link = Link::find($link_id);
			$vote = $link->votes()->save($vote);

			Queue::push('MagazineController@update_frontpage_cache','');

			return Redirect::route('backlog');
		}
	}
}