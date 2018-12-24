<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use App\Classes\Session;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;


class SubCategoryController extends BaseController
{
    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            $extra_errors =[];
            if (CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [ 
                    'name'=>[
                        'required'=> true,
                        'minLength'=> 3,
                        'string'=> true
                    ],
                    'category_id' =>['requires'+ true]
                ];
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                $duplicate_subcategory = SubCategory::where('name' , $request->name)
                    ->where('category_id',$request->category_id)->exists();
                if ($duplicate_subcategory ) {
                    $extra_errors['name'] = array('Subcategory already exists.');
                }

                $category = Category::where('id', $request->category_id)->exists();
                if(!$category){
                    $extra_errors['name'] = array('invalid ProductCategory.');
                }

                if ($validate->hasError() || $duplicate_subcategory || !$Category)  {
                    $errors = $validate->getErrorMessages();
                    count($extra_errors) ? $response = array_merge($errors, $extra_errors) :$response = $errors;
                        header('HTTP?1.1 422 Unprocessable Entity', true, 422);
                        echo json_encode($response);
                        exit;
                }
                Subategory::create([
                    'name'=> $request->name,
                    'slug'=> slug($request->name),
                    'category_id' => $request->category-id
                ]);
                echo json_encode(['success' => 'Subcategory created successfully.']);
            }
            throw new \Exception('Token mismatch');
        }
        return null;
    }
    public function edit($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [ 
                    'name'=>[
                        'required'=> true,
                        'minLength'=> 3,
                        'string'=> true,
                        'unique'=> 'categories'
                        ]
                ];
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);
                if ($validate->hasError())  {
                    $errors = $validate->getErrorMessages();
                    header('HTTP?1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit;
                }
                Category::where('id', $id)->update([
                    'name'=> $request->name,
                ]);
                echo json_encode(['success' => 'updated successfully']);
                exit;
            }
        }
        throw new \Exception('Token mismatch');
    }
    public function delete($id)
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if (CSRFToken::verifyCSRFToken($request->token)) {
                Category::destroy($id);
                Session::add('success', 'Category Deleted');
                Redirect::to('/admin/product/categories');
            }
            else{
                throw new \Exception('Token mismatch');
            }
        }
    }
    
}