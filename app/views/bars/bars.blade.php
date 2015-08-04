
@extends("layout")

@section("content")
<div class="container">
  <div class="table-controls">
  	<a href="{{ URL::route("bars/addbar") }}" class="btn btn-primary">Add Bar</a>
  </div>

  <table id="bars-listing-table" class="table table-striped table-hover table-bordered'" cellspacing="0" width="100%">
  	<thead>
    	<tr>
    		<th class="text-center">
      		<a href="#" id="delete-selected-bars"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="right" title="Delete Selected Bars" aria-hidden="true"></span><span class="sr-only">Delete Selected Bars</span></a>
      		<input type="checkbox" class="table-toggle">
    		</th>
    		<th>Bar Name</th>
    		<th>City</th>
    		<th>State</th>
    		<th>Telephone</th>
    		<th>Website</th>
    		<th><span class="sr-only">Actions</span></th>
    	</tr>
    </thead>
    <tbody>
    @foreach($bars as $bar)
			<?php
				$activebar = '';
				if ($bar->active) {
					$activebar = 'bar-active';
				} else {
  				$activebar = 'bar-inactive';
				}
			$bar->totalGames = isset($bar->totalGames)?$bar->totalGames:0;
			?>
      <tr class="{{$activebar}}">
        <td class="text-center"><input type="checkbox" class="checkbox-delete" data-barid="{{ $bar->id }}"></td>
        <td><a href="{{ route('bars/editbar', array('id' => $bar->id)) }}" data-toggle="tooltip" data-placement="bottom" title="Edit">{{ $bar->barname }}</a></td>
        <td>{{ $bar->city }}</td>
        <td>{{ $bar->state }}</td>
        <td>{{ $bar->phone }}</td>
        <td>{{ $bar->website }}</td>
        <td>
          @if ($bar->approved===1)
          {{-- TODO: these "approve", "reject" buttons don't work yet --}}
          <a href="{{ route('bars/bevents', array('id' => $bar->id)) }}"><span class="glyphicon glyphicon-calendar" data-toggle="tooltip" data-placement="bottom" title="Events" aria-hidden="true"></span><span class="sr-only">Edit Events</span></a>
          @else
          <a href="#"><span class="glyphicon glyphicon-ok" data-toggle="tooltip" data-placement="bottom" title="Approve" aria-hidden="true"></span><span class="sr-only">Approve This Bar</span></a>
          <a href="#"><span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="bottom" title="Reject" aria-hidden="true"></span><span class="sr-only">Reject This Bar</span></a>
          @endif
          <a href="{{ route('bars/editbar', array('id' => $bar->id)) }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Bar Information</span></a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@stop
