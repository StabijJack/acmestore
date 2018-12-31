 
<?php $__env->startSection('title', 'Homepage'); ?> 
<?php $__env->startSection('data-page-id', 'home'); ?> 
<?php $__env->startSection('content'); ?>
    <div class="home">
        <section class="hero">
            <div class="hero-slider">
                <div><img src="/images/sliders/slide_1.jpg" alt="Acme Store"></div>
                <div><img src="/images/sliders/slide_2.jpg" alt="Acme Store"></div>
                <div><img src="/images/sliders/slide_3.jpg" alt="Acme Store"></div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>