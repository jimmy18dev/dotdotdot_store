function RegisterUser(){
    var href = 'api.user.php';

    var email = $('#email').val();
    var phone = $('#phone').val();
    var name = $('#name').val();
    var fb_name = $('#fb_name').val();
    var password = $('#password').val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :'RegisterUser',
            email:email,
            phone:phone,
            name:name,
            fb_name:fb_name,
            password:password,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
    }).error();
}

function LoginUser(){
    var href = 'api.user.php';
    $('#login-status').html('sign in...');

    var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :'LoginUser',
            username:username,
            password:password,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Callback: '+data.return+' , '+data.message);

        if(data.return){
            setTimeout(function(){window.location = 'index.php';},3000);
        }
        else{
            $('#login-status').html('try again!');
        }
    }).error();
}

function SubmitAddress(){
    var href = 'api.user.php';
    var address_id = $('#address_id').val();
    var address = $('#address').val();
    var order_id = $('#order_id').val();

    console.log(address);

    if(!address){
        return false;
    }

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :'SubmitAddress',
            address             :address,
            address_id          :address_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);

        // Redirect page after submit address.
        if(order_id)
            setTimeout(function(){window.location = 'order_detail.php?id='+order_id;},1000);
        else
            setTimeout(function(){window.location = 'me.php'},1000);

    }).error();
}