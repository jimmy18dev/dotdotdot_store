<?php
require_once'config/autoload.php';

$product->CreateProduct(array(
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'material' => $_POST['material'],
    'size_d' => $_POST['size_d'],
    'size_ss' => $_POST['size_ss'],
    'size_s' => $_POST['size_s'],
    'size_m' => $_POST['size_m'],
    'size_l' => $_POST['size_l'],
    'size_xl' => $_POST['size_xl'],
    'price' => $_POST['price'],
    'group' => $_POST['group'],
    'type' => 'normal',
    'status' => 'active',
));

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

            // $image->CreatePhoto(array(
            //     'post_id'           => $post_id,
            //     'place_id'          => $_POST['place_id'],
            //     'member_id'         => $_POST['member_id'],
            //     'caption'           => $_POST['caption'],
            //     'link_thumbnail'    => $save_folder['thumbnail'],
            //     'link_square'       => $save_folder['square'],
            //     'link_mini'         => $save_folder['mini'],
            //     'link_normal'       => $save_folder['normal'],
            //     'link_large'        => $save_folder['large'],
            //     'format'            => $image_format,
            //     'type'              => 'normal',
            // ));
            
            imagedestroy($image_res);
        }
    }

// $image->CreateImage(array(
//     'product_id' => 'product',
//     'member_id' => 'member',
//     'caption' => 'caption',
//     'thumbnail' => 'thumbnail',
//     'square' => 'square',
//     'mini' => 'mini',
//     'normal' => 'normal',
//     'large' => 'large',
//     'format' => 'format',
//     'type' => 'normal',
//     'status' => 'active',
// ));
?>