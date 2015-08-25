function AddItemToOrder(product_id){
    var href = 'api.order.php';
    var amount = $('#amount').val();

    console.log('Send:: '+product_id+' ,amount: '+amount)

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
    }).error();
}