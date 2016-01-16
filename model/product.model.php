<?php
class ProductModel extends Database{

	public function GetProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_visit_time,pd_order_time,pd_view,pd_read,pd_group,pd_type,pd_status,ca_id,ca_title,im_id,im_id,im_filename,im_format,odt_id FROM dd_product LEFT JOIN dd_category ON pd_category_id = ca_id LEFT JOIN dd_image ON pd_id = im_product_id AND im_type = "cover" LEFT JOIN dd_order_detail ON pd_id = odt_product_id AND odt_order_id = :order_id WHERE pd_id = :product_id');
		parent::bind(':product_id', $param['product_id']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		return parent::single();
	}

	public function ListProductProcess($param){
		$select = 'SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,im_id,im_filename,odt_id ';
		$from = 'FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id AND (im_type = "cover") LEFT JOIN dd_order_detail ON pd_id = odt_product_id AND odt_order_id = :order_id ';
		$where = 'WHERE (pd_type = "normal" OR pd_type = "root") AND pd_status = "active" ';
		$category = '';
		if(!empty($param['filter']))
			$category = ' AND pd_category_id = :category ';

		$order = 'ORDER BY pd_sort ASC';
		$query = $select.$from.$where.$category.$order;

		parent::query($query);
		parent::bind(':order_id', $param['order_id']);
		if(!empty($param['filter'])){
			parent::bind(':category', $param['filter']);
		}
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListProductBestSellerProcess($param){
		$select = 'SELECT pd_id,pd_read,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,im_id,im_filename,odt_id ';
		$from = 'FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id AND (im_type = "cover") LEFT JOIN dd_order_detail ON pd_id = odt_product_id AND odt_order_id = :order_id ';
		$where = 'WHERE (pd_type = "normal" OR pd_type = "root") AND pd_status = "active" ';
		$category = '';
		if(!empty($param['filter']))
			$category = ' AND pd_category_id = :category ';

		$order = 'ORDER BY pd_read DESC LIMIT 3';
		$query = $select.$from.$where.$category.$order;

		parent::query($query);
		parent::bind(':order_id', $param['order_id']);
		if(!empty($param['filter'])){
			parent::bind(':category', $param['filter']);
		}
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListSubProductProcess($param){
		parent::query('SELECT pd_id,pd_parent,pd_code,pd_title,pd_description,pd_quantity,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,odt_id FROM dd_product LEFT JOIN dd_order_detail ON pd_id = odt_product_id AND odt_order_id = :order_id WHERE (pd_type = "sub" AND pd_parent = :product_id AND pd_status = "active") ORDER BY pd_sort ASC');

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
}
?>