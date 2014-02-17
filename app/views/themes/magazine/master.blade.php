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
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" type="text/css" charset="utf-8">
	<link rel="stylesheet" href="/themes/magazine/style/style.css" type="text/css" charset="utf-8">
	
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<a class="{{ Request::is('/') ? 'active' : '' }} brandname" href="/"><strong>{{ Config::get('site.title'); }}</strong></a> &nbsp;&nbsp;&nbsp; <a href="/about">Over {{ Config::get('site.title'); }}</a>
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


			<footer id="footer">
				<p>
				@if(Auth::check())
					<a href="/backlog/list">Backlog &raquo;</a>
				@endif
				@if(!Auth::check())
					<a href="/login">Login &raquo;</a>
				@endif
				</p>
			</footer>
	</div> <!-- /container -->
	

	<script src="/bower_components/jquery/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>

