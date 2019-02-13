(function(){
    'use strickt'
    ACMESTORE.admin.dashboard = function(){
        charts();
        setInterval(charts, 5000);
    };
    function charts(){
        var revenue = $('#revenue');
        var orders = $('#orders');
        
        var orderLabels =[];
        var revenueLabels =[];
        var orderData=[];
        var revenueData =[];

        axios.get('/admin/charts').then(
            function(response){
                response.data.orders.forEach(function(monthly){
                    orderData.push(monthly.count);
                    orderLabels.push(monthly.new_date);
                });
                response.data.revenues.forEach(function(monthly){
                    revenueData.push(monthly.amount);
                    revenueLabels.push(monthly.new_date);
                });
                new Chart(revenue,{
                    type: 'bar',
                    data:{
                        labels: revenueLabels,
                        datasets:[
                            {
                                label: '# Revenue',
                                data: revenueData,
                                backgroundColor: ["red","green", "yellow"]

                            }
                        ]
                    }
                })
                new Chart(orders,{
                    type: 'line',
                    data:{
                        labels: orderLabels,
                        datasets:[
                            {
                                label: '# Orders',
                                data: orderData,
                                backgroundColor: ["red"]
                            }
                        ]
                    }
                })
            }
        )
    };
})();