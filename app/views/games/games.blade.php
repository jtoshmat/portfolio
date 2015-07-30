

@extends("layout")
@section("content")

	<h2><a href="{{ URL::route("bars") }}">Bars</a> | Games</h2>

	<div  class="table-responsive">
		<table id="example" class="table table-hover display nowrap dataTable dtr-inline">
			<thead>
			<tr>
				<td>ID</td>
				<td>Game Title</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<td>ID</td>
				<td>Game Title</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
				<td>Coming soon</td>
			</tr>
			</tfoot>
			<tbody>
			@foreach($games as $game)

				<tr>
					<td>{{$game->gid}}</td>
					<td>{{$game->title}}</td>
					<td>.</td>
					<td>.</td>
					<td>.</td>
					<td>.</td>
					<td>
						<a class='btn btn-primary' href="{{ route('games/game', array('id' => $game->gid)) }}">View</a>
						<a class='btn btn-warning' href="{{ route('games/editgame', array('id' => $game->gid)) }}">Edit</a>
						<a class='btn btn-danger delete_game' id='id_{{$game->gid}}' href=#>Delete</a>


						@if ($game->totalEvents)

							<a class='btn btn-default' href="{{ route('bars/bevents', array('id' => $game->gid))
							}}">Events
								({{$game->totalEvents}})</a>

						@else
							<a class='btn btn-disabled' disabled href="#">Events (0)</a>
						@endif
						<a class='btn btn-warning' href="{{ route('bars/addbevent', array('id' => $game->gid))
						}}">Add Event</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>

@stop
