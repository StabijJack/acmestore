@extends('layouts.app') 
@section('title','Your shopping cart')
@section('data-page-id', 'cart') 
@section('content')
    <div class="shopping_cart" id="shopping_cart" style="padding: 6rem">
        <div class="text-center">
            <img v-show="loading" src="/images/loading.gif">
        </div>
        <section class="items" v-if="loading == false">
            <div class="row">
                <div class="small-12">
                    <h2 v-if="fail" v-text="message"> </h2>
                    <div v-else>
                        <h2>Your Cart</h2>
                        <table class="hover unstriped">
                            <thead class="text-left">
                                <tr><th>#</th><th>Product Name</th><th>($) Unit Price</th><th>Qty</th><th>TotalPrice</th><th>Action</th></tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items">
                                    <td class="medium-text-center">
                                        <a :href="'/product/' + item.id">
                                            <img :src="'/' + item.image" height="60px" width="60px" alt="item.name">
                                        </a>
                                    </td>
                                    <td>
                                        <h5><a :href="'/product/' + item.id">@{{ item.name }}</a></h5>
                                        Status: 
                                        <span v-if="item.stock > 1" style="color: green;">In Stock</span>
                                        <span v-else style="color: red;">Out of Stock</span>
                                    </td>
                                    <td>@{{ item.price }}</td>
                                    <td>
                                        @{{ item.quantity }}
                                        <button @click="updateQuantity(item.id, '+')" style="cursor: pointer; color: green;">
                                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                                        </button>
                                        <button @click="updateQuantity(item.id, '-')" style="cursor: pointer; color: red;">
                                            <i class="fa fa-minus-square" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td>@{{ item.total }}</td>
                                    <td class="text-center">
                                        <button>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tr>
                                <td valign="top">
                                    <div class="input-group">
                                        <input type="text" name="coupon" class="input-group-field" placeholder="coupon code">
                                        <div class="input-group-button">
                                            <button class="button">Apply</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <table class="unstriped">
                                        <tr>
                                            <td><h6>Subtotal:</h6></td>
                                            <td class="text-right"><h6>$@{{ cartTotal }}</h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6>Discount Amount:</h6></td>
                                            <td class="text-right"><h6>$0.00</h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6>Tax:</h6></td>
                                            <td class="text-right"><h6>$0.00</h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6>Total:</h6></td>
                                            <td class="text-right"><h6>$@{{ cartTotal }}</h6></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div class="text-right">
                            <a href="/" class="button secondary">
                                Continue shopping &nbsp; <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                            <button type="submit" class="button succes">
                                Checkout &nbsp; <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
