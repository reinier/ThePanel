<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    	@section('title')
			{{ Config::get('site.title'); }}
		@show
    </title>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="/thepanel_assets/style.css?v=3" type="text/css" media="screen" title="no title" charset="utf-8">
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="{{ Request::is('/') ? 'active' : '' }} navbar-brand" href="/">{{ Config::get('site.title'); }}</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						@if(Auth::check())
						<li class="{{ Request::is('backlog/*')||Request::is('backlog') ? 'active' : '' }}"><a href="/backlog">Backlog</a></li>
						@endif
					</ul>
					<ul class="nav navbar-nav navbar-right">
						@if(Auth::check())
							<li class="navbar-right"><a href="/account/logout">Log uit</a></li>
							<li class="{{ Request::is('bookmarklet') ? 'active' : '' }} navbar-right"><a href="/bookmarklet">Jouw bookmarklet</a></li>
							<li class="{{ Request::is('account/edit') ? 'active' : '' }}"><a href="/account/edit">Instellingen</a></li>
						@endif

						@if(Auth::check() && Auth::user()->role == 'admin')
							<li class="navbar-right {{ Request::is('account/register') ? 'active' : '' }}"><a href="/account/register">Nieuwe gebruiker</a></li>
						@endif
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</div>
	</nav>

	<div id="content" class="container">
		@section('header-title')
			<h1>{{ Config::get('site.title'); }}</h1>
		@show	
		
		@if (Session::has('status'))
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('status') }}
			</div>
		@endif

		@if (Session::has('error'))
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('error'); }}
			</div>
		@endif

		@yield('content')
	</div> <!-- /container -->
	
	<script src="/bower_components/jquery/dist/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>

