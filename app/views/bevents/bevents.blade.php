@extends("layout")
@section("content")
<?php
$barname = json_decode($barname)[0]->barname;
$bartimezone = json_decode($bartimezone)[0]->timezone;
?>

<div class="container edit-bar">
  <div class="page-header tabbed-header">
    <h2>{{$barname}}
      <small><a href="http://www.packerseverywhere.com/app/venues/{{ $barid }}" target="_blank"><span class="glyphicon glyphicon-new-window" data-toggle="tooltip" data-placement="top" title="View this bar on PackersEverywhere.com" aria-hidden="true"></span><span class="sr-only">View this bar on PackersEverywhere.com</a></small>
    </h2>
    <ul class="nav nav-tabs">
      <li role="presentation"><a href="{{ route('bars/editbar', array('id' => $barid)) }}">Bar Info</a></li>
      <li role="presentation" class="active"><a href="{{ route('bevents/bevents', array('id' => $barid)) }}">Events</a></li>
    </ul>
  </div>


  <div class="table-controls">
    <div class="row">
      <div class="col-xs-8 form-inline">
        <label>
          Show
          <select id="event-filter" class="form-control">
            <option value="">All</option>
            <option value="upcoming" selected>Upcoming</option>
            <option value="past">Past</option>
          </select>
        </label>
      </div>
      <div class="col-xs-4 text-right">
      	<a href="{{ URL::route("bevents/addbevent", $barid) }}" class="btn btn-primary">Add New Event</a>
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
    		<th>Time
      		<span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Times listed are in the {{ str_replace('_', ' ', $bartimezone) }} timezone." aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Times listed are in the {{ str_replace('_', ' ', $bartimezone) }} timezone.</span>
    		</th>
    		<th>Event Title</th>
    		<th>Matchup</th>
    		<th>Home/Away</th>
    		<th><span class="sr-only">Actions</span></th>
    	</tr>
    </thead>
    <tbody>


    @foreach($bevents[2] as $bevent)
	    @if ($bevent->bgid==0)
		    <?php
		    $tz = new DateTimeZone($bartimezone);
		    if ($bevent->beventtime) {
			    $dateTime = new DateTime($bevent->beventtime, $tz);
		    } else {
			    $dateTime = new DateTime($bevent->ggame_time, new DateTimeZone('US/Central'));
		    }
		    $dateTime->setTimeZone($tz);
		    $eventUnix = $dateTime->getTimestamp();
		    $eventDate = $dateTime->format('m/d/Y');
		    $eventTime = $dateTime->format('g:i A');
		    $eventTimeString = $dateTime->format('Gi');
		    ?>

		    <tr>
			    <td class="text-center">
				    @if ($bevent->beventtime)
					    <input type="checkbox" class="checkbox-delete" data-eventid="{{ $bevent->bid }}">
				    @endif
			    </td>
			    <td data-order="{{ $eventUnix }}" data-filter="{{ $eventUnix }}">{{ $eventDate }}</td>
			    <td data-order="{{ $eventTimeString }}">{{ $eventTime }}</td>

			    @if ($bevent->btitle)
				    <td>{{ $bevent->btitle }}</td>
			    @else
				    <td class="text-muted">No Event Planned</td>
			    @endif

			    @if ($bevent->gmatchup)
				    <td>N/A</td>
			    @else
				    <td class="text-muted">N/A</td>
			    @endif

			    @if ($bevent->glocation)
				    <td>N/A</td>
			    @else
				    <td class="text-muted">N/A</td>
			    @endif

			    <td class="text-center">
				    @if ($bevent->beventtime)
					    <a href="{{ route('bevents/editbevent', array('barid' => $barid, 'bid' => $bevent->bid)) }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Event Information</span></a></td>
			    @else
				    <a href="{{ url('addbevent/'.$barid."?gid=".$bevent->ggid) }}"><span class="glyphicon glyphicon-plus" data-toggle="tooltip"
				                                                                         data-placement="bottom" title="Create an event for this game" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Create an event for this game</span></a></td>
			    @endif
		    </tr>
	    @endif
    @endforeach


    @foreach($bevents[1] as $bevent)

      <?php
        $tz = new DateTimeZone($bartimezone);
        $gametime = $bevent->ggame_time ? new DateTime($bevent->ggame_time, new DateTimeZone('US/Central')) : null;
        if ($bevent->beventtime) {
          $dateTime = new DateTime($bevent->beventtime, $tz);
        } else {
          $dateTime = $gametime;
        }
        $dateTime->setTimeZone($tz);
        $eventUnix = $dateTime->getTimestamp();
  			$eventDate = $dateTime->format('m/d/Y');
  			$eventTime = $dateTime->format('g:i A');
  			$eventTimeString = $dateTime->format('Gi');
			?>

      <tr data-gameid="{{ $bevent->ggid }}" data-barid="{{ $barid }}">
        <td class="text-center">
          @if ($bevent->beventtime)
          <input type="checkbox" class="checkbox-delete" data-eventid="{{ $bevent->bid }}"<?php
  	       if (isset($bevent->gmatchup) && isset($bevent->btitle)) {
    	        echo(' data-gamedate="'.$gametime->setTimeZone($tz)->format('m/d/Y').'"');
    	        echo(' data-gametime="'.$gametime->setTimeZone($tz)->format('g:i A').'"');
    	        echo(' data-gameunix="'.$gametime->setTimeZone($tz)->getTimestamp().'"');
    	        echo(' data-timestring="'.$gametime->setTimeZone($tz)->format('Gi').'"');
  	       }
        ?>>
          @endif
        </td>

	      <td data-order="{{ $eventUnix }}" data-filter="{{ $eventUnix }}">{{ $eventDate }}</td>

	      <td data-order="{{ $eventTimeString }}">{{ $eventTime }}</td>

	      @if ($bevent->btitle)
	      <td>{{ $bevent->btitle }}</td>
	      @else
	      <td class="text-muted">No Event Planned</td>
	      @endif

	      @if ($bevent->gmatchup)
	      <td>{{ $bevent->gmatchup }}</td>
	      @else
	      <td class="text-muted">N/A</td>
	      @endif

	      @if ($bevent->glocation)
	      <td>{{ ucfirst($bevent->glocation) }}</td>
	      @else
	      <td class="text-muted">N/A</td>
	      @endif

        <td class="text-center">
        @if ($bevent->beventtime)
          <a href="{{ route('bevents/editbevent', array('id' => $bevent->bid)) }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Event Information</span></a></td>
        @else
        <a href="{{ url('addbevent/'.$barid."?gid=".$bevent->ggid) }}"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="bottom" title="Create an event for this game" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Create an event for this game</span></a></td>
        @endif
      </tr>
	  @endforeach

    </tbody>
  </table>

</div>
@stop
