<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('data-page-id', 'adminDashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard admin_shared">
        <div class="row collapse expanded" data-equalizer data-equalizer-on="medium">
            
            <div class="small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Total Orders</p><h4><?php echo e($orders); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="#">Order Details</a>
                        </div>
                    </div>
                </div>
            </div>
    
            
            <div class="small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-thermometer-empty" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Stock</p><h4><?php echo e($products); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="/admin/products">View Products</a>
                        </div>
                    </div>
                </div>
            </div>
    
            
            <div class="small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Revenue</p><h4>$<?php echo e(number_format($payments, 2)); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="#">Payment Details</a>
                        </div>
                    </div>
                </div>
            </div>
    
            
            <div class="small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Signup</p><h4><?php echo e($users); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="#">Registered Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row collapse expanded graph">
            <div class="small-12 medium-6 column monthly-sales">
                <div class="card">
                    <div class="card-section">
                        <h4>Monthly Orders</h4>
                        <canvas id="order"></canvas>
                    </div>
                </div>
            </div>
    
            <div class="small-12 medium-6 column monthly-revenue">
                <div class="card">
                    <div class="card-section">
                        <h4>Monthly Revenue</h4>
                        <canvas id="revenue"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>