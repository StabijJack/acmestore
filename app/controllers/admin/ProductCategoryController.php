<?php

namespace App\Controllers\Admin;

use App\Models\Category;


class ProductCategoryController
{
    public function show()
    {
        $categories = Category::all();
    }
    public function store()
    {
        
    }
    
}