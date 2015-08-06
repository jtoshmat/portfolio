{{-- TODO: I don't think we need this. --}}
@extends("layout")

@section("content")

	<h2><a href="{{ URL::route("bars") }}">Bars</a> | <a href="{{ URL::to("games/".$game->bid) }}">Games</a>  | Game</h2>

	<div  class="table-responsive">
		<table class="table table-hover display nowrap dataTable dtr-inline">

			<tbody>
			<tr>
			<tr> <th colspan=2>Viewing</th> </tr>
			</tr>

			<tr>
				<td>Game ID: </td>
				<td>{{$game->gid}}</td>
			</tr>

			<tr>
				<td>Game Title: </td>
				<td>{{$game->title}}</td>
			</tr>



			<tr>
				<td>More: </td>
				<td>Something else</td>
			</tr>

			</tbody>
		</table>
	</div>

@stop