<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel - <?php echo $__env->yieldContent('title'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/all.css" />
  <script src="https://use.fontawesome.com/3fdd20bbfc.js"></script>
</head>

<body>
  <?php echo $__env->make('includes.admin-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <div class="off-canvas-content" data-off-canvas-content>
    <!-- Your page content lives here -->
    <div class="title-bar">
      <div class="title-bar-left">
        <button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
        <span class="title-bar-title"><?php echo e(getenv('APP_NAME')); ?></span>
      </div>
    </div>
    <?php echo $__env->yieldContent('content'); ?>
  </div>

  <script src="/js/all.js"></script>
</body>

</html>