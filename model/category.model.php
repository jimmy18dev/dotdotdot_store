<?php
class CategoryModel extends Database{
	public function ListCategoryProcess($param){
		parent::query('SELECT * FROM dd_category');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function countCategory(){
		parent::query('SELECT COUNT(ca_id) count FROM dd_category');
		parent::execute();
		$dataset = parent::single();
		return $dataset['count'];
	}
}
?>