<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Classes\Session;

class DashboardController extends BaseController
{
    public function show()
    {
        Session::add('Admin', 'You are welcome');
        Session::remove('Admin');
        if (Session::has('Admin')){
            $msg = Session::get('Admin');
        }
        else {
            $msg='not defined';
        }
        view('admin/dashboard',['admin'=> $msg]);
    }
}