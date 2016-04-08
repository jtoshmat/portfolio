<!DOCTYPE html>
<html>
<head>
    <title>Caretraxx - <?php echo $__env->yieldContent('title'); ?></title>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/main.js')); ?>"></script>
    <link href="<?php echo e(URL::asset('css/style.css')); ?>" rel="stylesheet">
</head>
<body>
<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->yieldSection(); ?>
<div class="container">
    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html>