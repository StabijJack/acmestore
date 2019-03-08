<?php $__env->startSection('title', 'Edit Product'); ?>
<?php $__env->startSection('data-page-id', 'adminProduct'); ?>

<?php $__env->startSection('content'); ?>
<div class="add-product admin_shared">
    <div class="row expanded">
        <div class="column medium-11">
            <h2>Edit <?php echo e($product->name); ?></h2> <hr />
        </div>
    </div>
    
    <?php echo $__env->make('includes.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <form method="post" action="/admin/product/edit" enctype="multipart/form-data">
        <div class="small-12 medium-11">
            <div class="row expanded">
                <div class="small-12 medium-6 column">
                <label>Product name:
                    <input type="text" name="name" value="<?php echo e($product->name); ?>">
                </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product price:
                        <input type="text" name="price" value="<?php echo e($product->price); ?>">
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product Category:
                        <select name="category" id="product-category">
                            <option value="<?php echo e($product->category->id); ?>">
                                <?php echo e($product->category->name); ?>

                            </option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"> <?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product Subcategory:
                        <select name="subcategory" id="product-subcategory">
                            <option value="<?php echo e($product->subCategory->id); ?>">
                                <?php echo e($product->subCategory->name); ?>

                            </option>
                        </select>
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <label>Product Quantity:
                        <select name="quantity">
                            <option value="<?php echo e($product->quantity); ?>">
                                <?php echo e($product->quantity); ?>

                            </option>
                            <?php for($i = 1; $i <= 50; $i++): ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                            <?php endfor; ?>
                        </select>
                    </label>
                </div>
    
                <div class="small-12 medium-6 column">
                    <br />
                   <div class="input-group">
                       <span class="input-group-label">Product Image:</span>
                       <input type="file" name="productImage" class="input-group-field">
                   </div>
                </div>
                
                <div class="small-12 column">
                    <label>Description:
                    <textarea name="description" placeholder="Description"><?php echo e($product->description); ?></textarea>
                    </label>
                    <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                    <input class="button warning float-right" type="submit" value="Update Product">
                </div>
            </div>
        </div>
    </form>
    
    <!--Delete Button -->
    <div class="row expanded">
        <div class="small-12 medium-11">
            <table data-form="deleteForm">
                <tr style="border: 1px solid #ffffff !important;">
                    <td style="border: 1px solid #ffffff !important;">
                        <form method="POST" action="/admin/product/<?php echo e($product->id); ?>/delete"
                              class="delete-item">
                            <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                            <button type="submit" class="button alert">Delete Product</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<?php echo $__env->make('includes.delete-modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>