<?php
class ProductModel extends Database{

	public function GetProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_unit,pd_price,pd_create_time,pd_update_time,pd_visit_time,pd_order_time,pd_view,pd_read,pd_group,pd_type,pd_status,im_id,im_id,im_filename,im_format,odt_id FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id LEFT JOIN dd_order_detail ON pd_id = odt_product_id AND odt_order_id = :order_id WHERE pd_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		return parent::single();
	}

	public function ListProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_unit,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,im_id,im_filename,odt_id FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id LEFT JOIN dd_order_detail ON pd_id = odt_product_id AND odt_order_id = :order_id WHERE (pd_type = "normal" OR pd_type = "root") AND (im_type = "cover") ORDER BY pd_sort ASC');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}
	public function ListSubProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_unit,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,odt_id FROM dd_product LEFT JOIN dd_order_detail ON pd_id = odt_product_id AND odt_order_id = :order_id WHERE (pd_type = "sub" AND pd_parent = :product_id) ORDER BY pd_sort ASC');

		parent::bind(':product_id', $param['product_id']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListSubPhotoProcess($param){
		parent::query('SELECT * FROM dd_image WHERE im_product_id = :product_id AND im_type = "normal"');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function UpdateViewProcess($param){
		parent::query('UPDATE dd_product SET pd_view = :view,pd_visit_time = :visit_time WHERE pd_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':view', $param['view']);
		parent::bind(':visit_time',	date('Y-m-d H:i:s'));
		parent::execute();
	}
	public function UpdateReadProcess($param){
		parent::query('SELECT pd_read FROM dd_product WHERE pd_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::execute();
		$data = parent::single();
		$read = $data['pd_read'] + 1;

		parent::query('UPDATE dd_product SET pd_read = :read,pd_visit_time = :visit_time WHERE pd_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':read', $read);
		parent::bind(':visit_time',	date('Y-m-d H:i:s'));
		parent::execute();
	}







	public function CreateProductProcess($param){
		parent::query('INSERT INTO dd_product(pd_title,pd_description,pd_material,pd_size_d,pd_size_ss,pd_size_s,pd_size_m,pd_size_l,pd_size_xl,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status) VALUE(:title,:description,:material,:size_d,:size_ss,:size_s,:size_m,:size_l,:size_xl,:price,:create_time,:update_time,:group,:type,:status)');

		parent::bind(':title', 			$param['title']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':material', 		$param['material']);
		parent::bind(':size_d', 		$param['size_d']);
		parent::bind(':size_ss', 		$param['size_ss']);
		parent::bind(':size_s', 		$param['size_s']);
		parent::bind(':size_m', 		$param['size_m']);
		parent::bind(':size_l', 		$param['size_l']);
		parent::bind(':size_xl', 		$param['size_xl']);
		parent::bind(':price', 			$param['price']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':group', 			$param['group']);
		parent::bind(':type',			$param['type']);
		parent::bind(':status',			$param['status']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function EditProductProcess($param){
		parent::query('UPDATE dd_product SET pd_title = :title, pd_description = :description, pd_material = :material, pd_price = :price, pd_update_time = :update_time, pd_group = :group, pd_type = :type, pd_status = :status WHERE pd_id = :product_id');

		parent::bind(':product_id', 			$param['product_id']);
		parent::bind(':title', 			$param['title']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':material', 		$param['material']);
		parent::bind(':price', 			$param['price']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':group', 			$param['group']);
		parent::bind(':type',			$param['type']);
		parent::bind(':status',			$param['status']);
		parent::execute();
	}

	public function DeleteProductProcess($param){
		parent::query('DELETE FROM dd_product WHERE pd_id = :product_id');
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}
}
?>