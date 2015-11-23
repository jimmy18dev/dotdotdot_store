function ReadUpdate(){

    $('#loading-status').fadeIn(500);
    var href = 'api.product.php';
    var product_id = $('#product_id').val();

    console.log('product_id: '+product_id);

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
        console.log('Return: '+data.message);
        $('#loading-status').delay(2000).fadeOut(500);
    }).error();
}