@extends('master')
@section('content')
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Sign In</div>
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

			<?php
				$input1 = array('class' => 'form-control', 'placeholder' => 'username or email', 'id' =>
						'login-username', 'type' => 'email', 'required' => 'required');

				$input2 = array('class' => 'form-control', 'placeholder' => 'password','id'
										=>'login-password', 'required' => 'required');

				if ($loggedin==1){
					array_push($input1, 'disabled');
					array_push($input2, 'disabled');
				}
			?>

			{!! Form::open(array('url' => 'users/login', 'class' => 'form-horizontal', 'role' => 'form', 'id' =>
				'loginform'))	!!}

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	{!! Form::text('email', null, $input1) !!}
				</div>

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	{!! Form::password('password', $input2) !!}
				</div>


				@if ($loggedin!=1)
				<div class="input-group">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('remember', '1', false, array('id' => 'login-remember')); !!} Remember me
						</label>
					</div>
				</div>


				<div class="form-group" style="margin-top:10px">
					<!-- Button -->

					<div class="col-sm-12 controls">

						{!! Form::reset('Reset', array('class' => 'btn btn-default', 'id' => 'btn-reset')) !!}
						{!! Form::submit('Login', array('class' => 'btn btn-success', 'id' => 'btn-login')) !!}
						{!! Form::button('Login with Facebook', array('class' => 'btn btn-primary', 'id' =>
						'btn-fblogin'))	!!}


					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12 control">
						<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
							Don't have an account!
							<a href="{{ URL::to("users/register") }}">
								Sign Up Here
							</a>
						</div>
					</div>
				</div>
				@else
					<div class="form-group">
						<div class="col-md-12 control">
							<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
								You are already loggedin,
								Do you want to
								<a href="{{ URL::to("users/logout") }}">
									logout?
								</a>
							</div>
						</div>
					</div>
				@endif
			{!! Form::close() !!}

		</div>
	</div>
@stop
