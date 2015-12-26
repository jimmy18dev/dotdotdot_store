function AddCart(product_id){

    $('#buy-button').html('รอสักครู่<i class="fa fa-spinner fa-spin"></i>');

    var product_id = $('#product_id').val();
    var subproduct_id = $('#subproduct_id').val();

    if(subproduct_id){
        product_id = subproduct_id
    }

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

        // Add animation
        $('#buy-button').html('ชำระเงินตอนนี้<i class="fa fa-arrow-right"></i>').addClass('buy-btn-active');
        
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
            // ToggleAlert('<i class="fa fa-quote-left"></i>สินค้าไม่พอ!<i class="fa fa-quote-right"></i>');
        }
    }).error();
}

function RemoveItemInOrder(order_id,product_id){
    var href = 'api.order.php';

    var del = confirm('คุณต้องการลบสินค้าออกจากตะกร้าใช่หรือไม่?');
    if(!del){return false;}

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
        $('#items-in-order-'+product_id).remove();

        MyCurrentOrder();
        SummaryPayments();
    }).error();
}

function OrderProcess(order_id,order_action){
    var href = 'api.order.php';
    var shipping_type = $('#shipping_type').val();

    $('#dialog-message').html('กำลังส่งคำสั่งซื้อ่...');
    $('#dialog-box').fadeIn(300);
    console.log('OrderProcess() with '+order_id+','+order_action);

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

    var realname    = $('#customer_name').val();
    var address     = $('#customer_address').val();
    var phone       = $('#customer_phone').val();

    $('#dialog-message').html('กำลังบันทึก...');
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
        setTimeout(function(){window.location = 'order-'+order_id+'.html';},300);
    }).error();
}

function CencelTransfer(order_id){
    var href = 'api.order.php';

    $('#dialog-message').html('กำลังยกเลิกการโอนเงิน...');
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
        setTimeout(function(){window.location = 'order-'+order_id+'.html';},300);
    }).error();
}