@extends("layout")
@section("content")

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
    <li role="presentation"><a href="{{ route('bars/editbar', array('id' => '#')) }}">Bar Info</a></li>
    <li role="presentation" class="active"><a href="{{ route('bars/bevents', array('id' => '#')) }}">Events</a></li>
  </ul>

  <div class="table-controls">
    <div class="row">
      <div class="col-xs-6">
        {{-- TODO: These links don't work yet. --}}
        <p>Show: <a href="#">Upcoming</a> | <a href="#">Past</a></p>
      </div>
      <div class="col-xs-6 text-right">
      	<a href="{{ URL::route("bars/addbevent") }}"" class="btn btn-primary">Add New Event</a>
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
    		<th>Event Title</th>
    		<th>Matcup</th>
    		<th><span class="sr-only">Actions</span></th>
    	</tr>
    </thead>
    <tbody>

      {{-- Event created, not related to game. --}}
      <tr>
        <td class="text-center"><input type="checkbox" class="checkbox-delete" data-beventid="#"></td>
        <td>12/31/15</td>
        <td>New Year's Eve</td>
        <td>N/A</td>
        <td class="text-center"><a href="#"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Event Information</span></a></td>
      </tr>

      {{-- Event created, related to game. --}}
      <tr>
        <td class="text-center"><input type="checkbox" class="checkbox-delete" data-beventid="#"></td>
        <td>1/1/16</td>
        <td>New Year's Day Party</td>
        <td>vs DetroitA</td>
        <td class="text-center"><a href="#"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Event Information</span></a></td>
      </tr>

      {{-- Game, with no related event created. --}}
      <tr>
        <td class="text-center"></td>
        <td>1/14/16</td>
        <td>No Event Planned</td>
        <td>vs Denver</td>
        <td class="text-center"><a href="#"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="bottom" title="Add Event" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Add Event</span></a></td>
      </tr>

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

