<div class="col-md-3">
	<img class="img-thumbnail" alt="350x350" src="http://placehold.it/350x350">
	<br /><br />
	<div class="list-group">

		<a class="list-group-item" href="/">Home</a>

		@foreach($tags as $title=>$link)
		<a class="list-group-item" href="{{ $link }}">{{ $title }}</a>
		@endforeach

		<a class="list-group-item" href="/auth/logout">Logout</a>
	</div>
</div>
