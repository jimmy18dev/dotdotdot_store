function CreateBank(){
    // URL API
    var href = 'api.bank.php';

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