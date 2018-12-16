<?php

require_once __DIR__ . '/../bootstrap/init.php';
$app_name = getenv('APP-Name');

use Illuminate\Database\Capsule\Manager as Capsule;
$user = Capsule::table('categories')->where('id', 1)->first();
var_dump($user);
