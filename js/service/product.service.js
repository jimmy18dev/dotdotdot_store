function ReadUpdate(){
    $('#loading-status').fadeIn(500);
    var href = 'api.product.php';
    var product_id = $('#product_id').val();

    //console.log('product_id: '+product_id);

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Product',
            action              :'ReadUpdate',
            product_id          :product_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        //console.log('Return: '+data.message);
        $('#loading-status').delay(2000).fadeOut(500);
    }).error();
}

function GetProductInfo(){
    var href = 'api.product.php';
    var product_id = $('#product_id').val();
    var subproduct_id = $('#subproduct_id').val();

    if(subproduct_id){
        product_id = subproduct_id
    }

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"GET",
        data:{
            calling             :'Product',
            action              :'ProductData',
            product_id          :product_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        if(data.data.items.pd_description != ""){
            $('#subproduct_info').html(data.data.items.pd_description);
        }

        // items's empty.
        if(data.data.items.pd_quantity > 1){
            // have items in order
            if(data.data.items.odt_id != null){
                console.log(product_id+' already in order! '+data.data.items.odt_id);
                $('#buy-button').html('ชำระเงินตอนนี้<i class="fa fa-arrow-right"></i>').addClass('buy-btn-active');
            }
            else{
                console.log(product_id+' i have this product.');
                $('#buy-button').html('ใส่ตะกร้า<i class="fa fa-cart-plus">').removeClass('buy-btn-disable buy-btn-active');
            }
        }
        else{
            console.log(product_id+' product empty!');
            $('#buy-button').html('สินค้าหมด').addClass('buy-btn-disable');
        }

        // console.log('in order: '+data.data.items.odt_id);
    }).error();
}