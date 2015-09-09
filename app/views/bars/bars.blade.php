
@extends("layout")

@section("content")
<div class="container">
  <div class="page-header">
    <h2>Bar Index</h2>
  </div>
  <div class="table-controls">
    <div class="row">
      <div class="col-xs-8 form-inline">
        <label>
          Show
          <select id="bar-status-filter" class="form-control">
            <option value="">All</option>
            <option value="approved">Approved</option>
            <option value="awaiting-approval">Awaiting Approval</option>
            <option value="rejected">Rejected</option>
          </select>
        </label>
      </div>
      <div class="col-xs-4 text-right">
      	<a href="{{ URL::route("bars/addbar") }}" class="btn btn-primary">Add Bar</a>
{{--	      <a href="{{ URL::route("admin/uploadcsv") }}" class="btn btn-default">Upload CSV</a>--}}
      </div>
    </div>
  </div>
  <div class="table-responsive loading">
    <table id="bars-listing-table" class="table table-hover bar-listings-table" cellspacing="0">
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
  				$status = '';
  				if ($bar->status == 1) {
  					$status = 'approved';
  				} else if ($bar->status == 0) {
    				$status = 'awaiting-approval';
  				} else if ($bar->status == -1) {
    				$status = 'rejected';
  				}
  			$bar->totalGames = isset($bar->totalGames)?$bar->totalGames:0;
  			?>
        <tr>
          <td class="text-center"><input type="checkbox" class="checkbox-delete" data-barid="{{ $bar->id }}"></td>
          <td><a href="{{ route('bars/editbar', array('id' => $bar->id)) }}" data-toggle="tooltip" data-placement="bottom" title="Edit">{{ $bar->barname }}</a></td>
          <td>{{ $bar->city }}</td>
          <td>{{ $bar->state }}</td>
          <td>{{ $bar->phone }}</td>
          <td>{{ $bar->website }}</td>
          <td>
            <div class="edit-actions {{ $status }}">
              @if ($admin)
              <a data-barid="{{$bar->id}}" data-status="approved" class="dynamic-action action-approve-bar " href="#"><span class="glyphicon glyphicon-ok" data-toggle="tooltip" data-placement="bottom" title="Approve" aria-hidden="true"></span><span class="sr-only">Approve This Bar</span></a>
              <a data-barid="{{$bar->id}}" data-status="rejected" href="#" class="dynamic-action action-reject-bar"><span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="bottom" title="Reject" aria-hidden="true"></span><span class="sr-only">Reject This Bar</span></a>
              @endif
              <a class="action-edit-events" href="{{ route('bevents/bevents', array('id' => $bar->id)) }}"><span class="glyphicon glyphicon-calendar" data-toggle="tooltip" data-placement="bottom" title="Events" aria-hidden="true"></span><span class="sr-only">Edit Events</span></a>
              <a href="{{ route('bars/editbar', array('id' => $bar->id)) }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="bottom" title="Edit" aria-hidden="true"></span><span class="sr-only"><span class="sr-only">Edit Bar Information</span></a>
            </div>
          </td>
          <td>{{ $status }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
