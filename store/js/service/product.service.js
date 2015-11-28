function SetCover(product_id,image_id){
    // URL API
    var href = 'api.product.php';

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Product',
            action              :'SetCover',
            product_id          :product_id,
            image_id            :image_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        location.reload();
    }).error();
}

function UpdateQuantity(){
    // URL API
    var href = 'api.product.php';
    var product_id = $('#product_id').val();
    var quantity = $('#quantity').val();
    var product_action = $('#action').val();

    console.log(product_id+','+product_action+','+quantity);

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Product',
            action              :'UpdateQuantity',
            product_id          :product_id,
            quantity            :quantity,
            product_action      :product_action,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Message:'+data.message+' Execute:'+data.execute);
        setTimeout(function(){window.location = 'product.php';},2000);
    }).error();
}

function RemovePhoto(product_id,image_id){
    // URL API
    var href = 'api.product.php';

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Product',
            action              :'DeletePhoto',
            product_id          :product_id,
            image_id            :image_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        $('#image-'+image_id).hide(500);
    }).error();
}

function ChangeStatus(product_id,status){
    // URL API
    var href = 'api.product.php';

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Product',
            action              :'ChangeStatus',
            product_id          :product_id,
            status              :status,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Message:'+data.message+' Execute:'+data.execute+' Return:'+data.return);

        // value return
        if(data.return == "active"){
            $('#status-'+product_id).addClass('status-active').html('<i class="fa fa-circle"></i> แสดง');
            $('#product-'+product_id).removeClass('product-items-disable');
        }
        else if(data.return == "disable"){
            $('#status-'+product_id).removeClass('status-active').html('<i class="fa fa-circle"></i> ไม่แสดง');
            $('#product-'+product_id).addClass('product-items-disable');
        }

    }).error();
}


// function DeleteProduct(product_id){

//     // Confirm checking
//     var del = confirm('คุณกำลังจะลบ '+ product_id +' ใช่หรือไม่ ?');
//     if(!del){return false;}

//     // URL API
//     var href = 'api.product.php';

//     var member_id       = $('#member_id').val();
//     var token           = $('#token').val();

//     $.ajax({
//         url         :href,
//         cache       :false,
//         dataType    :"json",
//         type        :"POST",
//         data:{
//             calling             :'Product',
//             action              :'DeleteProduct',
//             product_id         :product_id,
//             member_id           :member_id,
//             token               :token,
//         },
//         error: function (request, status, error) {
//             console.log("Request Error");
//         }
//     }).done(function(data){
//         console.log('Message:'+data.message+' Execute:'+data.execute);

//         setTimeout(function(){window.location = 'product.php';},3000);

//     }).error();
// }