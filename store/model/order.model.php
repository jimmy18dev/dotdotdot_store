<?php
class OrderModel extends Database{
	
	public function ListOrderProcess($param){
		parent::query('SELECT od_id,me_name,od_total,od_amount,od_payments,od_create_time,od_update_time,od_type,od_status FROM dd_order LEFT JOIN dd_member ON od_member_id = me_id');
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

	// public function GetOrderProcess($param){
	// 	parent::query('SELECT * FROM dd_order WHERE od_id = :order_id');
	// 	parent::bind(':order_id', $param['order_id']);
	// 	parent::execute();
	// 	return parent::single();
	// }

	public function GetOrderProcess($param){
		parent::query('SELECT * FROM dd_order WHERE od_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::single();

		$dataset['order_create_time_facebook_format'] 	= parent::date_facebookformat($dataset['od_create_time']);
		$dataset['order_update_time_facebook_format'] 	= parent::date_facebookformat($dataset['od_update_time']);
		$dataset['order_paying_time_facebook_format'] 	= parent::date_facebookformat($dataset['od_paying_time']);
		$dataset['order_expire_time_facebook_format'] 	= parent::date_facebookformat($dataset['od_expire_time']);
		$dataset['order_confirm_time_facebook_format'] 	= parent::date_facebookformat($dataset['od_confirm_time']);
		$dataset['order_shipping_time_facebook_format'] = parent::date_facebookformat($dataset['od_shipping_time']);
		$dataset['order_create_time_thai_format'] 		= parent::date_thaiformat($dataset['od_create_time']);
		$dataset['order_update_time_thai_format'] 		= parent::date_thaiformat($dataset['od_update_time']);
		$dataset['order_paying_time_thai_format'] 		= parent::date_thaiformat($dataset['od_paying_time']);
		$dataset['order_expire_time_thai_format'] 		= parent::date_thaiformat($dataset['od_expire_time']);
		$dataset['order_confirm_time_thai_format'] 		= parent::date_thaiformat($dataset['od_confirm_time']);
		$dataset['order_shipping_time_thai_format'] 	= parent::date_thaiformat($dataset['od_shipping_time']);
		$dataset['order_expire_time_datediff'] 			= parent::dateDifference($dataset['od_expire_time']);

		return $dataset;
	}

	public function UpdateStatusOrderProcess($param){
		parent::query('UPDATE dd_order SET od_status = :status WHERE od_id = :order_id');
		parent::bind(':status', $param['order_action']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}

	public function UpdateConfirmTimeProcess($param){
		parent::query('UPDATE dd_order SET od_confirm_time = :confirm_time WHERE od_id = :order_id');
		parent::bind(':confirm_time',	date('Y-m-d H:i:s'));
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}

	public function UpdateEmsOrderProcess($param){
		parent::query('UPDATE dd_order SET od_ems = :ems, od_shipping_time = :shipping_time WHERE od_id = :order_id');
		parent::bind(':shipping_time',	date('Y-m-d H:i:s'));
		parent::bind(':ems', $param['ems']);
		parent::bind(':order_id', $param['order_id']);
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