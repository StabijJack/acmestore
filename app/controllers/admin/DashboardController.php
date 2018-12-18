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
        Session::remove('Admin');
        if (Session::has('Admin')){
            $msg = Session::get('Admin');
        }
        else {
            $msg='not defined';
        }

        $beforeToken = CSRFToken::_token();
        $afterToken = Session::get('token');
        // Redirect::to('/');
        view('admin/dashboard',['admin'=> $msg, 'beforeToken'=>$beforeToken, 'afterToken'=>$afterToken]);
    }
    public function get()
    {
        $request = Request::get('post');
        var_dump( $request );

    }
}