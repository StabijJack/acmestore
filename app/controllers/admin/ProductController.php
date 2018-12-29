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
use App\Classes\UploadFile;
use App\Models\Product;


class ProductController extends BaseController
{
    public $table_name = 'products';
    public $products;
    public $categories;
    public $links;
    public function __construct()
    {
        $this->categories = Category::all();
        $total = Product::all()->count();
        list($this->products, $this->links) = paginate(10, $total, $this->table_name, new Product);
    }
    public function show()
    {
       
        $products = $this->products;
        $links = $this->links;
        return view('admin/product/inventory',compact('products', 'links'));
    }
    public function showCreateProductForm()
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
                isset($file->productImage->name)? $filename = $file->productImage->name:$filename = '';
                $file_error =[];
                if(empty(filename)){
                    $file_error['productImage'] = ['The productImage is required' ];
                }
                else{
                    if(!UploadFile::isImage($filename)){
                        $file_error['productImage'] = ['The Image is invalid, please try again.' ];
                    }
                }

                if ($validate->hasError())  {
                    $response = $validate->getErrorMessages();
                    count($file_error)? $errors = array_merge($response, $file_error) : $errors = $response;
                    return view('admin/product/create',[
                        'categories' => $this->categories,
                        'errors' => $errors,
                    ]);
                }
                $ds = DIRECTORY_SEPARATOR;
                $temp_file = $file->productImage->tmp_name;
                $image_path = UploadFile::move($temp_file,"images{$ds}uploads{$ds}products",$filename)->path();
                Product::create([
                    'name'=> $request->name,
                    'description'=> $request->description,
                    'price'=> $request->price,
                    'category_id'=> $request->category,
                    'sub_category_id'=> $request->subcategory,
                    'image_path'=> $image_path,
                    'quantity'=> $request->quantity,
                ]);
                Request::refresh();
                return view('admin/product/create',[
                    'categories' => $this->categories,
                    'success'  => 'Record Created'
                ]);
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