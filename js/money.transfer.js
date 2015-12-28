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

            // console.clear();
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
            // setTimeout(function(){window.location = 'order-'+order_id+'.html';},300);
        },
        resetForm:true
    };

    $('#MoneyTransfer').submit(function(){
        var check = true;
        // console.clear();

        if(!BankValidation()){
            console.log('BankValidation: Fail!');
            check = false;
        }

        if(!NameValidation()){
            console.log('NameValidation: Fail!');
            check = false;
        }

        if(!AddressValidation()){
            console.log('AddressValidation: Fail!');
            check = false;
        }

        if(!PhoneValidation()){
            console.log('PhoneValidation: Fail!');
            check = false;
        }
        if(!TotalValidation()){
            console.log('TotalValidation: Fail!');
            check = false;
        }
        
        if(!BeforePostSubmit()){
            console.log('Photo is empty!');
            return false;
        }

        if(check){
            console.log('Money Transfer: Sending...');
            $(this).ajaxSubmit(optionsActivity);
            return true; 
        }
        else{
            console.log('Money Transfer Error!');
            return false; 
        }
    });

    BankValidation();
    NameValidation();
    AddressValidation();
    PhoneValidation();
    TotalValidation();

    $('#transfer_total').blur(TotalValidation);
    $('#transfer_bank').blur(BankValidation);
    $('#transfer_realname').blur(NameValidation);
    $('#transfer_address').blur(AddressValidation);
    $('#transfer_phone').blur(PhoneValidation);

    $('#photo_files').on("change",BeforePostSubmit);
});

function BeforePostSubmit(){
    $caption = $('#photo-input-caption');
    var max_filesize = $('#max_filesize').val();

    if(window.File && window.FileReader && window.FileList && window.Blob){
        if(!$('#photo_files').val()){

            $('#transfer_photo_icon').removeClass('check-active');
            $caption.html('แนบภาพถ่ายสลิปใบโอนเงินด้วยนะคะ!').addClass('input-caption-alert');
            return false;
        }
        else{
            var fsize = $('#photo_files')[0].files[0].size; //get file size
            var ftype = $('#photo_files')[0].files[0].type; // get file type

            switch(ftype){
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                    break;
                default:
                    $caption.html('เลือกไฟล์รูปภาพเท่านั้น!').addClass('input-caption-alert');
                    $('#transfer_photo_icon').removeClass('check-active');
                    return false
            }

            //Allowed file size is less than 15 MB (15728640)
            if(fsize > max_filesize){
                $caption.html('ไฟล์ของคุณมีขนาดใหญ่เกิน '+ (max_filesize/1048576) +' MB!').addClass('input-caption-alert');
                $('#transfer_photo_icon').removeClass('check-active');
                return false
            }

            $caption.html('เลือกภาพแล้ว').removeClass('input-caption-alert');
            $('#transfer_photo_icon').addClass('check-active');
            return true;
        }
    }
    else{
        // Output error to older unsupported browsers that doesn't support HTML5 File API
        $caption.html('Browser ไม่รอบรับการทำงานนี้!').addClass('input-caption-alert');
        $('#transfer_photo_icon').removeClass('check-active');
        return false;
    }
}


function TotalValidation(){
    var $total = $('#transfer_total').val();
    var $payments = $('#all-payments').val();

    if($total == ""){
        $('#transfer_total_icon').removeClass('check-active');
        return false;
    }
    else{
        if($total < $payments){
            $('#transfer_total_icon').removeClass('check-active');
            return false;
        }
        else{
            $('#transfer_total_icon').addClass('check-active');
            return true;
        }
    }
}
function BankValidation(){
    var $bank = $('#transfer_bank').val();

    if($bank > 0){
        $('#transfer_bank_icon').addClass('check-active');
        return true;
    }
    else{
        $('#transfer_bank_icon').removeClass('check-active');
        return false;
    }
}

function NameValidation(){
    var $name = $('#transfer_realname').val();

    if($name == ""){
        $('#transfer_name_icon').removeClass('check-active');
        return false;
    }
    else{
        $('#transfer_name_icon').addClass('check-active');
        return true;
    }
}
function AddressValidation(){
    var $address = $('#transfer_address').val();

    if($address == ""){
        $('#transfer_address_icon').removeClass('check-active');
        return false;
    }
    else{
        $('#transfer_address_icon').addClass('check-active');
        return true;
    }
}
function PhoneValidation(){
    var $phone = $('#transfer_phone').val();

    if($phone == ""){
        $('#transfer_phone_icon').removeClass('check-active');
        return false;
    }
    else{
        $('#transfer_phone_icon').addClass('check-active');
        return true;
    }
}