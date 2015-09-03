{{-- TODO: Clean up? This is not being used. --}}
@extends("layout")
@section("content")
	<div class="container">

		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>

		@if (!$secretquestion)
			<h1>Forgot your password?</h1>
			{{ Form::open() }}
			@if (Session::get("error"))
		        {{ Session::get("error") }}<br />
			@endif

		    {{ Form::label("email", "Email") }}
		    {{ Form::text("email", Input::old("email")) }}


			{{ Form::submit("reset") }}
			{{ Form::close() }}
		@endif

		@if ($secretquestion)
			<h1>Answer your secret question</h1>
			{{ Form::open() }}
			@if (Session::get("error"))
				{{ Session::get("error") }}<br />
			@endif


			 {{ $secretquestion}}
			 {{ Form::text("secretanswer") }}
			 {{ Form::hidden("email", $username) }}
			 {{ Form::hidden("secret", rand(10000,100000)) }}


			{{ Form::submit("reset") }}
			{{ Form::close() }}
		@endif

		@if ($password)
			@if(isset($password['error']))
				{{$password['error']}}
			@else
				Your password is {{$password}}
			@endif
		@endif



	</div>
@stop