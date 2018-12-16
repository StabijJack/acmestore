<?php

use App\Classes\ErrorHandler;
/**
 * Start session if not already started
 */
if(!isset($_SESSION)) session_start();

//load environment variable
require_once __DIR__ . '/../app/config/_env.php';
new \App\Classes\Database();
require_once __DIR__ . '/../app/routing/routes.php';
set_error_handler([new ErrorHandler(), 'handleErrors']);
new \App\RouteDispatcher($router);
