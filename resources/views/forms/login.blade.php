{!! Form::open(array('url' => '/auth/login', 'class' => 'login-form')) !!}
<div class="form-group2">
    {!! Form::label('enter userid') !!}

    {!! Form::email('email', null,
        array('required',
              'class'=>'form-control2',
              'placeholder'=>'user@hospital')) !!}


    {!! Form::label('password') !!}


    {!! Form::password('password', null,
        array('required',
              'class'=>'form-control2',
               )) !!}

<br />
    {!! Form::submit('Login',
      array('class'=>'btn btn-primary')) !!}
</div>

{!! Form::close() !!}
<br />
    {{--*/  $errorClass = (session('flag'))?session('flag'):'info' /*--}}
    @if (count($errors) > 0)
        <div class="alert alert-{{$errorClass}}" role="alert">
            @foreach($errors->all() as $error)
                <p>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif
