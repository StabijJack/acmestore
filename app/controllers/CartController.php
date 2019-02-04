<?php

namespace App\Controllers;
use App\Classes\CSRFToken;
use App\classes\Request;
use App\classes\Cart;
use App\Classes\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use Stripe\Customer;
use Stripe\Charge;

class CartController extends BaseController
{
    public function show()
    {
        return view('cart');
    }
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
    public function getCartItems()
    {
        try {
            $result = [];
            $cartTotal = 0;
            if(!Session::has('user_cart') || count(Session::get('user_cart')) < 1){
                echo json_encode(['fail' => "No item in the cart"]);
                exit;
            }
            $index = 0;
            foreach ($_SESSION['user_cart'] as $cardItem) {
                $productId = $cardItem['product_id'];
                $quantity = $cardItem['quantity'];
                $item = Product::where('id', $productId)->first();
                if(!$item){continue;}
                $totalPrice = $item->price * $quantity;
                $cartTotal = $totalPrice + $cartTotal;
                $totalPrice = number_format($totalPrice, 2);
                array_push($result, [
                    'id' => $item->id,
                    'name' => $item->name,
                    'image' => $item->image_path,
                    'description' => $item->description,
                    'price' => $item->price,
                    'total' => $totalPrice,
                    'quantity' => $quantity,
                    'stock' => $item->quantity,
                    'index' => $index
                ]);
                $index++;
            }
            $cartTotal = number_format($cartTotal, 2);
            Session::add('cartTotal', $cartTotal);
            echo json_encode([
                'items' => $result, 
                'cartTotal' => $cartTotal, 
                'authenticated' => isAuthenticated(),
                'amountInCents' => convertMoneyToCents($cartTotal)
            ]);
            exit;
    
        } catch (\Exception $ex) {
            //log this error
        }
    }
    public function updateQuantity()
    {
        if(Request::has('post')){
            $request= Request::get('post');
            if(!$request->product_id){
                throw new \Exception('Malicious Activity');
            }
            $index = 0;
            $quantity = '';
            foreach ($_SESSION['user_cart'] as $cartItem) {
                $index++;
                foreach ($cartItem as $key => $value) {
                    if($key == 'product_id' && $value == $request->product_id){
                        switch ($request->operator) {
                            case '+':
                                $quantity= $cartItem['quantity'] + 1;
                                break;
                            case '-':
                                $quantity= $cartItem['quantity'] - 1;
                                if($quantity < 1){
                                    $quantity = 1;
                                }
                                break;
                            
                        }
                        array_splice($_SESSION['user_cart'], $index - 1,1, array(
                            [
                                'product_id' => $request->product_id,
                                'quantity' => $quantity
                            ]
                        ));
                    }
                }
            }
        }

    }
    public function removeItem()
    {
        if(Request::has('post')){
            $request= Request::get('post');
            if($request->item_index === ''){
                throw new \Exception('Malicious Activity');
            }
            //remove item
            Cart::removeItem($request->item_index);
            echo json_encode(['succes'=> "Product removed from cart"]);
            exit;
        }
    }
    public function removeCart()
    {
        Cart::clear();
        echo json_encode(['succes'=> "Cart removed"]);
        exit;
    }
    public function checkout()
    {
        if(Request::has('post')){
            $result = array();
            $request = Request::get('post');
            $token = $request->stripeToken;
            $email = $request->stripeEmail;
            $amount = convertMoneyToCents(Session::get('cartTotal'));
            try{
                $customer = Customer::create([
                    'email'=> $email,
                    'source' => $token
                ]);

                $charge = Charge::create([
                    'customer' => $customer->id,
                    'amount' => $amount,
                    'description' => user()->fullname.'-cart purchase',
                    'currency'=> 'usd'
                ]);
                $order_no = strtoupper(uniqid());

                foreach ($_SESSION['user_cart'] as $cardItem) {
                    $productId = $cardItem['product_id'];
                    $quantity = $cardItem['quantity'];
                    $item = Product::where('id', $productId)->first();
                    if(!$item){continue;}
                    $totalPrice = $item->price * $quantity;
                    $totalPrice = number_format($totalPrice, 2);
                    order::create([
                        'user_id' => user()->id,
                        'product_id' => $productId,
                        'unit_price' => $item->price,
                        'status' => 'Pending',
                        'quantity' => $quantity,
                        'total'=>$totalPrice,
                        'order_no' => $order_no

                    ]);

                    $item->quantity -= $quantity;
                    $item->save;

                    array_push($result, [
                        'name' => $item->name,
                        'price' => $item->price,
                        'total' => $totalPrice,
                        'quantity' => $quantity,
                    ]);
                }
                Payment::create([
                    'user_id' => user()->id,
                    'amount' => $charge->amount,
                    'status' => $charge->status,
                    'order_no'=> $order_no,

                ]);

            }catch (\Exeption $ex){
                echo $ex->getMessage();
            }
            Cart::clear();
            echo json_encode(['success'=> 'Thank you']);
        }
    }
}