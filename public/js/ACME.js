(function () {
    'use strict';
    window.ACMESTORE ={
        global: {},
        admin: {},
        homeslider:{},
        product: {}
    };
})();
(function (){
    'use strict'
    ACMESTORE.product.cart = function (){
        var app = new Vue({
            el: '#shopping_cart',
            data:{
                items:[],
                cartTotal:[],
                loading: false,
                fail: false,
                message: '' 
            },
            methods: {
                displayItems: function (time) {
                    this.loading = true;
                    setTimeout(function (){
                        axios.get('/cart/items').then(function (response){
                            if(response.data.fail){
                                app.fail = true;
                                app.message = response.data.fail;
                                app.loading =false;
                            }
                            else {
                                app.items = response.data.items;
                                app.cartTotal = response.data.cartTotal;
                                app.loading =false;
                            }
                        });
                    }, time);
                },
                updateQuantity: function (product_id, operator){
                    var postData = $.param({product_id:product_id, operator:operator});
                    axios.post("/cart/update-qty", postData).then(function(response){
                        app.displayItems(200);
                    });
                },
                removeItem: function (index){
                    var postData = $.param({item_index:index})
                    axios.post("/cart/remove-item", postData).then(function(response){
                        $(".notify").css('display', 'block').delay(4000).slideUp(300)
                        .html(response.data.succes);
                        app.displayItems(200);
                    });

                }

            },
            created: function (){
                this.displayItems(2000)
            }
        });
    }
})();
(function(){
    'use strict';
    ACMESTORE.homeslider.homePageProducts = function(){
        var app = new Vue({
            el: '#root',
            data: {
                featured:[],
                products:[],
                count: 0,
                loading: false
            },
            methods:{
                getFeaturedProducts: function (){
                    this.loading = true;
                    axios.all(
                        [
                            axios.get('/featured'),
                            axios.get('/get-products')
                        ]
                    ).then(axios.spread(function(featuredResponse, productResponse){
                        app.featured = featuredResponse.data.featured;
                        app.products = productResponse.data.products;
                        app.count = productResponse.data.count;
                        app.loading = false;
                    }))
                },
                stringLimit: function(string, value){
                    return ACMESTORE.module.truncateString(string, value);
                },
                addToCart: function(id){
                    ACMESTORE.module.addItemToCart(id, function(message){
                        $(".notify").css('display', 'block').removeClass('alert')
                        .addClass('primary').delay(4000).slideUp(300).html(message);
                    });
                },

                loadMoreProducts: function(){
                    var token = $('.display-products').data('token');
                    this.loading = true;
                    var data = $.param({next: 2, token: token, count: app.count});
                    axios.post('/load-more', data) 
                        .then(function (response){
                            app.products = response.data.products;
                            app.count = response.data.count;
                            app.loading = false;
                        }
                    )
                }
            },
            created: function(){
                this.getFeaturedProducts();
            },
            mounted: function(){
                $(window).scroll(function(){
                    if($(window).scrollTop() + $(window).height() == $(document).height()){
                        app.loadMoreProducts();
                    }
                })
            }
        });
    }
})();
(function (){
    'use strict'
    ACMESTORE.module = {
        truncateString: function limit(string, value){
            if (string.length > value){
                return string.substring(0,value)+ '...';
            }else{
                return string;
            }

        },
        addItemToCart: function(id, callback){
            var token =$('.display-products').data('token');
            if(token == null || !token){
                token =$('.product').data('token');
            }
            var postData = $.param({
                product_id: id,
                token: token
            });
            axios.post('/cart', postData).then(function (response) {
                callback(response.data.succes)
            });
        }
    }
})();
(function(){
    'use strickt';
    ACMESTORE.product.details = function () {
        var app = new Vue({
            el: '#product',
            data:{
                product: [],
                category:[],
                subCategory: [],
                productId: $('#product').data('id'),
                loading: false
            },
            methods:{
                getProductDetails: function (){
                    this.loading = true;
                    setTimeout(
                        function(){
                            axios.get('/product-details/' + app.productId
                            ).then(
                                function (response) {
                                    app.product = response.data.product;
                                    app.category = response.data.category;
                                    app.subCategory = response.data.subCategory;
                                    app.similarProducts = response.data.similarProducts;
                                    app.loading = false;
                                }
                            );
                        }, 
                        1000
                    );
                },
                stringLimit: function(string, value){
                    return ACMESTORE.module.truncateString(string, value);
                },
                addToCart: function(id){
                    ACMESTORE.module.addItemToCart(id, function(message){
                        $(".notify").css('display', 'block').removeClass('alert')
                        .addClass('primary').delay(4000).slideUp(300).html(message);
                    });
                }
            },
            created: function () {
                this.getProductDetails();
            }
        });
    }
})();
(function(){
    'use strict';
    ACMESTORE.homeslider.initCarousel = function(){
        $('.hero-slider').slick({
            slidesToShow: 1,
            autoplay: true,
            arrows: false,
            dots: false,
            fad: true,
            autoplayHoverPause: true,
            slideToScroll: 1
        });
    }
})();
(function () {
    'use strict';
    ACMESTORE.admin.create = function(){
        $(".add-subcategory").on('click', function(e){
            var token =  $(this).data('token');
            var category_id = $(this).attr('id');
            var name = $("#subcategory-name-"+ category_id).val();
            $.ajax({
                type: 'POST',
                url: '/admin/product/subcategory/create',
                data:{
                    token: token,
                    name: name,
                    category_id: category_id
                },
                success: function(data){
                    var response = $.parseJSON(data);
                    $(".notification").css('display', 'block').removeClass('alert')
                    .addClass('primary').delay(4000).slideUp(300).html(response.success);
                },
                error: function(request, error){
                    var errors = $.parseJSON(request.responseText);
                    var ul = document.createElement('ul');
                    $.each(errors,function(key,value){
                        var li = document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $(".notification").css('display', 'block').removeClass('primary')
                        .addClass('alert').delay(6000).slideUp(300)
                        .html(ul);
                }
            });

            e.preventDefault();
        });
    };
})();
(function () {
    'use strict';
    ACMESTORE.admin.delete = function(){
        $('table[data-form="deleteForm"]').on('click','.delete-item', function(e){

            e.preventDefault();
            var form = $(this);
            $('#confirm').foundation('open').on('click',' #delete-btn',function(){
                form.submit();
            });
        });
    };
})();
(function () {
    'use strict';
    ACMESTORE.admin.changeEvent = function(){
        $('#product-category').on('change', function() {
            var category_id = $('#product-category' + ' option:selected').val();
            $('#product-subcategory').html('Select Subcategory');
            $.ajax({
                type: 'GET',
                url: '/admin/category/' + category_id  + "/selected",
                data:{
                    category_id: category_id
                },
                success: function(response){
                    var subcategories = $.parseJSON(response);
                    if(subcategories.length){
                        $.each(subcategories, function (key, value) {
                            $('#product-subcategory').append(
                                '<option value="' + value.id +'">' + value.name + '</option>'
                            );
                        })
                        }
                        else {
                            $('#product-subcategory').append(
                                '<option value="">No record found.</option>');
                    }
                }
            });
        }) 
    }
})();
(function () {
    'use strict';
    ACMESTORE.admin.update = function(){
        $(".update-category").on('click', function(e){
            var token =  $(this).data('token');
            var id = $(this).attr('id');
            var name = $("#item-name-"+ id).val();
            $.ajax({
                type: 'POST',
                url: '/admin/product/categories/'+ id + '/edit',
                data:{
                    token: token,
                    name: name
                },
                success: function(data){
                    var response = $.parseJSON(data);
                    $(".notification").css('display', 'block').removeClass('alert')
                    .addClass('primary').delay(4000).slideUp(300).html(response.success);
                },
                error: function(request, error){
                    var errors = $.parseJSON(request.responseText);
                    var ul = document.createElement('ul');
                    $.each(errors,function(key,value){
                        var li = document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $(".notification").css('display', 'block').removeClass('primary')
                        .addClass('alert').delay(6000).slideUp(300)
                        .html(ul);
                }
            });

            e.preventDefault();
        });
        $(".update-subcategory").on('click', function(e){
            var token =  $(this).data('token');
            var id = $(this).attr('id');
            var category_id = $(this).data('category_id');
            var name = $("#item-subcategory-name-"+ id).val();
            var selected_category_id = $('#item-category-' + category_id + ' option:selected').val();
            if(category_id !== selected_category_id){
                category_id = selected_category_id;
            }
            $.ajax({
                type: 'POST',
                url: '/admin/product/subcategory/'+ id + '/edit',
                data:{
                    token: token,
                    name: name,
                    category_id: category_id
                },
                success: function(data){
                    var response = $.parseJSON(data);
                    $(".notification").css('display', 'block').removeClass('alert')
                    .addClass('primary').delay(4000).slideUp(300).html(response.success);
                },
                error: function(request, error){
                    var errors = $.parseJSON(request.responseText);
                    var ul = document.createElement('ul');
                    $.each(errors,function(key,value){
                        var li = document.createElement('li');
                        li.appendChild(document.createTextNode(value));
                        ul.appendChild(li);
                    });
                    $(".notification").css('display', 'block').removeClass('primary')
                        .addClass('alert').delay(6000).slideUp(300)
                        .html(ul);
                }
            });

            e.preventDefault();
        });
    };
})();
(function () {
    'use strict';
    $(document).foundation();
    $(document).ready(function (){
        switch($("body").data("page-id")){
            case 'home':
                ACMESTORE.homeslider.initCarousel();
                ACMESTORE.homeslider.homePageProducts();
                break;
            case 'product':
                ACMESTORE.product.details();
                break;
            case 'cart':
                ACMESTORE.product.cart();
                break;
            case 'adminProduct':
                ACMESTORE.admin.changeEvent();
                ACMESTORE.admin.delete();
                break;
            case 'adminCategories':
                ACMESTORE.admin.update();
                ACMESTORE.admin.delete();
                ACMESTORE.admin.create();
                break;
            default:
        }
    });
})();