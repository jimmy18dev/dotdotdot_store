function SetAdmin(member_id,type){
    // URL API
    var href = 'api.user.php';
    $('#control-btn-'+member_id).html('<i class="fa fa-spinner fa-spin"></i>');

    if(member_id == "" || type == "")
        return false;

    if(type == "administrator")
        action = 'UnsetAdmin';
    else if(type == "member")
        action = 'SetAdmin'
    else
        return false;

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'User',
            action              :action,
            member_id           :member_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.log('Return: '+data.message);
        location.reload();
    }).error();
}