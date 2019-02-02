<?php
$router->map('POST','/cart','App\Controllers\CartController@addItem','add_cart_item');
$router->map('get','/cart','App\Controllers\CartController@show','view_cart');
$router->map('get','/cart/items','App\Controllers\CartController@getCartItems','get_cart_items');
$router->map('POST','/cart/update-qty','App\Controllers\CartController@updateQuantity','update_cart_qty');
$router->map('POST','/cart/remove-item','App\Controllers\CartController@removeItem','remove_cart_item');
$router->map('POST','/cart/remove-cart','App\Controllers\CartController@removeCart','remove_cart');
$router->map('POST','/cart/payment','App\Controllers\CartController@checkout','handle_payment');
