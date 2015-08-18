<?php
class ImageController extends ImageModel{
	public $status = 'Call ProductController success.';

	public function ListProduct($param){
		$dataset = parent::ListProductProcess($param);
		$this->Render('null',$dataset);
	}

	public function CreateImage($param){
		parent::CreateImageProcess($param);
	}

	private function Render($mode,$data){
        foreach ($data as $var){
        	include'template/product/product.items.php';
        }
        unset($data);
    }

    public function PhotoFormat($width,$height){
        if($width > $height){
            return 'vertical';
        }
        else if($width < $height){
            return 'horizontal';
        }
        else if($width == $height){
            return 'square';
        }
        else{
            return 'n/a';
        }
    }
    
    //////////////////////////////////////
    // Lib Image function ////////////////
    //////////////////////////////////////
    public function normal_resize_image($source, $destination,$image_type,$max_size, $image_width, $image_height, $quality){
        echo'Max Size: {'.$max_size.'px}';
        if($image_width <= 0 || $image_height <= 0){
            return false;
        } //return false if nothing to resize
    
        //do not resize if image is smaller than max size
        if($image_width <= $max_size && $image_height <= $max_size){
            if($this->save_image($source, $destination, $image_type, $quality)){
                return true;
            }
        }
    
        //Construct a proportional size of new image
        $image_scale    = min($max_size/$image_width, $max_size/$image_height);
        $new_width      = ceil($image_scale * $image_width);
        $new_height     = ceil($image_scale * $image_height);
    
        $new_canvas     = imagecreatetruecolor($new_width, $new_height); //Create a new true color image
    
        //Copy and resize part of an image with resampling
        if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
            $this->save_image($new_canvas, $destination, $image_type, $quality); //save resized image
        }

        return true;
    }

    public function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
        if($image_width <= 0 || $image_height <= 0){
            return false;
        }
    
        if( $image_width > $image_height){
            $y_offset = 0;
            $x_offset = ($image_width - $image_height) / 2;
            $s_size     = $image_width - ($x_offset * 2);
        }
        else{
            $x_offset = 0;
            $y_offset = ($image_height - $image_width) / 2;
            $s_size = $image_height - ($y_offset * 2);
        }

        $new_canvas = imagecreatetruecolor( $square_size, $square_size);
    
        if(imagecopyresampled($new_canvas,$source,0,0,$x_offset,$y_offset,$square_size,$square_size,$s_size,$s_size)){
            $this->save_image($new_canvas,$destination,$image_type,$quality);
        }

        return true;
    }


    private function save_image($source,$destination,$image_type,$quality){
        switch(strtolower($image_type)){
            case 'image/png': 
                imagepng($source,$destination); return true;
                break;
            case 'image/gif': 
                imagegif($source,$destination); return true;
                break;          
            case 'image/jpeg': case 'image/pjpeg': 
                imagejpeg($source,$destination,$quality); return true;
                break;
            default: return false;
        }
    }
}
?>