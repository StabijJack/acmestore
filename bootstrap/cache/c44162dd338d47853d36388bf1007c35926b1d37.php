 
<?php $__env->startSection('title'); ?> <?php echo e($product->name); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('data-page-id', 'product'); ?> 
<?php $__env->startSection('content'); ?>
    <div class="product" id="product" data-token=<?php echo e($token); ?> data-id="<?php echo e($product->id); ?>">
        <div class="text-center">
            <i v-show="loading" class="fa fa-spinner" style="font-size: 3rem; padding-bottom: 3rem; color:#0a0a0a"> </i>
        </div>
        <section class="item-container" v-if="loading == false">
            <div class="row column">
                <nav aria-label="You are here:" role="navigation">
                    <ul class="breadcrumbs">
                        <li>
                            <a :href="'/product/category/' + category.slug">
                                {{ category.name }}
                            </a>
                        </li>
                        <li>
                            <a :href="'/product/subcategory/' + subCategory.slug">
                                {{ subCategory.name }}
                            </a>
                        </li>
                        <li>>{{ product.name }}</li>
                    </ul>
                </nav>
            </div>
            <div class="row collapse">
                <div class="small-12 medium-5 large-4 column">
                    <div >
                        <img :src="'/'+ product.image_path" width="100%" height="200">
                    </div>
                </div>
                <div class="small-12 medium-7 large-8 column">
                    <div class="product-details">
                        <h2>{{ product.name }}</h2>
                        <p>{{ product.description }}</p>
                        <h2>${{ product.price }}</h2>
                        <button class="button alert">Add to Cart</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>