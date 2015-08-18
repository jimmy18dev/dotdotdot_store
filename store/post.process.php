<?php
require_once'config/autoload.php';

// Authentication token
$authen = $me->Authentication_token(array('member_id' => $_POST['member_id'],'token' => $_POST['token']));

if($authen && MEMBER_ONLINE && $site->OffensiveWord($_POST['post_text'])){
    $image_format = 'n/a';

    // Post process
    if(empty($_POST['post_id'])){
        // Post priority
        if(!empty($_POST['post_text']))
            $priority = 3;
        else
            $priority = 1;

        // Post Creating
        $post_id = $post->CreatePost(array(
            'token'         => $_POST['token'],
            'place_id'      => $_POST['place_id'],
            'member_id'     => $_POST['member_id'],
            'title'         => $_POST['post_title'],
            'subtitle'      => $_POST['post_subtitle'],
            'text'          => $_POST['post_text'],
            'rating'        => $_POST['post_rating'],
            'priority'      => $priority,
            'type'          => 'normal',
        ));

        // Save Activity
        $activity->ActivityCreate(array(
            'member_id'     => $_POST['member_id'],
            'token'         => $_POST['token'],
            'place_id'      => '',
            'action'        => 'create_post',
            'to_place_id'   => $_POST['place_id'],
            'to_post_id'    => $post_id,
            'to_member_id'  => '',
            'to_comment_id' => '',
            'to_image_id'   => '',
            'keyword'       => '',
            'type'          => 'normal',
            'status'        => 'unread',
        ));
    }
    else{
        // Post editing
        $post->PostEdit(array(
            'post_id'       => $_POST['post_id'],
            'member_id'     => $_POST['member_id'],
            'title'         => $_POST['post_title'],
            'subtitle'      => $_POST['post_subtitle'],
            'text'          => $_POST['post_text'],
            'rating'        => $_POST['post_rating'],
        ));

        // Save Activity
        $activity->ActivityCreate(array(
            'member_id'     => $_POST['member_id'],
            'token'         => $_POST['token'],
            'place_id'      => '',
            'action'        => 'edit_post',
            'to_place_id'   => '',
            'to_post_id'    => $_POST['post_id'],
            'to_member_id'  => '',
            'to_comment_id' => '',
            'to_image_id'   => '',
            'keyword'       => '',
            'type'          => 'normal',
            'status'        => 'active',
        ));
    }

    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && empty($_POST['post_id'])){

        if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
            $place->CalculateStatistics(array('place_id' => $_POST['place_id']));
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

            $image_format   = $photo->PhotoFormat($image_width,$image_height);
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
            
            //$image_name_only = strtolower($image_info["filename"]);
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
            $photo->normal_resize_image($image_res,$save_folder['mini'],$image_type,$photo_size['mini'],$image_width,$image_height,$jpeg_quality);
            // Normal size
            $photo->normal_resize_image($image_res,$save_folder['normal'],$image_type,$photo_size['normal'],$image_width,$image_height,$jpeg_quality);
            // Large size
            $photo->normal_resize_image($image_res,$save_folder['large'],$image_type,$photo_size['large'],$image_width,$image_height,$jpeg_quality);
            // Square size
            $photo->crop_image_square($image_res,$save_folder['square'],$image_type,$photo_size['square'],$image_width,$image_height,$jpeg_quality);
            // Thumbnail size
            $photo->crop_image_square($image_res,$save_folder['thumbnail'],$image_type,$photo_size['thumbnail'],$image_width,$image_height,$jpeg_quality);

            $photo->CreatePhoto(array(
                'post_id'           => $post_id,
                'place_id'          => $_POST['place_id'],
                'member_id'         => $_POST['member_id'],
                'caption'           => $_POST['caption'],
                'link_thumbnail'    => $save_folder['thumbnail'],
                'link_square'       => $save_folder['square'],
                'link_mini'         => $save_folder['mini'],
                'link_normal'       => $save_folder['normal'],
                'link_large'        => $save_folder['large'],
                'format'            => $image_format,
                'type'              => 'normal',
            ));

            $priority = 5;
            // Update post priority
            $post->UpdatePostPriority(array(
                'post_id'       => $post_id,
                'member_id'     => $_POST['member_id'],
                'priority'      => $priority,
            ));
            
            imagedestroy($image_res);

            // Place calculate
            $place->CalculateStatistics(array('place_id' => $_POST['place_id']));
        }
    }
}