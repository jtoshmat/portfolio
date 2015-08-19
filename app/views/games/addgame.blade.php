@extends("layout")
@section("content")
<div class="container add-bar">
  <div class="page-header">
    <h2>Season Schedule</h2>
  </div>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::open(array("url" => "addgame/$bid", "class" => "form-add-bar")) }}
        <div class="form-group">
          {{ Form::label("datetime", "Date and Time") }}
          {{ Form::text("datetime", null, ["class" => "form-control datetime-picker col-sm-8"]) }}
          <div class="text-right"><small>Time listed is in the US/Central timezone.</small></div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6 col-xs-8">
              {{ Form::label("matchup", "Matchup") }}
              {{ Form::text("matchup", Input::old("matchup"), ["class" => "form-control", "required"]) }}
            </div>
            <div class="col-sm-6 col-xs-4">
              {{ Form::label("location", "Location") }}
              {{ Form::select("location", array(
                "home" => "Home",
                "away" => "Away"
              ), Input::old("location"), ["class" => "form-control", "required"]) }}
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label(null, "TV Station") }}
          <div>
            <label class="checkbox-inline">{{ Form::checkbox('tv[]', 'NBC') }} NBC</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv[]', 'CBS') }} CBS</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv[]', 'ESPN') }} ESPN</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv[]', 'FOX') }} FOX</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv[]', 'NFL Network') }} NFL Network</label>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label("notes", "Notes") }} <small class="text-muted">optional</small>
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
          {{ Form::submit("Add Game", ["class" => "btn btn-primary"]) }}
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
