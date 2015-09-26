function ReadUpdate(){
    LoadingStart();
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
        LoadingEnd();
    }).error();
}