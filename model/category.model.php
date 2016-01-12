<?php
class CategoryModel extends Database{
	public function ListCategoryProcess($param){
		parent::query('SELECT * FROM dd_category');
		parent::execute();
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}
}
?>