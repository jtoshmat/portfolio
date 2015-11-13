<?php
/*
 * To add or edit the list of sidebar tags/items/links
 * go to Repositories/SideBarItems.php
 */
?>

<div class="col-md-3">
	<img class="img-thumbnail" alt="350x350" src="http://placehold.it/350x350">
	<br /><br />
	<div class="list-group">



		@foreach($tags as $title=>$link)
		<a class="list-group-item" href="{{ $link }}">{{ $title }}</a>
		@endforeach

		@if(Auth::check())
			<a class="list-group-item" href="/auth/logout">Logout</a>
		@endif


		@if(Auth::check())
			<h4>Friends</h4>
			@foreach($acceptedfriends as $acceptedfriend)
				<a class="list-group-item" href="/profile/{{ $acceptedfriend->id }}/view"><img src="/img/online.gif">ID: {{ $acceptedfriend->id }}  {{ $acceptedfriend->name }} </a>
			@endforeach

			<h5>Friend Requests</h5>
			@foreach($friendrequests as $friendrequest)
				<a class="list-group-item" href="#">ID: {{ $friendrequest->id }} {{ $friendrequest->name }} </a>
				<a href="/users/friendship/{{$friendrequest->id}}/accept">Accept</a>
				<a href="/users/friendship/{{$friendrequest->id}}/delete">Delete</a>
				<a href="/users/friendship/{{$friendrequest->id}}/block">Block</a>
				<a href="#">Reject</a>
			@endforeach

			<h5>Pending Friends</h5>
			@foreach($pendingfriends as $pendingfriend)
				<a class="list-group-item" href="#">ID: {{ $pendingfriend->id }} {{ $pendingfriend->name }} </a>
			@endforeach
		@endif

	</div>

</div>



