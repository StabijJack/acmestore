<?php
//Admin Routes
$router->map('GET','/admin','App\Controllers\Admin\DashboardController@show','admin_dashboard');
$router->map('POST','/admin','App\Controllers\Admin\DashboardController@get','admin_form');
//Product management
//categories
$router->map('GET','/admin/product/categories',
    'App\Controllers\Admin\ProductCategoryController@show','product_category');
$router->map('POST','/admin/product/categories',
'App\Controllers\Admin\ProductCategoryController@store','create_product_category');
$router->map('POST','/admin/product/categories/[i:id]/edit',
'App\Controllers\Admin\ProductCategoryController@edit','edit_product_category');
$router->map('POST','/admin/product/categories/[i:id]/delete',
'App\Controllers\Admin\ProductCategoryController@delete','delete_product_category');
//subcategory
$router->map('POST','/admin/product/subcategory/create',
'App\Controllers\Admin\SubCategoryController@store','create_subcategory');
$router->map('POST','/admin/product/subcategory/[i:id]/edit',
'App\Controllers\Admin\SubCategoryController@edit','edit_subcategory');
$router->map('POST','/admin/product/subcategory/[i:id]/delete',
'App\Controllers\Admin\SubCategoryController@delete','delete_subcategory');
//Products
$router->map('GET','/admin/product/create',
'App\Controllers\Admin\ProductController@showCreatePruductForm','create_product_form');
$router->map('POST','/admin/product/create',
'App\Controllers\Admin\ProductController@store','create_product');