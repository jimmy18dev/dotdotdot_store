function CreateBank(){
    // URL API
    var href = 'api.bank.php';

    var bank_id = $('#bank_id').val();
    var code = $('#code').val();
    var branch = $('#branch').val();
    var name = $('#name').val();
    var number = $('#number').val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Bank',
            action              :'CreateBank',
            bank_id:bank_id,
            code:code,
            branch:branch,
            name:name,
            number:number,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
    }).error();
}

function DeleteBank(bank_id){
    // URL API
    var href = 'api.bank.php';

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Bank',
            action              :'DeleteBank',
            bank_id:bank_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
        $('#bank-'+bank_id).fadeOut(300);
    }).error();
}