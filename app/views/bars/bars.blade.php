
<?php

//var_dump($bars);
//exit;
?>
@extends("layout")

@section("content")

	<a href="{{ URL::route("bars/addbar") }}">Add Bar</a><br />

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
			<?php
				$activebar = '';
				if (!$bar->active){
					$activebar = "class = 'activebar'";

				}
			?>
         <tr {{$activebar}}>
            <td>{{$bar->id}}</td>
            <td>{{$bar->barname}}</td>
            <td>{{$bar->address}}</td>
            <td>{{$bar->city}}</td>
            <td>{{$bar->zipcode}} : {{$bar->barid}}</td>
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
