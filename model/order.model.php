<?php
class OrderModel extends Database{

	public function CreateOrderProcess($param){
		parent::query('INSERT INTO dd_order(od_member_id,od_create_time,od_update_time) VALUE(:member_id,:create_time,:update_time)');
		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));

		parent::execute();
		return parent::lastInsertId();
	}

	// Items in Order
	// Add items to Order
	public function AddItemsInOrderProcess($param){
		parent::query('INSERT INTO dd_order_detail(odt_order_id,odt_product_id,odt_amount,odt_create_time,odt_update_time) VALUE(:order_id,:product_id,:amount,:create_time,:update_time)');

		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::bind(':amount', 		$param['amount']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));

		parent::execute();
		return parent::lastInsertId();
	}
	public function EditItemsInOrderProcess($param){
		parent::query('UPDATE dd_order_detail SET odt_amount = :amount WHERE odt_order_id = :order_id AND odt_product_id = :product_id');
		parent::bind(':amount', 		$param['amount']);
		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}

	public function RemoveItemsInOrderProcess($param){
		parent::query('DELETE FROM dd_order_detail WHERE odt_order_id = :order_id AND odt_product_id = :product_id');
		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
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
	
	public function ListOrderProcess($param){
		$select = 'SELECT od_id,od_total,od_amount,od_payments,od_create_time,od_update_time,od_type,od_status FROM dd_order';
		$where = ' WHERE (od_status = "Paying" OR od_status = "Expire")';
		$order = ' ORDER BY od_update_time DESC';
		$limit = '';

		$sql = $select.$where.$order.$limit;

		parent::query($sql);
		parent::execute();

		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListMyOrderProcess($param){
		parent::query('SELECT od_id,od_total,od_amount,od_payments,od_create_time,od_update_time,od_paying_time,od_expire_time,od_confirm_time,od_shipping_time,od_type,od_status FROM dd_order WHERE od_member_id = :member_id ORDER BY od_update_time DESC');
		parent::bind(':member_id', 		$param['member_id']);
		parent::execute();
		$dataset = parent::resultset();

		foreach ($dataset as $k => $var) {
			$dataset[$k]['order_create_time_facebook_format'] 	= parent::date_facebookformat($var['od_create_time']);
			$dataset[$k]['order_update_time_facebook_format'] 	= parent::date_facebookformat($var['od_update_time']);
			$dataset[$k]['order_paying_time_facebook_format'] 	= parent::date_facebookformat($var['od_paying_time']);
			$dataset[$k]['order_expire_time_facebook_format'] 	= parent::date_facebookformat($var['od_expire_time']);
			$dataset[$k]['order_shipping_time_facebook_format'] = parent::date_facebookformat($var['od_shipping_time']);
			$dataset[$k]['order_create_time_thai_format'] 		= parent::date_thaiformat($var['od_create_time']);
			$dataset[$k]['order_update_time_thai_format'] 		= parent::date_thaiformat($var['od_update_time']);
			$dataset[$k]['order_paying_time_thai_format'] 		= parent::date_thaiformat($var['od_paying_time']);
			$dataset[$k]['order_expire_time_thai_format'] 		= parent::date_thaiformat($var['od_expire_time']);
			$dataset[$k]['order_confirm_time_thai_format'] 		= parent::date_thaiformat($var['od_confirm_time']);
			$dataset[$k]['order_shipping_time_thai_format'] 	= parent::date_thaiformat($var['od_shipping_time']);
			$dataset[$k]['order_expire_time_datediff'] 			= parent::dateDifference($var['od_expire_time']);
		}

		return $dataset;
	}

	public function ListItemsInOrderProcess($param){
		parent::query('SELECT odt_id,odt_order_id order_id,odt_amount product_amount,product.pd_id product_id,product.pd_title product_title,product.pd_description product_description,product.pd_price product_price,product.pd_type product_type,p_image.im_id product_image_id,p_image.im_filename product_image_filename,parent.pd_id parent_id,parent.pd_title parent_title,parent.pd_description parent_description,parent_image.im_id parent_image_id,parent_image.im_filename parent_image_filename 
			FROM dd_order_detail 
			LEFT JOIN dd_product AS product ON odt_product_id = pd_id 
			LEFT JOIN dd_product AS parent ON product.pd_parent = parent.pd_id 
			LEFT JOIN dd_image AS p_image ON product.pd_id = p_image.im_product_id AND im_type = "cover" 
			LEFT JOIN dd_image AS parent_image ON parent.pd_id = parent_image.im_product_id 
			WHERE odt_order_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function CountItemInOrderProcess($param){
		parent::query('SELECT COUNT(odt_id) FROM dd_order_detail WHERE odt_order_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::single();

		return $dataset['COUNT(odt_id)'];
	}

	public function GetOrderProcess($param){
		parent::query('SELECT od_id,od_member_id,me_name,me_phone,me_email,od_total,od_amount,od_payments,od_create_time,od_update_time,od_paying_time,od_confirm_time,od_expire_time,od_shipping_time,od_shipping_type,od_ems,od_address,od_type,od_status 
			FROM dd_order 
			LEFT JOIN dd_member ON od_member_id = me_id 
			WHERE od_id = :order_id');
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

	public function GetMoneyTransferProcess($param){
		parent::query('SELECT mf_id,mf_total,mf_description,mf_create_time,mf_update_time,mf_type,mf_status,bk_id,bk_name,bk_account_name,bk_account_number,im_id,im_filename FROM dd_money_transfer LEFT JOIN dd_bank ON mf_to_bank = bk_id LEFT JOIN dd_image ON im_transfer_id = mf_id WHERE mf_order_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		return parent::single();
	}

	public function UpdateStatusOrderProcess($param){
		parent::query('UPDATE dd_order SET od_status = :status, od_update_time = :update_time, od_admin_read = "open" WHERE od_id = :order_id');
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':status', $param['order_action']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}

	// Order activity log
	public function CreateOrderActivityProcess($param){
		parent::query('INSERT INTO dd_order_activity(odac_member_id,odac_order_id,odac_action,odac_description,odac_create_time,odac_update_time) VALUE(:member_id,:order_id,:order_action,:description,:create_time,:update_time)');

		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':order_action', 	$param['order_action']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));

		parent::execute();
		return parent::lastInsertId();
	}

	public function UpdatePayingTimeProcess($param){
		parent::query('UPDATE dd_order SET od_paying_time = :paying_time, od_expire_time = :expire_time WHERE od_id = :order_id');

		parent::bind(':paying_time',	date('Y-m-d H:i:s'));
		parent::bind(':expire_time',	date('Y-m-d H:i:s',time()+86400)); // Order's Expire within 1 day.
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
	}

	public function UpdateConfirmTimeProcess($param){
		parent::query('UPDATE dd_order SET od_confirm_time = :confirm_time WHERE od_id = :order_id');
		parent::bind(':confirm_time',	date('Y-m-d H:i:s'));
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
	}
	public function UpdateCompleteTimeProcess($param){
		parent::query('UPDATE dd_order SET od_complete_time = :complete_time WHERE od_id = :order_id');
		parent::bind(':complete_time',	date('Y-m-d H:i:s'));
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
	}

	public function UpdateShippingTypeOrderProcess($param){
		parent::query('UPDATE dd_order SET od_shipping_type = :shipping_type WHERE od_id = :order_id');
		parent::bind(':shipping_type', $param['order_shipping_type']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}
	public function UpdateAddressOrderProcess($param){
		parent::query('UPDATE dd_order SET od_address = :address WHERE od_id = :order_id');
		parent::bind(':address', $param['address']);
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
		parent::query('SELECT COUNT(odt_id) total,SUM(odt_amount) amount,SUM(odt_amount*pd_price) payments FROM dd_order_detail LEFT JOIN dd_product ON odt_product_id = pd_id WHERE odt_order_id = :order_id');
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

	public function CheckProductAmountProcess($param){
		parent::query('SELECT pd_quantity FROM dd_product WHERE pd_id = :product_id');
		parent::bind(':product_id', 		$param['product_id']);
		parent::execute();
		$data = parent::single();
		return $data['pd_quantity'];
	}


	// Update product amount after Order paying
	public function UpdateProductAmountProcess($param){
		parent::query('UPDATE dd_product SET pd_quantity = :quantity WHERE pd_id = :product_id');
		parent::bind(':quantity', 			$param['quantity']);
		parent::bind(':product_id', 	$param['product_id']);
		parent::execute();
	}
}
?>