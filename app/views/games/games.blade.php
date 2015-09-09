@extends("layout")
@section("content")
<div class="container">
  <div class="page-header">
    <h2>Season Schedule</h2>
  </div>

  <div class="table-controls">
    <div class="row">
      <div class="col-xs-8 form-inline">
        <label>
          Show
          <select id="game-filter" class="form-control">
            <option value="">All</option>
            <option value="upcoming" selected>Upcoming</option>
            <option value="past">Past</option>
          </select>
        </label>
      </div>
      @if ($admin)
      <div class="col-xs-4 text-right">
      	<a href="{{ URL::route("games/addgame",array('bid'=>1)) }}" class="btn btn-primary">Add Game</a>
      </div>
      @endif
    </div>
  </div>

  <div class="table-responsive loading">
  	<table id="games-listing-table" class="table table-hover" cellspacing="0">
  		<thead>
  			<tr>
    			<th class="text-center">
      			@if ($admin)
        		<a href="#" id="delete-selected-games"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="right" title="Delete Selected Games" aria-hidden="true"></span><span class="sr-only">Delete Selected Games</span></a>
        		<input type="checkbox" class="table-toggle">
	      		@endif
      		</th>
  				<th>Date</th>
  				<th>Time
    				<span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Times listed are in the US/Central timezone." aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Times listed are in the US/Central timezone.</span>
  				</th>
  				<th>Matchup</th>
          <th>Home/Away</th>
  				<th>TV</th>
  				<th>Notes</th>
  				<th>
    				@if ($admin)
    				<span class="sr-only">Actions</span>
    				@endif
  				</th>
  			</tr>
  		</thead>
  		<tbody>
  		@foreach ($games as $game)
  			<?php
  			$dateTime = new DateTime($game->game_time, new DateTimeZone('US/Central'));
        $gameUnix = $dateTime->getTimestamp();
  			$gameDate = $dateTime->format('m/d/Y');
  			$gameTime = $dateTime->format('g:i A');
  			$gameTimeString = $dateTime->format('Gi');
  			?>
        <tr>
          <td class="text-center">
            @if ($admin)
            <input type="checkbox" class="checkbox-delete" data-gid="{{ $game->gid }}">
            @endif
          </td>
          <td data-order="{{ $gameUnix }}" data-filter="{{ $gameUnix }}">
            @if ($admin)
            <a href="/editgame/{{$game->gid}}">{{ $gameDate }}</a>
            @else
            {{ $gameDate }}
            @endif
          </td>
          <td data-order="{{ $gameTimeString }}">{{ $gameTime }}</td>
          <td>{{ $game->matchup }}</td>
          <td>{{ ucfirst($game->location) }}</td>
          <td>{{ $game->tv }}</td>
          <td>{{ $game->description }}</td>
          <td class="text-center">
            @if ($admin)
            <a href="/editgame/{{$game->gid}}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip"
           data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Game Information</span></a>
           @endif
         </td>
        </tr>
  			@endforeach
  		</tbody>
  	</table>
	</div>
</div>
@stop
