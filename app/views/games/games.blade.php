@extends("layout")
@section("content")
<div class="container">
  <div class="page-header">
    <h2>Season Schedule</h2>
  </div>

  <div class="table-controls">
    <div class="row">
      <div class="col-xs-6">
        {{-- TODO: These buttons don't work yet. --}}
        Show
        <button id="show-upcoming-games" class="btn btn-default active">Upcoming</button>
        <button href="#" id="show-past-games" class="btn btn-default">Past</button>
      </div>
      <div class="col-xs-6 text-right">
      	<a href="{{ URL::route("games/addgame",array('bid'=>1)) }}" class="btn btn-primary">Add Game</a>
      </div>
    </div>
  </div>

  <div class="table-responsive">
  	<table id="games-listing-table" class="table table-hover" cellspacing="0">
  		<thead>
  			<tr>
    			<th class="text-center">
        		<a href="#" id="delete-selected-events"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="right" title="Delete Selected Events" aria-hidden="true"></span><span class="sr-only">Delete Selected Events</span></a>
        		<input type="checkbox" class="table-toggle">
      		</th>
  				<th>Date</th>
  				<th>Time</th>
  				<th>Matchup</th>
          <th>Home/Away</th>
  				<th>TV</th>
  				<th>Notes</th>
  				<th><span class="sr-only">Actions</span></th>
  				<th>(hidden sorting column)</th>
  			</tr>
  		</thead>
  		<tbody>
  		@foreach ($games as $game)
  			<?php
        $gameUnix = strtotime($game->game_time);
  			$gameDate = date('m/d/Y', $gameUnix);
  			$gameTime = date('h:i:s A', $gameUnix);
  			?>
        <tr>
          <td class="text-center"><input type="checkbox" class="checkbox-delete" data-gid="{{ $game->gid }}"></td>
          <td><a href="/editgame/{{$game->gid}}">{{$gameDate}}</a></td>
          <td>{{ $gameTime }}</td>
          <td>{{ $game->matchup }}</td>
          <td>{{ ucfirst($game->location) }}</td>
          <td>{{ $game->tv }}</td>
          <td>{{ $game->description }}</td>
          <td class="text-center"><a href="/editgame/{{$game->gid}}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip"
           data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Game Information</span></a></td>
           <td>{{ $gameUnix }}</td>
        </tr>
  			@endforeach
  		</tbody>
  	</table>
	</div>
</div>
@stop
