@extends("layout")
@section("content")
<?php
  $barname = json_decode($barname)[0]->barname;
  $bartimezone = json_decode($bartimezone)[0]->timezone;
  $barslug = json_decode($barslug)[0]->slug;
  $time = '';
  $matchup = count($gamematchup) > 0 ?
      json_decode($gamematchup)[0]->matchup : '';
  if (count($gametime) > 0) {
    $dateTime = new DateTime(json_decode($gametime)[0]->game_time,
        new DateTimeZone('US/Central'));
    $dateTime->setTimeZone(new DateTimeZone($bartimezone));
    $time = $dateTime->format('m/d/Y g:i A');
  }
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
  <h3>Add Event</h3>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::open(array("url" => "addbevent/$barid?gid=".$gid, "class" => "form-add-bar")) }}
        <div class="form-group">
          {{ Form::label("datetime", "Local Date and Time") }}
          {{ Form::text("datetime", Input::old("datetime") ? Input::old("datetime") : $time, ["class" => "form-control datetime-picker"]) }}
          <div class="text-right"><small>Time listed is in the {{ str_replace('_', ' ', $bartimezone) }} timezone.</small></div>
        </div>
        <div class="form-group">
          {{ Form::label("title", "Title") }}
          {{ Form::text("title", Input::old("title") ? Input::old("title") : $matchup, ["class" => "form-control", "required"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("description", "Description") }} <small>Time listed is in the US/Central timezone.</small>
          {{ Form::textarea("description", Input::old("description"), ["class" => "form-control character-limit", "maxlength" => "1000"]) }}
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
        <div class="text-right">
          {{ Form::submit("Add Event", ["class" => "btn btn-primary"]) }}
        </div>
        {{ Form::hidden('timezone', $bartimezone) }}
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
