<?php
class ImageModel extends Database{

	public function ListProductProcess($param){
		parent::query('SELECT * FROM dd_product');
		parent::execute();
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function CreateImageProcess($param){
		parent::query('INSERT INTO dd_image(im_product_id,im_member_id,im_caption,im_thumbnail,im_square,im_mini,im_normal,im_large,im_format,im_create_time,im_update_time,im_type,im_status) VALUE(:product_id,:member_id,:caption,:thumbnail,:square,:mini,:normal,:large,:format,:create_time,:update_time,:type,:status)');

		parent::bind(':product_id', 	$param['product_id']);
		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':caption', 		$param['caption']);
		parent::bind(':thumbnail', 		$param['thumbnail']);
		parent::bind(':square', 		$param['square']);
		parent::bind(':mini', 			$param['mini']);
		parent::bind(':normal', 		$param['normal']);
		parent::bind(':large', 			$param['large']);
		parent::bind(':format', 		$param['format']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':type',			$param['type']);
		parent::bind(':status',			$param['status']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function EditProductProcess($param){
		parent::query('SELECT * FROM dd_product');
		parent::execute();
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}
}
?>