<?php
$router = new AltoRouter;
$router->map('GET','/','App\Controllers\IndexController@show','home');

//Admin
$router->map('GET','/admin','App\Controllers\Admin\DashboardController@show','admin_dashboard');
