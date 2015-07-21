
<?php

//var_dump($bars);
//exit;
?>
@extends("layout")

@section("content")
 

<div  class="table-responsive">
  <table id="example" class="table table-hover display nowrap dataTable dtr-inline">
  	<thead>
  	<tr>
  		<td>ID</td>
  		<td>Promo</td>
  		<td>Address</td>
  		<td>City</td>
  		<td>Zip Code</td>
  		<td>Created</td>
  		<td>Action</td>
  	</tr>
  </thead>
  <tfoot>
  	<tr>
  		<td>ID</td>
  		<td>Promo</td>
  		<td>Address</td>
  		<td>City</td>
  		<td>Zip Code</td>
  		<td>Created</td>
  		<td>Action</td>
  	</tr>
  </tfoot>
  <tbody>
        @foreach($bars as $bar)
         <tr>
            <td>{{$bar->id}}</td>
            <td>{{$bar->promo}}</td>
            <td>{{$bar->address}}</td>
            <td>{{$bar->city}}</td>
            <td>{{$bar->zipCode}} : {{$bar->barid}}</td>
            <td>{{$bar->bid}}</td>
            <td>
            	<a class='btn btn-primary' href="{{ route('bars/bar', array('id' => $bar->id)) }}">View</a>
            	<a class='btn btn-warning' href="{{ route('bars/editbar', array('id' => $bar->id)) }}">Edit</a>
            	<a class='btn btn-danger delete_bar' id='id_{{$bar->id}}' href=#>Delete</a>
              @if ($bar->bid)
              <a class='btn btn-default' href="{{ route('bars/bevents', array('id' => $bar->id)) }}">Events</a>
              @else
              <a class='btn btn-disabled' disabled href="#">Events</a>
              @endif
            </td>
         </tr>
    @endforeach
    </tbody>
  </table>
</div>

@stop
