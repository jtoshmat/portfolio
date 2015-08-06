@extends("layout")
@section("content")
<div class="container add-bar">
  <div class="page-header">
    <h2>Season Schedule</h2>
  </div>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::model($game, array("url" => 'editgame/'.$game->gid, "class" => "form-add-bar")) }}
        <div class="form-group">
          {{ Form::label("datetime", "Date") }}
          {{Form::hidden("datetime", null, ["class" => "form-control datetime-picker"])}}
        </div>
        <div class="form-group">
          {{ Form::label("vs", "vs") }}
          <div class="row">
            <div class="col-xs-8">
              {{ Form::text("matchup", Input::old("vs"), ["class" => "form-control", "required"]) }}
            </div>
            <div class="col-xs-4">
	            <?php
	            $selectedDefault = $game->location;
	            $allLocations = array("Home" => "Home", "Away" => "Away");
	            ?>
	            {{ Form::select('location', $allLocations, $selectedDefault, ["class" => "form-control", "required"]) }}

            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label(null, "TV Station") }}
          <div>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'NBC') }} NBC</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'CBS') }} CBS</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'ESPN') }} ESPN</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'FOX') }} FOX</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'NFL Network') }} NFL Network</label>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label("notes", "Notes") }}
          {{ Form::textarea("description", Input::old("description"), ["class" => "form-control", "placeholder" => "optional"]) }}
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
                <a href="#" id="delete-game" data-gameid="{{-- Game ID here --}}" class="action-delete-bar"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete Game</span></a>
              </li>
            </ul>
          </div>
          <div class="col-xs-6 text-right">
            {{ Form::submit("Update Game", ["class" => "btn btn-primary"]) }}
          </div>
        </div>
	    {{ Form::hidden("gid", $game->gid) }}
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
