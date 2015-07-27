@extends("layout")
@section("content")
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
@stop
