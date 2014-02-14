@extends('themes.magazine.master')

@section('title')
    {{ Config::get('site.title'); }}
@stop

@section('header-title')
	
@stop

@section('content')

	<ul id="published-links" class="clearfix">
	@foreach ($links as $link)
		<li class="clearfix">
			<div class="votes">
					{{ $link->voted }}
			</div>
			<a href="{{ $link->url }}" class="the_link">{{ $link->title }}</a>
			<br />
			<span class="link-domain">{{ $link->domain }}</span> - <span class="link-date">{{ $link->last_vote }}</span><span class="link-details-link"> - <a href="/detail/{{ $link->id }}#disqus_thread">bekijk details</a></span>
		</li>
	@endforeach
	</ul>
    <script type="text/javascript">
	    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	    var disqus_shortname = '{{ Config::get("site.disqus_forum_shortname"); }}'; // required: replace example with your forum shortname

	    /* * * DON'T EDIT BELOW THIS LINE * * */
	    (function () {
	        var s = document.createElement('script'); s.async = true;
	        s.type = 'text/javascript';
	        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
	        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
	    }());
    </script>
    
@stop

