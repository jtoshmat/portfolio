@extends("layout")
@section("content")
<?php
  $bartimezone = json_decode($bartime)[0]->timezone;
?>
<div class="container add-bar">
  <div class="page-header tabbed-header">
    <h2>Bar Name Goes Here
      <small><a href="http://www.packerseverywhere.com/app/venues/{{-- $bbarid --}}" target="_blank"><span class="glyphicon glyphicon-new-window" data-toggle="tooltip" data-placement="top" title="View this bar on PackersEverywhere.com" aria-hidden="true"></span><span class="sr-only">View this bar on PackersEverywhere.com</a></small>
    </h2>
    <ul class="nav nav-tabs">
      <li role="presentation"><a href="{{-- route('bars/editbar', array('id' => $bbarid)) --}}">Bar Info</a></li>
      <li role="presentation" class="active"><a href="{{-- route('bevents/bevents', array('id' => $bbarid)) --}}">Events</a></li>
    </ul>
  </div>
  <h3>Edit Event</h3>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::model($bevent, array('url' => 'editbevent/'.$bevent->bid, "class" => "form-edit-bar")) }}
          <div class="form-group">
            {{ Form::label("datetime", "Local Date and Time") }}
            {{ Form::text("datetime", $bevent->datetime, ["class" => "form-control datetime-picker"]) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label("title", "Title") }}
          {{ Form::text("title", $bevent->title )}}
        </div>
        <div class="form-group">
          {{ Form::label("description", "Description") }}
          {{ Form::textarea("description", $bevent->description, ["class" => "form-control", "placeholder" => "optional"]) }}
        </div>

        @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
          <p>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {{ $error }}
          </p>
        @endforeach
        </div>
        @endif
        <div class="row">
          <div class="col-xs-6">
            <ul id="edit-game-actions" class="list-inline edit-actions">
              <li>
                {{-- TODO: hook up event action --}}
                <a href="#" id="delete-game" data-eventid="{{-- Event ID here --}}" class="action-delete-bar"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete Game</span></a>
              </li>
            </ul>
          </div>
          <div class="col-xs-6 text-right">
            {{ Form::submit("Update Event", ["class" => "btn btn-primary"]) }}
          </div>
        </div>
	    {{ Form::hidden('bid', $bevent->id) }}
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
