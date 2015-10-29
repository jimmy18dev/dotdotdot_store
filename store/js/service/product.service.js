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