<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="dashboard">
    <div class="row expanded">
        <h2>Dashboard</h2>

        <?php echo e($beforeToken); ?>

        <br />
        <?php echo e($afterToken); ?>

        <br />
        <?php echo e($admin); ?>

        <br />
        <?php echo e($_SERVER['REQUEST_URI']); ?>


        <form action="/admin" method="post" enctype="multipart/form-data">
            <input name ="product" value="testing">
            <input type="file" name ="image">
            <input type="submit" value="Go" name="submit">
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>