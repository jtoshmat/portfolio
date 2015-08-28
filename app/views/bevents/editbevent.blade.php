@extends("layout")
@section("content")
<?php

  $barname = $barname[0]->barname;
  $barslug = $barslug[0]->slug;
  $bartimezone = $bartimezone[0]->timezone;
  $eventtime = new DateTime($bevent->eventtime, new DateTimeZone($bartimezone));
  $eventtime = $eventtime->format('m/d/Y g:i A');

?>
<div class="container add-bar">
  <div class="page-header tabbed-header">
    <h2>{{$barname}}
      <small><a href="http://www.packerseverywhere.com/app/venues/{{ $barslug }}" target="_blank"><span class="glyphicon glyphicon-new-window" data-toggle="tooltip" data-placement="top" title="View this bar on PackersEverywhere.com" aria-hidden="true"></span><span class="sr-only">View this bar on PackersEverywhere.com</a></small>
    </h2>
    <ul class="nav nav-tabs">
      <li role="presentation"><a href="{{ route('bars/editbar', array('id' => $barid)) }}">Bar Info</a></li>
      <li role="presentation" class="active"><a href="{{ route('bevents/bevents', array('id' => $barid)) }}">Events</a></li>
    </ul>
  </div>
  <h3>Edit Event</h3>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::model($bevent, array('url' => 'editbevent/'.$bevent->bid.'?gid='.$gid, "class" => "form-edit-bar")) }}
        <div class="form-group">
          {{ Form::label("datetime", "Local Date and Time") }}
          {{ Form::text("datetime", $eventtime, ["class" => "form-control datetime-picker"]) }}
          <div class="text-right"><small>Time listed is in the {{ str_replace('_', ' ', $bartimezone) }} timezone.</small></div>
        </div>
        <div class="form-group">
          {{ Form::label("title", "Title") }}
          {{ Form::text("title", $bevent->title, ["class" => "form-control"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("description", "Description") }} <small>Time listed is in the US/Central timezone.</small>
          {{ Form::textarea("description", $bevent->description, ["class" => "form-control character-limit", "maxlength" => "1000"]) }}
          <div class="character-count">1000 characters remaining</div>
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
                <a href="#" id="delete-event" data-eventid="{{ $bevent->bid }}" data-barid="{{ $barid }}" class="action-delete-event"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete Event</span></a>
              </li>
            </ul>
          </div>
          <div class="col-xs-6 text-right">
            {{ Form::submit("Update Event", ["class" => "btn btn-primary"]) }}
          </div>
        </div>
        {{ Form::hidden('timezone', $bartimezone) }}
  	    {{ Form::hidden('bid', $bevent->bid) }}
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
