function AddItemToOrder(product_id){
    // Clear animation
    $('#buy-button-price-'+product_id).removeClass('pulse');
    $('#buy-button-msg-'+product_id).html('<i class="fa fa-spinner fa-spin"></i>');

    var href = 'api.order.php';
    var amount = 1;

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
        console.log('Return: '+data.message+','+data.return);

        $('#buy-button-'+product_id).html('<i class="fa fa-check"></i>ชำระเงิน');

        // Add animation
        $('#buy-button-'+product_id).addClass('pulse buy-btn-active');

        if(data.message){
            MyCurrentOrder();
        }
        else{
            window.location='order-'+data.return+'.html';
        }

    }).error();
}

function EditItemInOrder(order_id,product_id){
    var href = 'api.order.php';
    var quantity = $('#product-quantity-'+order_id+product_id).val();
    var $paying_btn = $('#paying-button');

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'EditInOrder',
            amount              :quantity,
            order_id            :order_id,
            product_id          :product_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Message: '+data.message+' Return:'+data.return);

        if(data.return){
            $('#product-quantity-'+order_id+product_id).removeClass('fail');
            $paying_btn.show();
        }
        else{
            $('#product-quantity-'+order_id+product_id).addClass('fail');

            // Include alert.app.js
            $paying_btn.hide();
            ToggleAlert('<i class="fa fa-quote-left"></i>สินค้าไม่พอ!<i class="fa fa-quote-right"></i>');
        }
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
        $('#items-in-order-'+product_id).slideUp();
        MyCurrentOrder();
    }).error();
}

function OrderProcess(order_id,order_action){
    var href = 'api.order.php';
    var shipping_type = $('#shipping_type').val();
    
    $('#dialog-box').fadeIn(300);

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
        console.log(data.message);
        location.reload();
    }).error();
}

function MyCurrentOrder(){
    var href = 'api.order.php';
    $('#my-cart').removeClass('pulse');

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
        var payments = numeral(data.data.payments).format('0,0.00');
        $('#my-cart').addClass('pulse');
        $('#amount').html(data.data.amount);
        $('#payments').html(payments+' ฿');

        if(data.data.payments > 0){
            $('#my-cart i').addClass('animated infinite pulse');
        }
        else{
            $('#my-cart i').removeClass('animated infinite pulse');   
        }
    }).error();
}


// Edit Name, Address, Phone number in Order
function EditAddress(order_id){
    var href = 'api.order.php';

    var realname        = $('#customer_name').val();
    var address     = $('#customer_address').val();
    var phone       = $('#customer_phone').val();

    $('#dialog-box').fadeIn(300);

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'EditAddress',
            order_id            :order_id,
            realname            :realname,
            address             :address,
            phone               :phone,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Message: '+data.message+' Return:'+data.return);
        setTimeout(function(){window.location = 'order-'+order_id+'.html';},1000);
    }).error();
}

function CencelTransfer(order_id){
    var href = 'api.order.php';

    $('#dialog-box').fadeIn(300);

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'CancelTransfer',
            order_id            :order_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Message: '+data.message+' Return:'+data.return);
        setTimeout(function(){window.location = 'order-'+order_id+'.html';},1000);
    }).error();
}