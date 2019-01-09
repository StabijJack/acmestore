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
                            axios.get('/product-details/' + this.productId
                            ).then(
                                function (response) {
                                    app.product = response.data.product;
                                    app.category = response.data.category;
                                    app.subCategory = response.data.subCategory;
                                    app.loading = false;
                                }
                            );
                        }, 
                        1000
                    );
                },
                stringLimit: function(string, value){
                    if (string.length > value){
                        return string.substring(0,value)+ '...';
                    }else{
                        return string;
                    }
                },
            },
            created: function () {
                this.getProductDetails();
            }
        });
    }
})();