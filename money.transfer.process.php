<?php
require_once'config/autoload.php';

if($user->Authentication() && !empty($_POST['order_id']) && !empty($_POST['address']) && !empty($_POST['to_bank'])){
    $transfer_id = $bank->CreateMoneyTransfer(array(
        'order_id'      => $_POST['order_id'],
        'to_bank'       => $_POST['to_bank'],
        'member_id'     => MEMBER_ID,
        'total'         => $_POST['total'],
        'description'   => $_POST['description'],
        'type'          => 'bank_transfer',
    ));

    $order->OrderProcess(array(
        'member_id'     => MEMBER_ID,
        'order_id'      => $_POST['order_id'],
        'order_action'  => 'TransferRequest',
        'address'       => $_POST['address'],
    ));

    // Update Realname and Phone
    $user->UpdateNamePhone(array(
        'member_id'     => MEMBER_ID,
        'name'          => $_POST['realname'],
        'phone'         => $_POST['phone'],
    ));

    $order->GetOrder(array('order_id' => $_POST['order_id']));

    // Save activity log
    $order->CreateOrderActivity(array(
        'token'         => $user->token,
        'member_id'     => $user->id,
        'order_id'      => $order->id,
        'order_action'  => 'TransferRequest',
        'description'   => '',
    ));

    // Email Sending to Customer ///////////////////////////
    if(!empty($user->email) && $user->status == "verified"){
        $mail->addAddress($user->email);
        $mail->Subject  = 'กำลังตรวจสอบหลักฐานการโอนเงิน...';
        $message        = file_get_contents('template/email/confirm.html');
        $message        = str_replace('%domain%' ,$metadata['domain'], $message);
        $message        = str_replace('%name%', $user->name, $message);
        $message        = str_replace('%order_id%', $_POST['order_id'], $message);
        $message        = str_replace('%summary_payment%', number_format($order->summary_payments,2), $message);
        $message        = str_replace('%customer_name%',$order->customer_name, $message);
        $message        = str_replace('%customer_address%',$order->customer_address, $message);
        $message        = str_replace('%customer_phone%',$order->customer_phone, $message);
        $mail->Body     = $message;
        $mail->AltBody  = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send())
            $email_send = $mail->ErrorInfo;
        else
            $email_send = "Message has been sent";
    }
    // End Email Process.

    // Email Sending to Administrator /////////////////
    $admin_data = $user->ListAllAdministratorProcess();
    foreach ($admin_data as $var){
        $mail->addAddress($var['me_email']);
        $mail->Subject  = 'ใบสั่งซื้อที่ '.$order->id.' | ส่งหลักฐานการโอนเงินแล้ว';
        $message        = file_get_contents('template/email/transfer.request.admin.html');
        $message        = str_replace('%domain%' ,$metadata['domain'], $message);
        $message        = str_replace('%name%', $user->name, $message);
        $message        = str_replace('%order_id%', $_POST['order_id'], $message);
        $message        = str_replace('%summary_payment%', number_format($order->summary_payments,2), $message);
        $message        = str_replace('%customer_name%',$order->customer_name, $message);
        $message        = str_replace('%customer_address%',$order->customer_address, $message);
        $message        = str_replace('%customer_phone%',$order->customer_phone, $message);
        $mail->Body     = $message;
        $mail->AltBody  = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send())
            $email_send = $mail->ErrorInfo;
        else
            $email_send = "Message has been sent";
    }
    // End Email Process


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
            //$image->normal_resize_image($image_res,$save_folder['mini'],$image_type,$size['mini'],$image_width,$image_height,$quality['mini']);
            $image->normal_resize_image($image_res,$save_folder['normal'],$image_type,$size['normal'],$image_width,$image_height,$quality['normal']);
            // $image->normal_resize_image($image_res,$save_folder['large'],$image_type,$size['large'],$image_width,$image_height,$quality['large']);
            // $image->crop_image_square($image_res,$save_folder['square'],$image_type,$size['square'],$image_width,$image_height,$quality['square']);
            $image->crop_image_square($image_res,$save_folder['thumbnail'],$image_type,$size['thumbnail'],$image_width,$image_height,$quality['thumbnail']);

            $image->CreateImage(array(
                'product_id'    => '',
                'transfer_id'   => $transfer_id,
                'member_id'     => 'member',
                'caption'       => 'caption',
                'filename'      => $new_file_name,
                'format'        => $image_format,
                'type'          => 'transfer',
                'status'        => 'active',
            ));
                
            imagedestroy($image_res);
        }
    }
}
?>