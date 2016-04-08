<?php echo Form::open(array('url' => '/patient', 'method'=>'POST', 'class' => 'patient-register-form')); ?>

<div class="form-group">
    <?php echo Form::label('Fill out a new patient info'); ?>



    Patient Email Address:
    <?php echo Form::email('email', null,
        array('required',
              'class'=>'form-control',
              'placeholder'=>'Jon Toshmatov')); ?>


    <div id="loading">
        <img src="/img/loading.gif">
    </div>

Patient ID:
    <?php echo Form::text('empid', 39,
       array('required',
             'class'=>'form-control',
             'placeholder'=>'111111')); ?>


    <?php echo Form::hidden('userid', Auth::user()->id); ?>

    <?php echo Form::hidden('action', 'create'); ?>

    <?php echo Form::hidden('orgid', 1); ?> <!-- @TODO  add a new field orgid in users table relationship organizations in migration 3/29-->




<br />
    <?php echo Form::submit('Send Enrollment Invitation',
      array('class'=>'btn btn-primary','id'=>'newpatient_submit')); ?>

</div>

<?php echo Form::close(); ?>


