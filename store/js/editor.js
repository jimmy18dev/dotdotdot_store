$(document).ready(function(){
    // Textarea Autosize
    // $('.normal').autosize();
    $('.animated').autosize({append: "\n"});

    var $body = window.document.body;
    var action = $('#action').val();

    var optionsActivity = {
        beforeSend: function() {
            console.log('beforeSend => 0%');

            $('#filter').fadeIn();
            $('#loading-bar').width('0%');
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            var loadingProcess = '';

            $('#loading-bar').animate({width:percent+'%'},300);

            if(percent == 100){
                $('#loading-bar').fadeOut();
                $('#loading-message').html('<i class="fa fa-spinner fa-spin"></i> กำลังเผยแพร่ ...');
            }

            console.clear();
            for (i = 0; i < percent; i++) { 
                loadingProcess += '|';
            }

            console.log('Photo Upload => '+percent+'% ' + loadingProcess);
        },
        success: function(){
            console.log('success => waiting...');
        },
        complete: function(xhr) {
            console.log(xhr.responseText);
            console.log('complete => Success');

            $('#loading-message').html('<i class="fa fa-check"></i> เผยแพร่เรียบร้อยแล้ว');

            // Redirect page
            console.log('action:'+action);

            setTimeout(function(){
                window.location = 'place.php?id='+$('#place_id').val()+'#newsfeed';
            },3000);
        },
        resetForm:true
    };

    $('#PostCreate').submit(function() {
        if(!BeforePostSubmit()){
            return false;
            console.log('return false');
        }
        $(this).ajaxSubmit(optionsActivity);
        return false; 
    });

    $('#PostEdit').submit(function() {
        if(!BeforePostSubmit()){
            return false;
            console.log('return false');
        }
        $(this).ajaxSubmit(optionsActivity);
        return false; 
    });
});


function BeforePostSubmit(){
    console.log('Check whether browser fully supports all File API');

    if(window.File && window.FileReader && window.FileList && window.Blob){
        if(!$('#post_files').val()){
            $("#output").html('<i class="fa fa-exclamation"></i>กรุณาเลือกภาพถ่ายของคุณ').slideDown(700).delay(3000).slideUp(700);
            return true;
        }
        else{
            var fsize = $('#post_files')[0].files[0].size; //get file size
            var ftype = $('#post_files')[0].files[0].type; // get file type

            switch(ftype){
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                    break;
                default:
                    $("#output").html('<i class="fa fa-exclamation"></i>ระบบไม่รองรับไฟล์ภาพที่คุณเลือก').slideDown(700).delay(3000).slideUp(700);
                    return false
            }

            //Allowed file size is less than 15 MB (15728640)
            if(fsize > 15728640){
                $("#output").html('<i class="fa fa-exclamation"></i>ไฟล์ที่คุณเลือกมาขนาดใหญ่เกิน 15 MB').slideDown(700).delay(3000).slideUp(700);
                return false
            }

            $("#output").html('');
            console.log('Result: Pass');
            return true;
        }
    }
    else{
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#output").html('<i class="fa fa-exclamation"></i>Browser ของคุณ ไม่รอบรับการทำงานนี้ กรุณาอัพเกรดหรือใช้ Google Chrome').slideDown(700).delay(3000).slideUp(700);
        return true;
    }
}

// List all comment on post
function OffensiveWord(){
    var href = 'api.site.php';
    var message = $('#post-text').val();

    if(message.length % 2 != 0 || message == '')
        return false;

    $.ajax({
        url         :href,
        cache       :false,
        dataType    :"json",
        type        :"POST",
        data:{
            calling             :'Site',
            action              :'OffensiveWord',
            message             :message,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
    }).done(function(data){
        console.clear();
        console.log(message.length+' Check: '+data.return+' ('+data.execute+')');

        if(data.return == false){
            $('#post-text').addClass('offensive-word');
        }else{
            $('#post-text').removeClass('offensive-word'); 
        }
    }).error();
}