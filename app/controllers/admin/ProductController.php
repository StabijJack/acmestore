<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Session;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\SubCategory;


class ProductController extends BaseController
{
    public $table_name = 'products';
    public $categories;
    public $subcategories;
    public $subcategories_links;
    public $links;
    public function __construct()
    {
        $this->categories = Category::all();
        // list($this->categories, $this->links) = paginate(3, $total, $this->table_name, $object);
        // list($this->subcategories, $this->subcategories_links) = paginate(3, $subTotal, "sub_categories", new SubCategory);
    }
    public function showCreatePruductForm()
    {
        $categories = $this->categories;
        return view('admin/product/create',compact('categories'));
    }
    public function store()
    {
        if(Request::has('post')){
            $request = Request::get('post');
            if (CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [ 
                    'name'=>[
                        'required'=> true,
                        'minLength'=> 3,
                        'maxLength'=> 70,
                        'string'=> true,
                        'unique'=> $this->table_name
                    ],
                    'price'=>[
                        'required'=> true,
                        'minLength'=> 2,
                        'number'=> true,
                    ],
                    'quantity'=>[
                        'required'=> true
                    ],
                    'category'=>[
                        'required'=> true
                    ],
                    'subcategory'=>[
                        'required'=> true
                    ],
                    'description'=>[
                        'required'=> true,
                        'mixed'=>true,
                        'minLength'=> 4,
                        'maxLength'=> 500
                    ]
                ];
                $validate = new ValidateRequest;
                $validate->abide($_POST, $rules);

                $file = Request::get('file');
                $filename = $file->productImage->name;
                if(empty($file->productImage->name)){
                    $file_error['productImage'] = ['The productImage is required' ];
                }
                else{
                    if(!UploadFile::isImage($filename)){
                        $file_error['productImage'] = ['The Image is invalid, please try again.' ];
                    }
                }

                if ($validate->hasError())  {
                    $response = $validate->getErrorMessages();
                    count($file_error)? $errors = array_merge($response,$file_error) : $errors = $response;
                    return view('admin/product/categories',[
                        'categories' => $this->categories,
                        'errors' => $errors,
                    ]);
                }
                Category::create([
                    'name'=> $request->name,
                    'slug'=> slug($request->name)
                ]);
                $this->__construct();
                $message = 'Category Created';
                return view('admin/product/categories',[
                    'categories' => $this->categories,
                    'links' => $this->links,
                    'success' => 'Category Created',
                    'subcategories' => $this->subcategories,
                    'subcategories_links' => $this->subcategories_links
                ]);
                    }
        }
        throw new \Exception('Token mismatch');
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
                $subcategories = SubCategory::where('category_id', $id)->get();
                if(count($subcategories)){
                    foreach ($subcategories as $subcategory) {
                        $subcategory->delete();
                    }
                }
                Session::add('success', 'Category Deleted');
                Redirect::to('/admin/product/categories');
            }
            else{
                throw new \Exception('Token mismatch');
            }
        }
    }
    public function getSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        echo json_encode($subcategories);
    }
}