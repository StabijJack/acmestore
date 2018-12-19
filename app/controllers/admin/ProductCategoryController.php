<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;


class ProductCategoryController
{
    public function show()
    {
        $categories = Category::all();
        return view('admin/products/categories',compact('categories'));
    }
    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            // $data = ValidateRequest::minLength('name', $request->name, 6);//public static
            // $data = ValidateRequest::required('name', $request->name,true);//public static
            // $validator = new ValidateRequest; //public not static
            // $validator->unique('name','cothings' ,'categories');

            if (CSRFToken::verifyCSRFToken($request->token)) {
                Category::create([
                    'name'=> $request->name,
                    'slug'=> slug($request->name)
                ]);
                $categories = Category::all();
                $message = 'Category Created';
                return view('admin/products/categories',compact('categories', 'message'));
            }
        }
        throw new \Exception('Token mismatch');
    }
    
}