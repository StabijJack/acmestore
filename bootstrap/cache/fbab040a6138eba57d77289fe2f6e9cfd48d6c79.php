<?php $__env->startSection('title', 'Create Product'); ?>
<?php $__env->startSection('data-page-id', 'adminProduct'); ?>
<?php $__env->startSection('content'); ?>
<div class="add-product">
    <div class="row expanded">
        <div class="column medium-11">
            <h2>Add Inventory Item</h2>
            <hr>
        </div>
    </div>
    <?php echo $__env->make('includes.message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <form action="/admin/product/create" method="post">
        <div class="small-12 medium-11">
            <div class="row expanded">
                <div class="small-12 medium-6 column">
                    <label>Product name: 
                        <input type="text" name="name" placeholder="Product name" 
                    value="<?php echo e(\App\Classes\Request::old('post', 'name')); ?>">
                    </label>
                </div>
                <div class="small-12 medium-6 column">
                    <label>Product Price: 
                        <input type="text" name="price" placeholder="Product price" 
                        value="<?php echo e(\App\Classes\Request::old('post', 'price')); ?>">
                    </label>
                </div>
                <div class="small-12 medium-6 column">
                    <label>Product Category: 
                        <select name="category" id="product-category">
                            <option value="<?php echo e(\App\Classes\Request::old('post', 'category')?:""); ?>">
                            <?php echo e(\App\Classes\Request::old('post', 'category')?:"Select Category"); ?>

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </label>
                </div>
                <div class="small-12 medium-6 column">
                    <label>Product SubCategory: 
                        <input type="text" name="name" placeholder="Product name" 
                    value="<?php echo e(\App\Classes\Request::old('post', 'name')); ?>">
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
<?php echo $__env->make('includes.delete-modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>