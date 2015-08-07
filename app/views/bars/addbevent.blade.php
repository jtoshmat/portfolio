@extends("layout")
@section("content")
<div class="container add-bar">
  <div class="page-header">
    <h2>Edit Event</h2>
  </div>
  <div class="row">
    <div class="col-sm-8">
      {{ Form::open(array("url" => "addbevent/bid", "class" => "form-add-bar")) }}
        <div class="form-group">
          {{ Form::label("datetime", "Date") }}
          {{ Form::hidden("datetime", null, ["class" => "form-control datetime-picker"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("title", "Title") }}
          {{Form::text("title", Input::old("title"), ["class" => "form-control", "required"]) }}
        </div>
        <div class="form-group">
          {{ Form::label("description", "Description") }}
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
                {{-- TODO: hook up event action --}}
                <a href="#" id="delete-game" data-eventid="{{-- Event ID here --}}" class="action-delete-bar"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Delete" aria-hidden="true"></span><span class="sr-only">Delete Game</span></a>
              </li>
            </ul>
          </div>
          <div class="col-xs-6 text-right">
            {{ Form::submit("Add Event", ["class" => "btn btn-primary"]) }}
          </div>
        </div>
{{--	    {{ Form::hidden('bid', $bid) }}--}}
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
