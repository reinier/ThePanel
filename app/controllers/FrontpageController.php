<?php

class FrontpageController extends \BaseController {

	public function __construct()
	{
		$this->theme = Config::get('site.theme');  
	}

	public function getIndex()
	{
		$links = $this->get_links_frontpage();

		if(!empty($links)){
			return View::make('themes.'.$this->theme.'.index')->with('links',$links);
		} else {
			return View::make('themes.'.$this->theme.'.empty');
		}
	}

	public function getAbout()
	{
		$all_users = User::all();
		foreach($all_users as $user)
		{
			$users[$user['id']]['name'] = $user['name'];
			$users[$user['id']]['username'] = $user['username'];
		}

		return View::make('themes.'.$this->theme.'.about')->with('users',$users);
	}

	public function getProfile($username)
	{
		$user = User::where('username', '=', $username)->take(1)->get();
		$user = $user->toArray();
		$user = $user[0];
		$user['bio'] = Markdown::string($user['bio']);
		return View::make('themes.'.$this->theme.'.profile')->with('user',$user);
	}

	public function getDetail($link_id)
	{
		$link = $this->get_link_details($link_id);

		if($link === NULL)
		{
			return Redirect::route('home')->with('error', 'Hier is geen link te vinden.');

		} else {
			return View::make('themes.'.$this->theme.'.detail')->with('link',$link);
		}
		
	}

// --------------------------------------- 

	public function update_frontpage_cache($data)
	{
		$db_links = Link::published()->with('user', 'votes')->orderBy('last_vote_date','desc')->get(array('all_the_votes' => DB::raw('*, (SELECT MAX(created_at) FROM votes WHERE links.id = votes.link_id) AS last_vote_date')));

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
			    $votes 			= array();
			    $vote_dates 	= array();
			    foreach ($link->votes as $vote) {
			    	
			    	if($link->user->username == $vote->user->username)
			    	{
			    		$size = '48';	
			    	} else {
			    		$size = '32';
			    	}

			    	$gravatar = '<img src="http://www.gravatar.com/avatar/'.md5(strtolower(trim($vote->user->email))).'?s='.$size.'&d=identicon" title="'.$vote->user->name.'" class="img-circle">';
			    	$votes[] = $gravatar;

			    	$vote_dates[] = $vote->created_at;
			    }
			}

		    $link->voted = implode(' ', $votes);

		    $max_vote_date = new Date(max($vote_dates));
		    $link->last_vote = $max_vote_date->ago();

		    $links[] = $link;
		}

		if(empty($links)){
			$links = '';
		}

		Cache::forever('links', $links);

	}

	public function get_links_frontpage()
	{
		if(!Cache::has('key'))
		{
			$this->update_frontpage_cache('');
		}
		
		$links = Cache::get('links');
		return $links;
	}

	public function get_link_details($link_id)
	{
		$link = Link::published()->with('user', 'votes')->orderBy('last_vote_date','desc')->where('links.id', '=', $link_id)->get(array('all_the_votes' => DB::raw('*, (SELECT MAX(created_at) FROM votes WHERE links.id = votes.link_id) AS last_vote_date')));

		if(empty($link[0]))
		{
			return NULL;
		} else {
			$link = $link[0];
		}

		$date = new Date($link->created_at);
	    $link->date_ago = $date->ago();
	    
	    /* Move to function */
	    $link->domain = parse_url($link->url, PHP_URL_HOST);
	    if(substr($link->domain, 0, 4) == 'www.'){
	    	$link->domain = substr($link->domain, 4);
	    }

	    if($link->votes)
	    {
		    $votes 			= array();
		    $vote_dates 	= array();
		    foreach ($link->votes as $vote) {
		    	
		    	if($link->user->username == $vote->user->username)
		    	{
		    		$size = '48';	
		    	} else {
		    		$size = '32';
		    	}

		    	$gravatar = '<img src="http://www.gravatar.com/avatar/'.md5(strtolower(trim($vote->user->email))).'?s='.$size.'&d=identicon" title="'.$vote->user->name.'" class="img-circle">';
		    	$votes[] = $gravatar;

		    	$vote_dates[] = $vote->created_at;
		    }
		}

	    $link->voted = implode(' ', $votes);

	    $max_vote_date = new Date(max($vote_dates));
	    $link->last_vote = $max_vote_date->ago();

	    return  $link;
	}

}

