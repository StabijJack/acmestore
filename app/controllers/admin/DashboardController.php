<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\classes\Redirect;
use App\classes\ReQuest;

class DashboardController extends BaseController
{
    public function show()
    {
        Session::add('Admin', 'You are welcome');
        if (Session::has('Admin')){
            $msg = Session::get('Admin');
        }
        else {
            $msg='not defined';
        }

        view('admin.dashboard',['admin'=> $msg]);
    }
    public function get()
    {
        Request::refresh();
        $data = Request::old('file','image');
        var_dump($data);
    }
}