@extends('thepanel.layouts.master')

@section('title')
    {{ Config::get('site.title'); }} backlog
@stop

@section('header-title')
	
@stop

@section('content')
	<p class="add-to-backlog"><a href="/backlog/add">+ @lang('thepanel.addlink')</a></p>
	<p class="sort-backlog">
		<em>@lang('thepanel.sortby'):</em> 
		@if(Request::is('backlog/list/votes'))
			{{ trans('thepanel.votes') }} | <a href="/backlog/list">{{ trans('thepanel.incoming') }}</a>
		@else
			<a href="/backlog/list/votes">{{ trans('thepanel.votes') }}</a> | {{ trans('thepanel.incoming') }}
		@endif
		
	</p>
	
	<table class="table table-striped backlog">
		<thead>
			<tr>
				<td class="links">
					<strong>Link</strong>
				</td>
				<td colspan="2">
					<strong>Votes</strong>
				</td>
			</tr>
		</thead>
		<tbody>

			@foreach ($links as $link)

				<tr data-votes="{{ $link->vote_count }}">
					
					<td class="link-cell">
						<a href="{{ $link->url }}">{{ $link->title }}</a><br /><small>{{ $link->domain }} | <span title="Added by {{ $link->user->name }}" class="link-date">{{ $link->date_ago }}</span></small>
						@if(!empty($link->reason))
						<p class="reason"><em>{{ $link->reason }}</em></p>
						@endif
					</td>
					<td>{{ $link->voted }}</td>
					<td class="vote-cell">
						{{ Form::open(array('url' => '/backlog/vote')) }}
						<input type="hidden" name="link_id" value="{{ $link->id }}">
						@if ($link->user_has_already_voted == TRUE)
							<!-- <button type="submit" class="btn btn-default" disabled="disabled">Voted</button> -->
						@else
							<button type="submit" class="btn btn-success">+1</button>
						@endif
						
						{{ Form::close() }}
					</td>
				</tr>
			@endforeach

			
		</tbody>
	</table>

@stop

