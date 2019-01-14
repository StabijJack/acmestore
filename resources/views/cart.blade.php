@extends('layouts.app') 
@section('title','Your shopping cart')
@section('data-page-id', 'cart') 
@section('content')
    <div class="shopping_cart" id="shopping_cart" style="padding: 6rem">
        <div class="text-center">
            <img v-show="loading" src="/images/loading.gif">
        </div>

    </div>
@endsection
