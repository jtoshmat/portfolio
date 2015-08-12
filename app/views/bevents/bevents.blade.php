@extends("layout")
@section("content")




	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

<?php
$bid = 0;
foreach($bevents as $bev){
	$bid = $bev->barid;
	break;
}
?>
<div class="container edit-bar">
  <div class="page-header">
    <h2>Bar name needs to go here</h2>
    {{-- TODO: these need bar names and ID numbers. --}}
    <p><a href="http://www.packerseverywhere.com/app/venues/#">View on packerseverywhere.com</a></p>
  </div>
  <ul class="nav nav-pills">
    <li role="presentation"><a href="{{ route('bevents/editbevent', $barid) }}">Bar Info</a></li>
    <li role="presentation" class="active"><a href="{{ route('bevents/bevents', $barid) }}">Events</a></li>
  </ul>

  <div class="table-controls">
    <div class="row">
      <div class="col-xs-6">
        {{-- TODO: These buttons don't work yet. --}}
        Show
        <button id="show-upcoming-events" class="btn btn-default active">Upcoming</button>
        <button href="#" id="show-past-events" class="btn btn-default">Past</button>
      </div>
      <div class="col-xs-6 text-right">
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
    		<th>Time</th>
    		<th>Event Title</th>
    		<th>Matchup</th>
    		<th>Home/Away</th>
    		<th><span class="sr-only">Actions</span></th>
    		<th>(hidden sorting column)</th>
    	</tr>
    </thead>
    <tbody>

    @foreach($bevents as $bevent)
      {{-- Event created, not related to game. --}}
      @if ($bevent->gid===0)
      <tr>
        <td class="text-center"><input type="checkbox" class="checkbox-delete" data-beventid="#"></td>
        <td>12/31/15</td>
        <td>12:00 AM{{-- Time of the event. --}}</td>
        <td>{{$bevent->title}}</td>
        <td>N/A</td>
        <td>N/A</td>
        <td class="text-center"><a href="#"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Event Information</span></a></td>
        <td>(unix time goes here)</td>
      </tr>
	 @endif
      {{-- Event created, related to game. --}}
      @if ($bevent->gid>0)
      <tr>
        <td class="text-center"><input type="checkbox" class="checkbox-delete" data-beventid="#"></td>
        <td>1/1/16</td>
        <td>12:00 AM {{-- Time of the event. --}}</td>
        <td>{{$bevent->title}}</td>
        <td>Detroit</td>
        <td>Away</td>
        <td class="text-center"><a href="#"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Event Information</span></a></td>
        <td>(unix time goes here)</td>
      </tr>
	  @endif

      {{-- Game, with no related event created. --}}

	  @endforeach

    </tbody>
  </table>

</div>
{{-- Old stuff here only for reference

	<h2><a href="{{ URL::route("bars") }}">Bars</a> | <a href="{{ URL::to("games/81") }}">Games</a>  | Events</h2>

 <a href="{{ URL::route("bars/addbevent") }}">Add new Event</a>
<br />

<div  class="table-responsive">
  <table id="example" class="table table-hover display nowrap dataTable dtr-inline">
  	<thead>
  	<tr>
  		<td>ID</td>
  		<td>Bar ID</td>
  		<td>Title</td>
  		<td>Created</td>
  		<td>Modified</td>
  		<td>Action</td>
  	</tr>
  </thead>
  <tfoot>
  	<tr>
  		<td>ID</td>
  		<td>Bar ID</td>
  		<td>Title</td>
  		<td>Created</td>
  		<td>Modified</td>
  		<td>Action</td>
  	</tr>
  </tfoot>
  <tbody>


        @foreach($bevents as $bev)
         <tr>
            <td>{{$bev->bid}}</td>
            <td>{{$bev->barid}}</td>
            <td>{{$bev->title}}</td>
            <td>{{$bev->created_at}}</td>
            <td>{{$bev->updated_at}}</td>
            <td>
            	<a class='btn btn-primary' href="{{ route('bars/bevent', array('id' => $bev->bid)) }}">View</a>
            	<a class='btn btn-warning' href="{{ route('bars/editbevent', array('id' => $bev->bid)) }}">Edit</a>
	            <a class='btn btn-warning' href="{{ route('bars/addbevent', array('id' => $gid))}}">Add Event</a>
            	<a class='btn btn-danger delete_bevent' id='id_{{$bev->bid}}' href=#>Delete</a>
            </td>
         </tr>
    @endforeach
    </tbody>
  </table>
</div>
--}}
@stop

