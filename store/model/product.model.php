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
		parent::query('SELECT * FROM dd_product');
		parent::execute();
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
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