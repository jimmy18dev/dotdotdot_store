<?php
class OrderModel extends Database{

	public function CreateOrderProcess($param){
		parent::query('INSERT INTO dd_order(od_member_id,od_create_time,od_update_time,od_type,od_status) VALUE(:member_id,:create_time,:update_time,:type,:status)');

		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':type',			$param['type']);
		parent::bind(':status',			$param['status']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function AddItemsInOrderProcess($param){
		parent::query('INSERT INTO dd_order_detail(odt_order_id,odt_product_id,odt_total,odt_create_time,odt_update_time,odt_type,odt_status) VALUE(:order_id,:product_id,:total,:create_time,:update_time,:type,:status)');

		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::bind(':total', 			$param['total']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':type',			$param['type']);
		parent::bind(':status',			$param['status']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function CheckingAlreadyOrderProcess($param){
		parent::query('SELECT od_id FROM dd_order WHERE od_member_id = :member_id AND od_status = "Shopping"');
		parent::bind(':member_id', 		$param['member_id']);
		parent::execute();
		$data = parent::single();
		return $data['od_id'];
	}

	public function CheckingAlreadyItemInOrderProcess($param){
		parent::query('SELECT odt_id FROM dd_order_detail WHERE odt_order_id = :order_id AND odt_product_id = :product_id');
		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
		$data = parent::single();
		
		if(empty($data['odt_id']))
			return true; // Items ID is empty in order.
		else
			return false;
	}

	public function ListMyOrderProcess($param){
		parent::query('SELECT od_id,od_total,od_amount,od_payments,od_create_time,od_update_time,od_type,od_status FROM dd_order WHERE od_member_id = :member_id');
		parent::bind(':member_id', 		$param['member_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListItemsInOrderProcess($param){
		parent::query('SELECT * FROM dd_order_detail LEFT JOIN dd_product ON odt_product_id = pd_id WHERE odt_order_id = :order_id');
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function GetOrderProcess($param){
		parent::query('SELECT * FROM dd_order WHERE od_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		return parent::single();
	}

	public function UpdateStatusOrderProcess($param){
		parent::query('UPDATE dd_order SET od_status = :status WHERE od_id = :order_id');
		parent::bind(':status', $param['order_action']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}
	public function UpdateShippingTypeOrderProcess($param){
		parent::query('UPDATE dd_order SET od_shipping_type = :shipping_type WHERE od_id = :order_id');
		parent::bind(':shipping_type', $param['order_shipping_type']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}
	public function UpdateAddressOrderProcess($param){
		parent::query('UPDATE dd_order SET od_address_id = :address_id WHERE od_id = :order_id');
		parent::bind(':address_id', $param['address_id']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}

	public function ListMyCurrentOrderProcess($param){
		parent::query('SELECT * FROM dd_order_detail LEFT JOIN dd_order ON odt_order_id = od_id LEFT JOIN dd_product ON odt_product_id = pd_id WHERE od_member_id = :member_id AND od_status = "shopping"');
		parent::bind(':member_id', 		$param['member_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function GetSummaryProcess($param){
		parent::query('SELECT COUNT(odt_id) total,SUM(odt_total) amount,SUM(odt_total*pd_price) payments FROM dd_order_detail LEFT JOIN dd_product ON odt_product_id = pd_id WHERE odt_order_id = :order_id');
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
		return parent::single();
	}

	// Update Order amount, payments, update time
	public function UpdateSummaryOrderProcess($param){
		parent::query('UPDATE dd_order SET od_total = :total, od_amount = :amount, od_payments = :payments, od_update_time = :update_time WHERE od_id = :order_id');
		parent::bind(':total', 			$param['total']);
		parent::bind(':amount', 		$param['amount']);
		parent::bind(':payments', 		$param['payments']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
	}










	public function ListProductProcess($param){
		parent::query('SELECT pd_id,pd_title,pd_description,pd_material,pd_size_d,pd_size_ss,pd_size_s,pd_size_m,pd_size_l,pd_size_xl,pd_price,pd_create_time,pd_update_time,pd_group,pd_type,pd_status,im_id,im_thumbnail FROM dd_product LEFT JOIN dd_image ON pd_id = im_product_id');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
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