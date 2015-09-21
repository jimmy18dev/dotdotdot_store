function AddItemToOrder(product_id){
    var href = 'api.order.php';
    var amount = $('#amount').val();
    
    if(!amount){amount = 1;}

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

function EditItemInOrder(order_id,product_id){
    var href = 'api.order.php';
    var amount = $('#product-amount-'+order_id+product_id).val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'EditInOrder',
            amount              :amount,
            order_id            :order_id,
            product_id          :product_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
    }).error();
}

function RemoveItemInOrder(order_id,product_id){
    var href = 'api.order.php';

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'RemoveInOrder',
            order_id            :order_id,
            product_id          :product_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
        $('#items-in-order-'+product_id).fadeOut();
    }).error();
}

function OrderProcess(order_id,order_action){
    var href = 'api.order.php';
    var shipping_type = $('#shipping_type').val();

    console.log(order_id+','+order_action+','+shipping_type);

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
            order_shipping_type :shipping_type,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
        location.reload();
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
        $('#amount').html(data.data.amount);
        $('#payments').html(data.data.payments);
    }).error();
}