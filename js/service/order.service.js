function AddItemToOrder(product_id){
    var href = 'api.order.php';
    var amount = $('#amount').val();

    console.log('Send:: '+product_id+' ,amount: '+amount);

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'AddToOrder',
            amount              :amount,
            product_id          :product_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
        MyCurrentOrder();
    }).error();
}

function OrderProcess(order_id,order_action){
    var href = 'api.order.php';

    console.log(order_id+order_action);

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'OrderProcess',
            order_id            :order_id,
            order_action        :order_action,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
    }).error();
}

function MyCurrentOrder(){
    var href = 'api.order.php';

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"GET",
        data:{
            calling             :'Order',
            action              :'MyCurrentOrder',
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.apiVersion);
        $('#amount').html(data.data.amount);
        $('#payments').html(data.data.payments);
    }).error();
}