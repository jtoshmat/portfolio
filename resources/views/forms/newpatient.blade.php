{!! Form::open(array('url' => '/patient', 'method'=>'POST', 'class' => 'patient-register-form')) !!}
<div class="form-group">
    {!! Form::label('Fill out a new patient info') !!}


    Patient Email Address:
    {!! Form::email('email', null,
        array('required',
              'class'=>'form-control',
              'placeholder'=>'Jon Toshmatov')) !!}

    <div id="loading">
        <img src="/img/loading.gif">
    </div>

Patient ID:
    {!! Form::text('empid', 39,
       array('required',
             'class'=>'form-control',
             'placeholder'=>'111111')) !!}

    {!! Form::hidden('userid', Auth::user()->id)!!}
    {!! Form::hidden('action', 'create')!!}
    {!! Form::hidden('orgid', 1)!!} <!-- @TODO add a new field orgid in users table relationship organizations in migration 3/29-->




<br />
    {!! Form::submit('Send Enrollment Invitation',
      array('class'=>'btn btn-primary','id'=>'newpatient_submit')) !!}
</div>

{!! Form::close() !!}

