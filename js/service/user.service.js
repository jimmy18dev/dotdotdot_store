function LoginUser(){
    var href = 'api.user.php';
    var username = $('#username').val();
    var password = $('#password').val();

    if(username == ""){
        $('#status-message').html('กรอกอีเมลของคุณ!').slideDown(500).delay(1000).slideUp(300);
        return false;
    }
    else if(password == ""){
        $('#status-message').html('กรอกรหัสผ่านของคุณ!').slideDown(500).delay(2000).slideUp(300);
        return false;
    }

    $('#login-status').html('<i class="fa fa-circle-o-notch fa-spin"></i>กำลังเข้าสู่ระบบ...');

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
            $('#dialog-box').fadeIn(300);
            setTimeout(function(){window.location = 'index.php';},3000);
        }
        else{
            $('#status-message').html('อีเมลและรหัสผ่านของคุณไม่ถูกต้อง!').slideDown(500).delay(3000).slideUp(300);
            $('#login-status').html('เข้าสู่ระบบ');
            return false;
        }
    }).error();
}

function RegisterUser(){
    var href = 'api.user.php';

    var email       = $('#email').val();
    var phone       = $('#phone').val();
    var name        = $('#name').val();
    var fb_name     = $('#fb_name').val();
    var password    = $('#password').val();

    if(email == ""){
        $('#status-message').html('กรอกอีเมลของคุณ!').slideDown(500).delay(1000).slideUp(300);
        return false;
    }
    else if(name == ""){
        $('#status-message').html('กรอกชื่อของคุณ!').slideDown(500).delay(2000).slideUp(300);
        return false;
    }
    else if(password == ""){
        $('#status-message').html('กรอกรหัสผ่านของคุณ!').slideDown(500).delay(2000).slideUp(300);
        return false;
    }

    $('#login-status').html('<i class="fa fa-circle-o-notch fa-spin"></i>กำลังสมัครสมาชิก...');

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
            $('#dialog-box').fadeIn(300);
            setTimeout(function(){window.location = 'index.php';},3000);
        }
        else{
            $('#status-message').html('อีเมลนี้ถูกใช้แล้ว!').slideDown(500).delay(3000).slideUp(300);
            $('#login-status').html('สมัครสมาชิก');
        }
    }).error();
}

function ForgetPassword(){
    var href = 'api.user.php';
    var email = $('#email').val();

    if(!email){
        $('#status-message').html('กรอกอีเมลของคุณ!').slideDown(500).delay(1000).slideUp(300);
        return false;
    }

    $('#login-status').html('<i class="fa fa-circle-o-notch fa-spin"></i>กำลังส่งอีเมล...');

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

        $('#dialog-box').fadeIn(300);
        setTimeout(function(){window.location = 'forget_success.php';},3000);
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
            setTimeout(function(){window.location = 'order-'+order_id+'.html';},1000);
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
        setTimeout(function(){window.location = 'profile.php'},1000);

    }).error();
}

// Change Password from User edit on profile
function ChangePassword(){
    var href = 'api.user.php';
    var password = $('#password').val();

    if(!password){
        return false;
    }

    $('#login-status').html('<i class="fa fa-circle-o-notch fa-spin"></i>กำลังเปลี่ยนรหัสผ่าน...');

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

        $('#dialog-box').fadeIn(300);
        setTimeout(function(){window.location = 'change_password_success.php';},3000);
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
        $('#dialog-box').fadeIn(300);
        setTimeout(function(){window.location = 'change_password_success.php';},3000);

    }).error();
}