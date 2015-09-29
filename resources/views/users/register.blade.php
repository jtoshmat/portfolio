@extends('master')
@section('content')
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Register</div>
			<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="{{ URL::to("users/forgotpassword") }}">Forgot password?</a></div>
		</div>

		<div class="panel-body" style="padding-top:30px">

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



			{!! Form::open(array('url' => 'users/register', 'class' => 'form-horizontal', 'role' => 'form', 'id' =>
				'loginform'))	!!}

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	{!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'username or email', 'id' =>
					'login-username', 'type' => 'email', 'required' => 'required')) !!}
				</div>

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	{!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'password','id'
					=>'login-password', 'required' => 'required')) !!}
				</div>

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	{!! Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm password','id'
					=>'login-password2', 'required' => 'required')) !!}
				</div>



				<div class="form-group" style="margin-top:10px">
					<!-- Button -->

					<div class="col-sm-12 controls">

						{!! Form::reset('Reset', array('class' => 'btn btn-default', 'id' => 'btn-reset')) !!}
						{!! Form::submit('Register', array('class' => 'btn btn-success', 'id' => 'btn-login')) !!}

					</div>
				</div>


				<div class="form-group">
					<div class="col-md-12 control">
						<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
							Have an account?
							<a href="{{ URL::to("users/login") }}">
								Login here
							</a>
						</div>
					</div>
				</div>
			{!! Form::close() !!}



		</div>
	</div>

@stop
