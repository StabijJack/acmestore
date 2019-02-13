<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Classes\Session;
use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\ReQuest;
use App\Classes\Role;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Capsule\Manager as Capsule;

class DashboardController extends BaseController
{
    public function __construct(){
        if(!Role::middleware('admin')){
            Redirect::to('/login');
        };
    }
    public function show()
    {
        $orders=Order::all()->count();
        $products = Product::all()->count();
        $users = User::all()->count();
        $payments = Payment::all()->sum('amount');
        view('admin.dashboard',compact('orders', 'products', 'payments', 'users'));
    }
    public function getChartData()
    {
        $revenue = Capsule::table('payments')->select(
            Capsule::raw('sum(amount) as `amount`'),
            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            Capsule::raw('YEAR(created_at) year, Month(created_at) month')
        )->groupby('year', 'month')->get();

        $orders = Capsule::table('orders')->select(
            Capsule::raw('count(id) as `count`'),
            Capsule::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            Capsule::raw('YEAR(created_at) year, Month(created_at) month')
        )->groupby('year', 'month')->get();

        echo json_encode([
            'revenues' => $revenue,
            'orders' => $orders
        ]);
    }
}