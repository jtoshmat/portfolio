@extends("layout")

@section("content")
	
	<h2><a href="{{ URL::route("bars") }}">Bars</a> | <a href="{{ URL::to("games/".$game->bid) }}">Games</a>  | Game</h2>
	
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

	<div  class="table-responsive">
		{{ Form::model($game, array('url' => 'editgame/'.$game->gid)) }}
		<table class="table table-hover display nowrap dataTable dtr-inline">
			<tbody>

			<tr>
			<TR> <TH COLSPAN=2>Editing</TH> </TR>
			</tr>




			<tr>
				<td>Game Title: </td>
				<td>{{Form::text('title')}}</td>
			</tr>




			<tr>
			<TR> <TH COLSPAN=2 style='text-align:center'>

					{{Form::reset('Reset')}}
					{{Form::hidden('gid', $game->gid)}}
					{{ Form::submit('Update', ['name' => 'submit']) }}
				</TH> </TR>
			</tr>

			</tbody>
		</table>
		{{ Form::close() }}
	</div>
@stop