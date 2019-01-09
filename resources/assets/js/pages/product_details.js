(function(){
    'use strickt';
    ACMESTORE.product.details = function () {
        var app = new Vue({
            el: '#product',
            data:{
                product: [],
                category:[],
                subCatagory: [],
                productId: $('#product').data('id'),
                loading: false
            }
        });
    }
})();