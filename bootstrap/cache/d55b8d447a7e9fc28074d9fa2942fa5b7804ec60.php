<?php $categories = \App\Models\Category::with('subCategories')->get() ?>
<header class="navigation">
    <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
        <button class="menu-icon float-right" type="button" data-toggle="main-menu"></button>
        <a href="/" class="logo float-left"></a>
    </div>

    <div class="top-bar" id="main-menu">
        <div class="top-bar-title show-for-medium">
            <a href="/" class="logo"></a>
        </div>
        <div class="top-bar-left">
            <ul class="drilldown  menu vertical medium-horizontal" data-dropdown-menu
                data-disable-hover="true" data-click-open="true">
                <li><a href="#">Acme Products</a></li>
                <?php if(count($categories)): ?>
                    <li>
                        <a href="#">Categories</a>
                        <ul class="menu vertical sub dropdown">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="#"><?php echo e($category->name); ?></a>
                                    <?php if(count($category->subCategories)): ?>
                                        <ul class="menu sub dropdown">
                                            <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="#"><?php echo e($subCategory->name); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="menu vertical medium-horizontal">
                <?php if(isAuthenticated()): ?>
                    <li><?php echo e(user()->username); ?></li>
                    <li><a href='/cart'>Cart</a></li>
                    <li><a href='/logout'>Logout</a></li>
                <?php else: ?>
                    <li><a href='/login'>Sign in</a></li>
                    <li><a href='/register'>Register</a></li>
                    <li><a href='/cart'>Cart</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>