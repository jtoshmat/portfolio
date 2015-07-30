


@extends("layout")

@section("content")

<?php
$bid = 0;
foreach($bevents as $bev){
	$bid = $bev->barid;
	break;
}
?>
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

@stop

