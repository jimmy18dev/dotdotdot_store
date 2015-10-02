<?php
require_once'config/autoload.php';

$transfer_id = $bank->CreateMoneyTransfer(array(
    'order_id'      => $_POST['order_id'],
    'to_bank'       => $_POST['to_bank'],
    'member_id'     => MEMBER_ID,
    'total'         => $_POST['total'],
    'description'   => $_POST['description'],
    'type'          => 'bank_transfer',
));

// $address_id = $address->CreateAddress(array(
//     'member_id'     => MEMBER_ID,
//     'address'       => $_POST['address'],
// ));

$order->OrderProcess(array(
    'member_id'     => MEMBER_ID,
    'order_id'      => $_POST['order_id'],
    'order_action'  => 'TransferRequest',
    'address'       => $_POST['address'],
));

// Sending to Customer
$mail->addAddress('mrjimmy18@gmail.com');
$mail->Subject  = '#'.$order->id.' :: กำลังตรวจสอบหลักฐานการโอนเงิน...';
$message        = file_get_contents('template/email/confirm.html');
$message        = str_replace('%order_id%', $order->id, $message);
$message        = str_replace('%summary_payment%', number_format($order->summary_payments,2), $message);
$mail->Body     = $message;
$mail->AltBody  = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send())
    $email_send = $mail->ErrorInfo;
else
    $email_send = "Message has been sent";


if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && empty($_POST['post_id'])){

    if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
        die('Image file is Missing!');
    }

    //get uploaded file info before we proceed
    $image_name         = $_FILES['image_file']['name']; //file name
    $image_size         = $_FILES['image_file']['size']; //file size
    $image_temp         = $_FILES['image_file']['tmp_name']; //file temp

    $image_size_info    = getimagesize($image_temp); //gets image size info from valid image file
        
    if($image_size_info){
        $image_width    = $image_size_info[0]; //image width
        $image_height   = $image_size_info[1]; //image height
        $image_type     = $image_size_info['mime']; //image type

        $image_format   = $image->PhotoFormat($image_width,$image_height);
    }
    else{
        die("Make sure image file is valid!");
    }

    switch($image_type){
        case 'image/png':
            $image_res = imagecreatefrompng($image_temp); break;
        case 'image/gif':
            $image_res = imagecreatefromgif($image_temp); break;           
        case 'image/jpeg': case 'image/pjpeg':
            $image_res = imagecreatefromjpeg($image_temp); break;
        default:
            $image_res = false;
    }

    if($image_res){
        $image_info                 = pathinfo($image_name);
        $image_extension            = strtolower($image_info["extension"]);
            
        // $image_name_only = strtolower($image_info["filename"]);
        // $new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;

        $new_file_name              = md5(time().rand(0,9999999999)).'.'.$image_extension;
            
        // Destination folder to save
        $save_folder['thumbnail']   = $destination_folder['thumbnail'].$new_file_name;
        $save_folder['square']      = $destination_folder['square'].$new_file_name;
        $save_folder['mini']        = $destination_folder['mini'].$new_file_name;
        $save_folder['normal']      = $destination_folder['normal'].$new_file_name;
        $save_folder['large']       = $destination_folder['large'].$new_file_name;
            
        // Image resize process and saved.
        // Mini size
        $image->normal_resize_image($image_res,$save_folder['mini'],$image_type,$photo_size['mini'],$image_width,$image_height,$jpeg_quality);
        // Normal size
        $image->normal_resize_image($image_res,$save_folder['normal'],$image_type,$photo_size['normal'],$image_width,$image_height,$jpeg_quality);
        // Large size
        $image->normal_resize_image($image_res,$save_folder['large'],$image_type,$photo_size['large'],$image_width,$image_height,$jpeg_quality);
        // Square size
        $image->crop_image_square($image_res,$save_folder['square'],$image_type,$photo_size['square'],$image_width,$image_height,$jpeg_quality);
        // Thumbnail size
        $image->crop_image_square($image_res,$save_folder['thumbnail'],$image_type,$photo_size['thumbnail'],$image_width,$image_height,$jpeg_quality);

        $image->CreateImage(array(
            'product_id'    => '',
            'transfer_id'   => $transfer_id,
            'member_id'     => 'member',
            'caption'       => 'caption',
            'thumbnail'     => $save_folder['thumbnail'],
            'square'        => $save_folder['square'],
            'mini'          => $save_folder['mini'],
            'normal'        => $save_folder['normal'],
            'large'         => $save_folder['large'],
            'format'        => $image_format,
            'type'          => 'transfer',
            'status'        => 'active',
        ));
            
        imagedestroy($image_res);
    }
}
?>