@extends('admin.layout.base') 
@section('title', 'Manage Inventory') 
@section('data-page-id', 'adminProduct') 
@section('content')
<div class="products admin_shared">
    <div class="row expanded">
        <div class="column medium-11">
            <h2>Manage Inventory Items</h2>
            <hr>
        </div>
    </div>
    @include('includes.message')
    <div class="row expanded">
        <div class="small-12 medium-11 column">
            <a href="/admin/product/create" class="button float-right">
                <i class="fa fa-plus"></i> Add new Product
            </a>
        </div>
    </div>
    <div class="row expanded">
        <div class="column small-12 medium-11">
            @if(count($products))
            <table class="hover unstriped" data-form='deleteForm'>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Date Created</th>
                        <th width="70">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="/{{ $product['image_path'] }}" alt="{{ $product['name'] }}" heigth="40" width="40">
                        </td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['price'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['category_name'] }}</td>
                        <td>{{ $product['sub_category_name'] }}</td>
                        <td>{{ $product['added'] }}</td>
                        <td width="70" class="text-right">
                            <span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover="false" tabindex="1" title="Edit a product.">
                                <a href="/admin/product/{{ $product['id'] }}/edit">Edit <i class="fa fa-edit"></i></a>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $links !!} @else
            <h2>You have not created any product</h2>
            @endif

        </div>
    </div>
</div>
@endsection