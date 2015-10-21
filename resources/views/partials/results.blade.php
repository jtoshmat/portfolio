@extends('master')
@section('content')

	<div class="panel panel-info">

		<div class="panel-body" style="padding-top:30px">
			<h2>Search Results</h2>
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr class="tr_head">

					<th>Name</th>
				</tr>
				</thead>

				<tfoot>
				<tr>
					<th>Name</th>
				</tr>
				</tfoot>

				<tbody>
				@foreach($friends as $friend)
					<tr>
						<td>
							<img src="http://placehold.it/50x50" alt="50x50" class="img-thumbnail">
							<a href="#"><h4>ID: {{ $friend->id }} {{$friend->name}}</h4></a>
							<a href="/users/friendship/{{$friend->id}}/add">Add Friend</a> |
							<a href="/users/friendship/{{$friend->id}}/delete">Delete Friend</a>  |
							<a href="/users/friendship/{{$friend->id}}/message">Send Message</a>   |
							<a href="/users/friendship/{{$friend->id}}/poke">Poke</a> </td>
					</tr>
				@endforeach
				</tbody>
			</table>


		</div>
	</div>
@stop
