@extends("layout")
@section("content")
<?php
$gameUnix = strtotime($game->game_time);
$gameDateTime = date('m/d/Y g:i A', $gameUnix);
?>

<div class="container add-bar">
  <div class="page-header">
    <h2>Season Schedule</h2>
  </div>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::model($game, array("url" => 'editgame/'.$game->gid, "class" => "form-add-bar")) }}
        <div class="form-group">
          {{ Form::label("datetime", "Date and Time") }}
          {{ Form::text("datetime", $gameDateTime, ["class" => "form-control datetime-picker col-sm-8"]) }}
          <div class="text-right"><small>Time listed is in the US/Central timezone.</small></div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-xs-8">
            <div class="form-group">
              {{ Form::label("matchup", "Matchup") }}
              {{ Form::text("matchup", Input::old("matchup"), ["class" => "form-control", "required"]) }}
            </div>
          </div>
          <div class="col-sm-6 col-xs-4">
            <div class="form-group">
              {{ Form::label("location", "Location") }}
	            <?php
	            $selectedDefault = $game->location;
	            $allLocations = array("home" => "Home", "away" => "Away");
	            ?>
	            {{ Form::select('location', $allLocations, $selectedDefault, ["class" => "form-control", "required"]) }}
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label(null, "TV Station") }}
          <div>
            {{-- TODO: Need to toggle checkboxes as appropriate. --}}
            <?php 
              $networks = explode(', ', $game->tv);
              foreach ($networks as $network) {
                if ($network === 'CBS') { $cbs = true; } 
                if ($network === 'NBC') { $nbc = true; }
                if ($network === 'ESPN') { $espn = true; }
                if ($network === 'FOX') { $fox = true; }
                if ($network === 'Packers TV Network') { $packers = true; }
              }
            ?>
            <label class="checkbox-inline">
              <input type="checkbox" name="tv[]" value="NBC" <?php echo isset($nbc) ? 'checked' : ''?> > NBC
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="tv[]" value="CBS" <?php echo isset($cbs) ? 'checked' : ''?> > CBS
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="tv[]" value="ESPN" <?php echo isset($espn) ? 'checked' : ''?> > ESPN
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="tv[]" value="FOX" <?php echo isset($fox) ? 'checked' : ''?> > FOX
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="tv[]" value="Packers TV Network" <?php echo isset($packers) ? 'checked' : ''?> >Packers TV Network
            </label>
            {{-- Commenting out the laravel way of doing checkboxes as they are
                 coming up buggy and always checked on a model-bound form. --}}
            {{-- <label class="checkbox-inline">{{ Form::checkbox('tv', 'NBC', false) }} NBC</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'CBS', false) }} CBS</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'ESPN', false) }} ESPN</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'FOX', false) }} FOX</label>
            <label class="checkbox-inline">{{ Form::checkbox('tv', 'NFL Network', false) }} NFL Network</label>--}}
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
                <a href="#" id="delete-game" data-gameid="{{ $game->gid }}" class="action-delete-bar"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete Game</span></a>
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
