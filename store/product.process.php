<?php
require_once'config/autoload.php';

if($user->Authentication() && $user->type == "administrator"){
    if(empty($_POST['product_id'])){
        
        if($_POST['parent'] > 0){
            // Update Root Product
            $product->UpdateRootProduct(array('product_id' => $_POST['parent']));
            $type = "sub";
        }
        else{
            $type = "normal";
        }

        // Create new Product
        $product_id = $product->CreateProduct(array(
            'parent'        => $_POST['parent'],
            'code'          => $_POST['code'],
            'title'         => $_POST['title'],
            'description'   => $_POST['description'],
            'quantity'      => $_POST['quantity'],
            'price'         => $_POST['price'],
            'group'         => $_POST['group'],
            'type'          => $type,
            'status'        => 'active',
        ));

        // Save activity log
        $product->CreateProductActivity(array(
            'token'         => $user->token,
            'admin_id'      => $user->id,
            'product_id'    => $product_id,
            'action'        => 'CreateProduct',
            'value'         => '',
            'deescription'  => '',
            'ref_id'        => '',
        ));
    }
    else{
        $product_id = $_POST['product_id'];
        $product->EditProduct(array(
            'product_id'    => $product_id,
            'parent'        => $_POST['parent'],
            'code'          => $_POST['code'],
            'title'         => $_POST['title'],
            'description'   => $_POST['description'],
            'quantity'      => $_POST['quantity'],
            'price'         => $_POST['price'],
            'group'         => $_POST['group'],
            'type'          => $_POST['type'],
            'status'        => 'active',
        ));

        // Save activity log
        $product->CreateProductActivity(array(
            'token'         => $user->token,
            'admin_id'      => $user->id,
            'product_id'    => $product_id,
            'action'        => 'EditProduct',
            'value'         => '',
            'deescription'  => '',
            'ref_id'        => '',
        ));
    }

    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && count($_FILES['image_file']['tmp_name']) > 0){
        
        foreach($_FILES['image_file']['tmp_name'] as $key => $tmp_name ){

            if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'][$key])){
                die('Image file is Missing!');
            }

            //get uploaded file info before we proceed
            $image_name         = $_FILES['image_file']['name'][$key]; //file name
            $image_size         = $_FILES['image_file']['size'][$key]; //file size
            $image_temp         = $_FILES['image_file']['tmp_name'][$key]; //file temp

            $image_size_info    = getimagesize($image_temp); //gets image size info from valid image file
                
            if($image_size_info){
                $img_width      = $image_size_info[0]; //image width
                $img_height     = $image_size_info[1]; //image height
                $img_type       = $image_size_info['mime']; //image type

                $image_format   = $image->PhotoFormat($img_width,$img_height);
            }
            else{
                die("Make sure image file is valid!");
            }

            switch($img_type){
                case 'image/png':
                    $img_res = imagecreatefrompng($image_temp); break;
                case 'image/gif':
                    $img_res = imagecreatefromgif($image_temp); break;           
                case 'image/jpeg': case 'image/pjpeg':
                    $img_res = imagecreatefromjpeg($image_temp); break;
                default:
                    $img_res = false;
            }

            if($img_res){
                $image_info                 = pathinfo($image_name);
                $image_extension            = strtolower($image_info["extension"]);
                $new_filename               = md5(time().rand(0,9999999999)).'.'.$image_extension;
                    
                // Destination folder to save
                $folder['thumbnail']   = $destination_folder['thumbnail'].$new_filename;
                $folder['square']      = $destination_folder['square'].$new_filename;
                $folder['mini']        = $destination_folder['mini'].$new_filename;
                $folder['normal']      = $destination_folder['normal'].$new_filename;
                $folder['large']       = $destination_folder['large'].$new_filename;
                    
                // Image resize process and saved.
                $image->crop_image($img_res,$folder['square'],$img_type,$size['square'],$img_width,$img_height,$quality['square']);
                $image->crop_image($img_res,$folder['thumbnail'],$img_type,$size['thumbnail'],$img_width,$img_height,$quality['thumbnail']);
                $image->resize_image($img_res,$folder['mini'],$img_type,$size['mini'],$img_width,$img_height,$quality['mini']);
                $image->resize_image($img_res,$folder['normal'],$img_type,$size['normal'],$img_width,$img_height,$quality['normal']);
                // $image->resize_image($img_res,$folder['large'],$img_type,$size['large'],$img_width,$img_height,$quality['large']);

                $image->CreateImage(array(
                    'product_id'    => $product_id,
                    'member_id'     => 'member',
                    'caption'       => 'caption',
                    'filename'      => $new_filename,
                    'format'        => $image_format,
                    'type'          => 'normal',
                    'status'        => 'active',
                ));
                    
                imagedestroy($img_res);
            }
        }

        // Autoset cover photo
        $product->AutosetCover(array('product_id' => $product_id));
    }
}
?>