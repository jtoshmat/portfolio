<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.header', ['some' => 'data'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div id="pin-bar" class="loggedin-yes">

        <div class="item">
            <a href="#main">Home</a>
        </div>

        <div class="item">
            <a href="#caretraxx-usage-mobile-checkin">
                Mobile checkin
            </a>
            <a href="" class="pin"></a>
        </div>

        <div class="pin-view">
            <a href="">pin current view</a>
        </div>
    </div>

    <div class="feedback">
        <a href="">feedback</a>
    </div>

        <section id="main" class="notabs">
            <div class="login loggedin-no">
                <h1>Please Login</h1>
                <?php echo $__env->make('forms.login', ['some' => 'data'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

        </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>