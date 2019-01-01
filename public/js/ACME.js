(function () {
    'use strict';
    window.ACMESTORE ={
        global: {},
        admin: {},
        homeslider:{}
    };
})();
(function(){
    'use strict';
    ACMESTORE.homeslider.homePageProducts = function(){
        var app = new Vue({
            el: '#root',
            data: {
                featured:[],
                loading: false
            },
            methods:{
                getFeaturedProducts: function (){
                    this.loading = true;
                    axios.get('/featured').then(function(response){
                        console.log(response.data);
                        app.featured = response.data.featured;
                        app.loading = false;
                    })
                }
            },
            created: function(){
                this.getFeaturedProducts();
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