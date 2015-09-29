@extends('master')
@section('content')
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Profile Update</div>
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

				$inputEmail = array('class' => 'form-control', 'placeholder' => 'username or email', 'id' =>
						'profile-username', 'type' => 'email', 'required' => 'required');

				$inputName = array('class' => 'form-control', 'placeholder' => 'Your name', 'id' =>
						'profile-name', 'type' => 'text', 'required' => 'required');

				$inputAvatar = array('class' => 'form-control', 'placeholder' => 'Your avatar', 'id' =>
						'profile-avatar', 'type' => 'file');

				$inputExpire_at	= array('class' => 'form-control', 'placeholder' => 'Account expires', 'id' =>
						'profile-expires_at', 'type' => 'text');
			?>

			{!! Form::model($user, array('url' => 'users/profile/'.$data['id'], 'class' => 'form-horizontal', 'role' =>
				'form', 'id' =>
				'loginform'))	!!}


				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
					<img src="../../img/users/{{$user->avatar}}">

				</div>

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					{!! Form::text('email', null, $inputEmail) !!}

				</div>

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					{!! Form::text('name', null, $inputName) !!}

				</div>

				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-upload"></i></span>
					{!! Form::file('avatar', null, $inputName) !!}

				</div>
				@if(Auth::user()->role==1)
				<div class="input-group" style="margin-bottom: 25px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
					{!! Form::text('expire_at', null, $inputExpire_at) !!}
				</div>
				@endif


				<div class="form-group" style="margin-top:10px">
					<!-- Button -->

					<div class="col-sm-12 controls">
						{!! Form::reset('Reset', array('class' => 'btn btn-default', 'id' => 'btn-reset')) !!}
						{!! Form::submit('Update', array('class' => 'btn btn-success', 'id' => 'btn-login')) !!}
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

			{!! Form::close() !!}

		</div>
	</div>
@stop
