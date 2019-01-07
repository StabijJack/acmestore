<?php

namespace App\Controllers;
use App\Models\Product;
use App\Classes\CSRFToken;
use App\classes\Request;

class ProductController extends BaseController
{
    public function show($id)
    {
       $product=Product::where('id', $id)->first();
        $token = CSRFToken::_token();
        return view('product', compact('product', 'token'));
    }
}