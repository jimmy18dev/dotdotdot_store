function EmailConfigSave(){
    var href = 'api.config.php';

    // setup
    var email_host      = $('#email_host').val();
    var email_username  = $('#email_username').val();
    var email_password  = $('#email_password').val();
    var email_port      = $('#email_port').val();
    var email_address   = $('#email_address').val();
    var email_name      = $('#email_name').val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Config',
            action              :'UpdateEmail',
            email_host          :email_host,
            email_username      :email_username,
            email_password      :email_password,
            email_port          :email_port,
            email_address       :email_address,
            email_name          :email_name,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
    }).error();
}

function FacebookConfigSave(){
    var href = 'api.config.php';

    // setup
    var facebook_app_id      = $('#facebook_app_id').val();
    var facebook_app_secret  = $('#facebook_app_secret').val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Config',
            action              :'UpdateFacebook',
            facebook_app_id          :facebook_app_id,
            facebook_app_secret      :facebook_app_secret,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
    }).error();
}

function MetaConfigSave(){
    var href = 'api.config.php';

    // setup
    var meta_title          = $('#meta_title').val();
    var meta_description    = $('#meta_description').val();
    var meta_sitename       = $('#meta_sitename').val();
    var meta_author         = $('#meta_author').val();
    var meta_keyword        = $('#meta_keyword').val();

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Config',
            action              :'UpdateMeta',
            meta_title          :meta_title,
            meta_description          :meta_description,
            meta_sitename          :meta_sitename,
            meta_author          :meta_author,
            meta_keyword          :meta_keyword,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
    }).error();
}