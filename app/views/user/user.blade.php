@extends("layout")
@section("content")


    {{ Form::model($users, array('url' => 'user/'.$users->id)) }}
    <h2 class="er">User Profile Update</h2>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

            <!-- email -->
    {{ Form::label('username', 'Username') }}
    {{ Form::email('username') }}

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

    {{ Form::label('secretquestion', 'Secret Question: ') }}
    {{ Form::text('secretquestion') }}

    <br />

    {{ Form::label('secretanswer', 'Secret Answer: ') }}
    {{ Form::text('secretanswer') }}

    <br />
    {{ Form::hidden('id') }}
    {{ Form::submit('Update', array('class'=>'input-block-level'))}}
    {{ Form::close() }}

@stop
