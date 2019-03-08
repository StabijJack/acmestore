<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acme Store - <?php echo $__env->yieldContent('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/all.css" >
    <script src="https://unpkg.com/vue"></script>
    <script src="https://use.fontawesome.com/1504552d47.js"></script>
</head>
<body data-page-id="<?php echo $__env->yieldContent('data-page-id'); ?>">

<?php echo $__env->yieldContent('body'); ?>

<script async src="/js/all.js"></script>
<?php echo $__env->yieldContent('stripe-checkout'); ?>
<?php echo $__env->yieldContent('paypal-checkout'); ?>
</body>
</html>

