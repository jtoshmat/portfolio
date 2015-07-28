@extends("layout")
@section("content")
<<<<<<< HEAD
{{ Form::open(array('url'=>'register', 'class'=>'form-signup')) }}
    <h2 class="er">Please Register</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
 
    Username: {{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'username')) }}
    Password: {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
    Password 2: {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}
    @if (Auth::check())
        @if ($roles)
            Roles: {{ Form::select('roles', $roles, '3')}}
        @endif
        <br />
        Grant:
        @foreach ($privileges as $value => $label)
            {{$label}} : {{Form::radio('privileges', $value);}}


        @endforeach

    @endif
        <br />
 
    {{ Form::submit('Register', array('class'=>'input-block-level'))}}
{{ Form::close() }}
=======
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading"><h2 class="panel-title">Register</h2></div>
        <div class="panel-body">
        {{ Form::open(array('url'=>'register', 'class'=>'form-signup2')) }}
          <div class="form-group">
            {{ Form::label("username", "Username") }}
            {{ Form::text("username", null, ["class" => "form-control", "required"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("password", "Password") }}
            {{ Form::password("password", ["class" => "form-control", "required"]) }}
          </div>
          <div class="form-group">
            {{ Form::label("password_confirmation", "Confirm Password") }}
            {{ Form::password("password_confirmation", ["class" => "form-control", "required"]) }}
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
          {{ Form::submit("Register", ["class" => "btn btn-primary"]) }}
        {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
>>>>>>> fe-task-runners
@stop
