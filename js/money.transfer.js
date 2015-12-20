$(document).ready(function(){
    $('.animated').autosize({append: "\n"});

    var $body = window.document.body;
    var order_id = $('#order_id').val();

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
                // $('#loading-bar').fadeOut();
                $('#loading-message').html('<i class="fa fa-circle-o-notch fa-spin"></i>กำลังส่ง...');
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

            $('#loading-message').html('<i class="fa fa-check"></i>สำเร็จ');
            setTimeout(function(){window.location = 'order-'+order_id+'.html';},1000);
        },
        resetForm:true
    };

    $('#MoneyTransfer').submit(function(){
        var bank            = $('#transfer_bank').val();
        var value           = $('#transfer_total').val();
        var realname        = $('#transfer_realname').val();
        var address         = $('#transfer_address').val();
        var phone           = $('#transfer_phone').val();

        if(bank == 0){
            console.log('Bank is empty!');
            return false;
        }
        if(value == ""){
            console.log('Money is empty!');
            return false;
        }
        if(realname == ""){
            console.log('Realname is empty!');
            return false;
        }
        if(address == ""){
            console.log('Address is empty!');
            return false;
        }
        if(phone == ""){
            console.log('Phone is empty!');
            return false;
        }

        if(!BeforePostSubmit()){
            console.log('Photo is empty!');
            return false;
        }else{
            console.log('Form is Process!');
        }

        // $(this).ajaxSubmit(optionsActivity);
        return false; 
    });
});


function BeforePostSubmit(){
    console.log('Check whether browser fully supports all File API...');

    if(window.File && window.FileReader && window.FileList && window.Blob){
        if(!$('#photo_files').val()){
            console.log('Photo not found!');
            return true;
        }
        else{
            var fsize = $('#post_files')[0].files[0].size; //get file size
            var ftype = $('#post_files')[0].files[0].type; // get file type

            switch(ftype){
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                    break;
                default:
                    console.log('ระบบไม่รองรับไฟล์ภาพที่คุณเลือก');
                    return false
            }

            //Allowed file size is less than 15 MB (15728640)
            if(fsize > 15728640){
                console.log('ไฟล์ที่คุณเลือกมาขนาดใหญ่เกิน 15 MB');
                return false
            }

            console.log('BeforePostSubmit(): Pass');
            return true;
        }
    }
    else{
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        console.log('Browser ของคุณ ไม่รอบรับการทำงานนี้ กรุณาอัพเกรดหรือใช้ Google Chrome');
        return true;
    }
}