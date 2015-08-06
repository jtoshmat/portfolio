
@extends("layout")

@section("content")
<div class="container">
  <div class="table-controls page-header">
    <div class="row">
      <div class="col-xs-6">
        Show
        <button id="show-all-bars" class="btn btn-default active">All</button>
        <button href="#" id="show-unapproved-bars" class="btn btn-default">Awaiting Approval <span id="approval-count"></span></button>
      </div>
      <div class="col-xs-6 text-right">
      	<a href="{{ URL::route("bars/addbar") }}" class="btn btn-primary">Add Bar</a>
{{--	      <a href="{{ URL::route("admin/uploadcsv") }}" class="btn btn-default">Upload CSV</a>--}}
      </div>
    </div>
  </div>
  <table id="bars-listing-table" class="table table-hover" cellspacing="0">
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
    		<th><span class="sr-only">Status</span></th>
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
          <a href="{{ route('bevents/bevents', array('id' => $bar->id)) }}"><span class="glyphicon glyphicon-calendar" data-toggle="tooltip" data-placement="bottom" title="Events" aria-hidden="true"></span><span class="sr-only">Edit Events</span></a>
          @else
          <a id="id_{{$bar->id}}" href="#"><span class="glyphicon glyphicon-ok action-approve-bar" data-toggle="tooltip" data-placement="bottom" title="Approve" aria-hidden="true"></span><span class="sr-only">Approve This Bar</span></a>
          <a id="id_{{$bar->id}}" href="#"><span class="glyphicon glyphicon-remove action-reject-bar" data-toggle="tooltip" data-placement="bottom" title="Reject" aria-hidden="true"></span><span class="sr-only">Reject This Bar</span></a>
          @endif
          <a href="{{ route('bars/editbar', array('id' => $bar->id)) }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Bar Information</span></a>
        </td>
        <td>{{ $activebar }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@stop
