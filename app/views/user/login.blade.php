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
            {{ Form::label("username", "Email") }}
            {{ Form::email("username", Input::old("username"), ["class" => "form-control", "required"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("password", "Password") }}
            {{ Form::password("password", ["class" => "form-control", "required"]) }}
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
          {{ Form::submit("Login", ["class" => "btn btn-primary"]) }}
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"
        {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
