@extends("layout")
@section("content")
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading"><h2 class="panel-title">Register</h2></div>
        <div class="panel-body">
        {{ Form::open(array('url'=>'register', 'class'=>'form-signup2')) }}
          <div class="form-group">
            {{ Form::label("username", "Username") }}
            {{ Form::text("username", null, ["class" => "form-control"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("password", "Password") }}
            {{ Form::password("password", ["class" => "form-control"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("password_confirmation", "Confirm Password") }}
            {{ Form::password("password_confirmation", ["class" => "form-control"]) }}
          </div>
          <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
          </ul>
          {{ Form::submit("Register", ["class" => "btn btn-primary"]) }}
        {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
