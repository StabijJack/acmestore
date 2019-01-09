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
    public function get($id)
    {
        $product = Product::where('id',$id)->with(['category','subCategory'])->first();
        if ($product) {
            echo json_encode([
                'product' => $product,
                'category' => $product->category,
                'subCategory' => $product->subCategory
            ]);
            exit;
        }
        header('HRRP/1.1 422 Unprocessable Entity', true, 422);
        echo 'product not found';
        exit;
    }
}