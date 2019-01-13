<?php

namespace App\Controllers;
use App\Classes\CSRFToken;
use App\classes\Request;
use App\classes\Cart;

class CartController extends BaseController
{
    public function addItem()
    {
        if(Request::has('post')){
            $request= Request::get('post');
            if(CSRFToken::verifyCSRFToken($request->token, false)){
                if(!$request->product_id){
                    throw new \Exception('Malicious Activity');
                }
                Cart::add($request);
                echo json_encode(['succes' => 'Product added to cart succesfully']);
                exit;
            }
        }
    }
}