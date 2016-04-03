$(document).ready(function(){
    $('.animated').autosize({append: "\n"});

    $panel      = $('#progress-panel');
    $bar        = $('#progress-bar');
    $icon       = $('#progress-icon');
    $message    = $('#progress-message');
    var order_id   = $('#order_id').val();

    $('#MoneyTransfer').ajaxForm({
        beforeSubmit: function(){
            console.log('Process: BeforeSubmit...');

            if(!ImageFileCheck()){
                console.log('Process: Photo is empty!');
                return false;
            }
            else if(!TotalValidation()){
                $('#transfer_total').focus();
                console.log('Process: TotalValidation: Fail!');
                return false;
            }
            else if(!BankValidation()){
                $('#transfer_bank').focus();
                console.log('Process: BankValidation: Fail!');
                return false;
            }
            else if(!NameValidation()){
                $('#transfer_realname').focus();
                console.log('Process: NameValidation: Fail!');
                return false;
            }
            else if(!AddressValidation()){
                $('#transfer_address').focus();
                console.log('Process: AddressValidation: Fail!');
                return false;
            }
            else if(!PhoneValidation()){
                $('#transfer_phone').focus();
                console.log('Process: PhoneValidation: Fail!');
                return false;
            }
            

            $panel.fadeIn();
            $bar.width('0%');
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            var loadingProcess = '';
            
            $bar.animate({width:percent+'%'},300);

            if(percent > 80){
                $message.html('<i class="fa fa-circle-o-notch fa-spin"></i>กำลังส่งอีเมล...');
            }
            // console.clear();
            for (i = 0; i < percent; i++) { 
                loadingProcess += '|';
            }
            console.log('Photo Upload => '+percent+'% ' + loadingProcess);
        },
        success: function() {
            console.log('Upload Successed and Waiting...');
            $message.html('<i class="fa fa-circle-o-notch fa-spin"></i>กำลังบันทึก...');
        },
        complete: function(xhr) {
            console.log('Complete!');
            $message.html('<i class="fa fa-check"></i>ส่งหลักฐานการโอนเงินแล้ว');
            location.reload();
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
    $('#photo_files').on("change",ImageFileCheck);
});

function ImageFileCheck(){
    $caption = $('#photo-input-caption');
    var max_filesize = $('#max_filesize').val();
    $file = $('#photo_files');

    if(window.File && window.FileReader && window.FileList && window.Blob){
        if(!$file.val()){
            $('#transfer_photo_icon').removeClass('check-active');
            // $caption.html('ขอภาพใบสลิปด้วยค่ะ!').addClass('input-caption-alert');
            alert('เราขอภาพถ่ายใบสลิปโอนเงินด้วยนะคะ!');
            return false;
        }
        else{
            var fsize = $file[0].files[0].size; // get file size
            var ftype = $file[0].files[0].type; // get file type

            if(ftype == "")
                ftype = $file.val().substr(($file.val().lastIndexOf('.') + 1));

            switch(ftype){
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg': case 'image/jpg': case 'png': case 'jpg': case 'jpeg':
                    break;
                default:
                    $caption.html('เลือกไฟล์รูปภาพเท่านั้น!'+ftype).addClass('input-caption-alert');
                    $('#transfer_photo_icon').removeClass('check-active');
                    return false
            }

            // Allowed file size is less than 15 MB (15728640)
            if(fsize > max_filesize){
                $caption.html('ไฟล์ใหญ่เกิน '+ (max_filesize/1048576) +' MB!').addClass('input-caption-alert');
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