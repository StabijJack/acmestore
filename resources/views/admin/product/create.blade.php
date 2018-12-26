@extends('admin.layout.base')
@section('title', 'Create Product')
@section('data-page-id', 'adminProduct')
@section('content')
<div class="add-product">
    <div class="row expanded">
        <div class="column medium-11">
            <h2>Add Inventory Item</h2>
            <hr>
        </div>
    </div>
    @include('includes.message')
    <form action="/admin/product/create" method="post">
        <div class="small-12 medium-11">
            <div class="row expanded">
                <div class="small-12 medium-6 column">
                    <label>Product name: 
                        <input type="text" name="name" placeholder="Product name" 
                    value="{{ \App\Classes\Request::old('post', 'name') }}">
                    </label>
                </div>
                <div class="small-12 medium-6 column">
                    <label>Product Price: 
                        <input type="text" name="price" placeholder="Product price" 
                        value="{{ \App\Classes\Request::old('post', 'price') }}">
                    </label>
                </div>
                <div class="small-12 medium-6 column">
                    <label>Product Category: 
                        <select name="category" id="product-category">
                            <option value="{{ \App\Classes\Request::old('post', 'category')?:"" }}">
                            {{ \App\Classes\Request::old('post', 'category')?:"Select Category" }}
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="small-12 medium-6 column">
                    <label>Product SubCategory: 
                        <input type="text" name="name" placeholder="Product name" 
                    value="{{ \App\Classes\Request::old('post', 'name') }}">
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>
@include('includes.delete-modal')
@endsection  