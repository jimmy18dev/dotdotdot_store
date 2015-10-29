<?php
class ProductModel extends Database{

	public function CreateProductProcess($param){
		parent::query('INSERT INTO dd_product(pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_visit_time,pd_order_time,pd_group,pd_type,pd_status) VALUE(:parent,:code,:title,:description,:quantity,:price,:create_time,:update_time,:visit_time,:order_time,:group,:type,:status)');

		parent::bind(':parent', 		$param['parent']);
		parent::bind(':code', 			$param['code']);
		parent::bind(':title', 			$param['title']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':quantity', 		$param['quantity']);
		parent::bind(':price', 			$param['price']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':visit_time',		date('Y-m-d H:i:s'));
		parent::bind(':order_time',		date('Y-m-d H:i:s'));
		parent::bind(':group', 			$param['group']);
		parent::bind(':type',			$param['type']);
		parent::bind(':status',			$param['status']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function EditProductProcess($param){
		parent::query('UPDATE dd_product SET pd_code = :code, pd_title = :title, pd_description = :description, pd_quantity = :quantity, pd_price = :price, pd_update_time = :update_time, pd_group = :group, pd_status = :status WHERE pd_id = :product_id');

		parent::bind(':product_id', 	$param['product_id']);
		parent::bind(':code', 			$param['code']);
		parent::bind(':title', 			$param['title']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':quantity', 		$param['quantity']);
		parent::bind(':price', 			$param['price']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':group', 			$param['group']);
		parent::bind(':status',			$param['status']);
		parent::execute();
	}

	public function UpdateRootProductProcess($param){
		parent::query('UPDATE dd_product SET pd_type = "root" WHERE pd_id = :product_id');
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}

	// public function DeleteProductProcess($param){
	// 	parent::query('DELETE FROM dd_product WHERE pd_id = :product_id');
	// 	parent::bind(':product_id', 	$param['product_id']);
	// 	parent::execute();
	// }


	// Get and List
	public function GetProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,im_id,im_id,im_filename,im_format FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id WHERE pd_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		return parent::single();
	}

	public function ListPhotoProductProcess($param){
		parent::query('SELECT * FROM dd_image WHERE im_product_id = :product_id AND im_status = "active" ORDER BY im_type,im_create_time');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,im_id,im_filename FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id AND im_type = "cover" WHERE pd_type != "sub"');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListSubProductProcess($param){
		parent::query('SELECT * FROM dd_product WHERE pd_parent = :product_id AND pd_type = "sub"');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	// Photo cover module
	public function CoverAlreadyProcess($param){
		parent::query('SELECT im_id FROM dd_image WHERE im_product_id = :product_id AND im_type = "cover"');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$data = parent::single();

		if(empty($data['im_id']))
			return true;
		else
			return false;
	}

	public function AutosetCover($param){
		parent::query('UPDATE dd_image SET im_type = "cover" WHERE im_product_id = :product_id ORDER BY im_create_time DESC LIMIT 1');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
	}

	public function SetCoverProcess($param){
		// Clear all cover
		parent::query('UPDATE dd_image SET im_type = "normal" WHERE im_product_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();

		// Set cover
		parent::query('UPDATE dd_image SET im_type = "cover" WHERE im_product_id = :product_id AND im_id = :image_id');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':image_id', $param['image_id']);
		parent::execute();
	}

	public function DeletePhotoProcess($param){
		parent::query('UPDATE dd_image SET im_status = "disable" WHERE (im_product_id = :product_id AND im_id = :image_id)');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':image_id', $param['image_id']);
		parent::execute();
	}
}
?>