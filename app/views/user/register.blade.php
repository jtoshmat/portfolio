@extends("layout")
@section("content")
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading"><h2 class="panel-title">Register</h2></div>
        <div class="panel-body">
        {{ Form::open(array('url'=>'register', 'class'=>'form-signup')) }}
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
			    @if (Auth::check())
		        @if ($roles)
		        <div class="form-group">
			        {{ Form::label("roles", "Roles") }}
			        {{ Form::select("roles", $roles, "3", ["class" => "form-control"]) }}
		        </div>
		        @endif
		        <div class="form-group">
			        <h3>Grant Priveleges</h3>
			        @foreach ($privileges as $value => $label)
							<div class="radio">
			        	<label>
			        		{{ Form::radio('privileges', $value) }} {{ $label }}
			        	</label>
							</div>
			        @endforeach
		        </div>
			    @endif

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
@stop
