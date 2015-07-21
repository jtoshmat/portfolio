@extends("layout")
@section("content")


{{ Form::open(array('url'=>'register', 'class'=>'form-signup2')) }}
    <h2 class="form-signup-heading">Please Register</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
 
 
    {{ Form::text('username', null, array('class'=>'input-block-level2', 'placeholder'=>'username')) }}
    {{ Form::password('password', array('class'=>'input-block-level2', 'placeholder'=>'Password')) }}
    {{ Form::password('password_confirmation', array('class'=>'input-block-level2', 'placeholder'=>'Confirm Password')) }}
 
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}