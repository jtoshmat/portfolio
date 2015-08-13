@extends("layout")
@section("content")
<?php
	$barname = json_decode($barname)[0]->barname;
  $bbarid = 0;
  foreach($bevents as $bev){
  $bbarid= $bev->bbarid;
  	break;
}
?>
<div class="container edit-bar">
  <div class="page-header">
    <h2>{{$barname}}</h2>
    <p><a href="http://www.packerseverywhere.com/app/venues/{{ $bbarid }}">View on packerseverywhere.com</a></p>
  </div>
  <ul class="nav nav-pills">
    <li role="presentation"><a href="{{ route('bars/editbar', array('id' => $bbarid)) }}">Bar Info</a></li>
    <li role="presentation" class="active"><a href="{{ route('bevents/bevents', array('id' => $bbarid)) }}">Events</a></li>
  </ul>

  <div class="table-controls">
    <div class="row">
      <div class="col-xs-8 form-inline">
        <label>
          Show
          <select id="event-filter" class="form-control">
            <option value="">All</option>
            <option value="upcoming">Upcoming</option>
            <option value="past">Past</option>
          </select>
        </label>
      </div>
      <div class="col-xs-4 text-right">
      	<a href="{{ URL::route("bevents/addbevent", $bbarid) }}" class="btn btn-primary">Add New Event</a>
      </div>
    </div>
  </div>

  <table id="bevents-listing-table" class="table table-hover" cellspacing="0">
  	<thead>
    	<tr>
    		<th class="text-center">
      		<a href="#" id="delete-selected-events"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="right" title="Delete Selected Events" aria-hidden="true"></span><span class="sr-only">Delete Selected Events</span></a>
      		<input type="checkbox" class="table-toggle">
    		</th>
    		<th>Date</th>
    		<th>Time</th>
    		<th>Event Title</th>
    		<th>Matchup</th>
    		<th>Home/Away</th>
    		<th><span class="sr-only">Actions</span></th>
    	</tr>
    </thead>
    <tbody>

    @foreach($bevents as $bevent)

      <?php
        if ($bevent->beventtime) {
          $eventUnix = strtotime($bevent->beventtime);
        } else {
          $eventUnix = strtotime($bevent->ggame_time);
        }
  			$eventDate = date('m/d/Y', $eventUnix);
  			$eventTime = date('g:i A', $eventUnix);
  			$eventTimeString = date('Gi', $eventUnix);
			?>

      <tr>
        <td class="text-center">
          @if ($bevent->beventtime)
          <input type="checkbox" class="checkbox-delete" data-beventid="#">
          @endif
        </td>
	      <td data-order="{{ $eventUnix }}" data-filter="{{ $eventUnix }}">{{ $eventDate }}</td>
	      <td data-order="{{ $eventTimeString }}">{{ $eventTime }}</td>
	      <td>
  	      @if ($bevent->btitle))
  	        {{ $bevent->btitle }}
  	      @else
  	        No Event Planned
  	      @endif
	      </td>
	      <td>{{ $bevent->gmatchup }}</td>
	      <td>{{ ucfirst($bevent->glocation) }}</td>
        <td class="text-center">
        @if ($bevent->beventtime)
          <a href="{{ route('bevents/editbevent', array('id' => $bevent->bid)) }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Event Information</span></a></td>
        @else
{{-- TODO: Not sure if this is correct. URL should be going to /addbevent/BARID/GAMEID --}}
          <a href="{{ route('bevents/addbevent', array('id' => $bbarid, 'gid' => $bevent->ggid)) }}"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="bottom" title="Create an event for this game" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Create an event for this game</span></a></td>
        @endif
      </tr>
	  @endforeach

    </tbody>
  </table>

</div>
@stop
