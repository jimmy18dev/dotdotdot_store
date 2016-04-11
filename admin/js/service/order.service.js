function OrderProcess(order_id,order_action){
    var href = 'api.order.php';
    $('#dialog-message').html('กำลังดำเนินการ...');
    $('#dialog-box').fadeIn(300);

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
        
        $('#alert').fadeIn(500);
        location.reload();
    }).error();
}

function EmsUpdate(order_id){
    var href = 'api.order.php';
    $('#dialog-message').html('กำลังดำเนินการ...');
    $('#dialog-box').fadeIn(300);

    var ems = $('#ems').val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Order',
            action              :'EmsUpdate',
            order_id            :order_id,
            ems                 :ems,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
        
        $('#alert').fadeIn(500);
        location.reload();
    }).error();
}