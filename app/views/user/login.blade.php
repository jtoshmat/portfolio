@extends("layout")
@section("content")
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading"><h2 class="panel-title">Login</h2></div>
        <div class="panel-body">
          {{ Form::open() }}
          <div class="form-group">
            {{ Form::label("username", "Username") }}
            {{ Form::text("username", Input::old("username"), ["class" => "form-control"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("password", "Password") }}
            {{ Form::password("password", ["class" => "form-control"]) }}
            {{ $errors->first("password") }}
          </div>
            {{ Form::submit("Login", ["class" => "btn btn-primary"]) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
