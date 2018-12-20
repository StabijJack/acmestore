<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;


class ProductCategoryController
{
    public $table_name = 'categories';
    public function show()
    {
        $total = Category::all()->count();
        $object = new Category;
        list($categories, $links) = paginate(3, $total, $this->table_name, $object);
        return view('admin/products/categories',compact('categories', 'links'));
    }
    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if (CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [ 
                    'name'=>[
                        'required'=> true,
                        'maxlength'=> 5,
                        'string'=> true,
                        'unique'=> 'categories'
                        ]
                    ];
                    $validate = new ValidateRequest;
                    $validate->abide($_POST, $rules);
                    if ($validate->hasError())  {
                        var_dump($validate->getErrorMessages());
                        exit;
                    }
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