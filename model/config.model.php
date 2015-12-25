<?php
class ConfigModel extends Database{

	public function GetConfigProcess(){
		parent::query('SELECT * FROM dd_config');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function EditItemsInOrderProcess($param){
		parent::query('UPDATE dd_order_detail SET odt_amount = :amount WHERE odt_order_id = :order_id AND odt_product_id = :product_id');
		parent::bind(':amount', 		$param['amount']);
		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}
}
?>