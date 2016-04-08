<?php echo Form::open(array('url' => '/auth/login', 'class' => 'login-form')); ?>

<div class="form-group2">
    <?php echo Form::label('enter userid'); ?>


    <?php echo Form::email('email', null,
        array('required',
              'class'=>'form-control2',
              'placeholder'=>'user@hospital')); ?>



    <?php echo Form::label('password'); ?>



    <?php echo Form::password('password', null,
        array('required',
              'class'=>'form-control2',
               )); ?>


<br />
    <?php echo Form::submit('Login',
      array('class'=>'btn btn-primary')); ?>

</div>

<?php echo Form::close(); ?>

<br />
    <?php /**/  $errorClass = (session('flag'))?session('flag'):'info' /**/ ?>
    <?php if(count($errors) > 0): ?>
        <div class="alert alert-<?php echo e($errorClass); ?>" role="alert">
            <?php foreach($errors->all() as $error): ?>
                <p>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?php echo e($error); ?>

                </p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
