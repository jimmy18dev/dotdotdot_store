function RegisterUser(){
    var href = 'api.user.php';

    $('#login-status').html('<i class="fa fa-circle-o-notch fa-spin"></i>Register...');

    var email = $('#email').val();
    var phone = $('#phone').val();
    var name = $('#name').val();
    var fb_name = $('#fb_name').val();
    var password = $('#password').val();

    if(email == "" || password == "" || name == ""){
        $('#login-status').html('Try again!');
        return false;
    }

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

        if(data.return){
            setTimeout(function(){window.location = 'index.php';},3000);
        }
        else{
            $('#login-status').html('Already Member!');
        }
    }).error();
}

function LoginUser(){
    var href = 'api.user.php';
    $('#login-status').html('<i class="fa fa-circle-o-notch fa-spin"></i>sign in...');

    var username = $('#username').val();
    var password = $('#password').val();

    if(username == "" || password == ""){
        $('#login-status').html('Try again!');
        return false;
    }

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
            $('#login-status').html('Try again!');
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

function EditInfo(){
    var href = 'api.user.php';

    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();

    if(!email || !name || !phone){
        return false;
    }

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :'EditInfo',
            name                :name,
            email               :email,
            phone               :phone,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);

        // Redirect page after submit address.
        setTimeout(function(){window.location = 'me.php'},1000);

    }).error();
}

function ChangePassword(){
    var href = 'api.user.php';
    var password = $('#password').val();

    if(!password){
        return false;
    }

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :'ChangePassword',
            password            :password,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);

        // Redirect page after submit address.
        setTimeout(function(){window.location = 'me.php'},1000);

    }).error();
}

function ForgetPassword(){
    var href = 'api.user.php';
    var email = $('#email').val();

    if(!email){
        return false;
    }

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :'ForgetPassword',
            email            :email,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);

        // Redirect page after submit address.
        // setTimeout(function(){window.location = 'me.php'},1000);

    }).error();
}

// New Password by Forget Password
function NewPassword(){
    var href = 'api.user.php';
    var email = $('#email').val();
    var forget_code = $('#forget_code').val();
    var password = $('#password').val();

    if(!email){
        return false;
    }

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :'CreatePasswordForgetFunction',
            email            :email,
            forget_code            :forget_code,
            password            :password,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);

        // Redirect page after submit address.
        setTimeout(function(){window.location = 'login.php'},1000);

    }).error();
}