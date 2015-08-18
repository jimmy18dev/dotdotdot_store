<?php
class ProductModel extends Database{

	public function ListProductProcess($param){
		parent::query('SELECT * FROM dd_product');
		parent::execute();
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
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
		parent::query('SELECT * FROM dd_product');
		parent::execute();
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}
}
?>