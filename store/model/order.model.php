<?php
class OrderModel extends Database{
	
	public function ListOrderProcess($param){

		$SELECT = 'SELECT od_id,me_name,od_total,od_amount,od_payments,od_create_time,od_update_time,od_type,od_status,od_admin_read ';
		$FROM = 'FROM dd_order LEFT JOIN dd_member ON od_member_id = me_id ';
		$WHERE = 'WHERE od_status != "Shopping" ';
		$ORDER = 'ORDER BY od_update_time DESC ';

		if(!empty($param['filter'])){
			$WHERE .= 'AND od_status = :filter ';
		}

		$Query = $SELECT.$FROM.$WHERE.$ORDER;

		parent::query($Query);

		if(!empty($param['filter']))
			parent::bind(':filter', ucfirst(strtolower($param['filter'])));

		parent::execute();
		$dataset = parent::resultset();

		foreach ($dataset as $k => $var) {
			$dataset[$k]['order_update_time_facebook_format'] 	= parent::date_facebookformat($var['od_update_time']);
			$dataset[$k]['order_update_time_thai_format'] 		= parent::date_thaiformat($var['od_update_time']);
		}

		return $dataset;
	}

	public function ListItemsInOrderProcess($param){
		parent::query('SELECT odt_id,odt_order_id order_id,odt_amount product_amount,product.pd_id product_id,product.pd_title product_title,product.pd_description product_description,product.pd_price product_price,product.pd_type product_type,p_image.im_id product_image_id,p_image.im_filename product_image_filename,parent.pd_id parent_id,parent.pd_title parent_title,parent.pd_description parent_description,parent_image.im_id parent_image_id,parent_image.im_filename parent_image_filename 
			FROM dd_order_detail 
			LEFT JOIN dd_product AS product ON odt_product_id = pd_id 
			LEFT JOIN dd_product AS parent ON product.pd_parent = parent.pd_id 
			LEFT JOIN dd_image AS p_image ON product.pd_id = p_image.im_product_id AND (im_type = "cover") 
			LEFT JOIN dd_image AS parent_image ON parent.pd_id = parent_image.im_product_id
			WHERE odt_order_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function GetOrderProcess($param){
		parent::query('SELECT od_id,od_member_id,me_name,me_phone,me_email,me_status,od_total,od_amount,od_payments,od_create_time,od_update_time,od_paying_time,od_confirm_time,od_expire_time,od_shipping_time,od_complete_time,od_shipping_type,od_ems,od_address,od_type,od_status 
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
		$dataset['order_complete_time_facebook_format'] = parent::date_facebookformat($dataset['od_complete_time']);

		$dataset['order_create_time_thai_format'] 		= parent::date_thaiformat($dataset['od_create_time']);
		$dataset['order_update_time_thai_format'] 		= parent::date_thaiformat($dataset['od_update_time']);
		$dataset['order_paying_time_thai_format'] 		= parent::date_thaiformat($dataset['od_paying_time']);
		$dataset['order_expire_time_thai_format'] 		= parent::date_thaiformat($dataset['od_expire_time']);
		$dataset['order_confirm_time_thai_format'] 		= parent::date_thaiformat($dataset['od_confirm_time']);
		$dataset['order_shipping_time_thai_format'] 	= parent::date_thaiformat($dataset['od_shipping_time']);
		$dataset['order_complete_time_thai_format'] 	= parent::date_thaiformat($dataset['od_complete_time']);

		$dataset['order_expire_time_datediff'] 			= parent::dateDifference($dataset['od_expire_time']);
		$dataset['me_phone'] 							= parent::PhoneFormat($dataset['me_phone']);

		return $dataset;
	}

	public function GetMoneyTransferProcess($param){
		parent::query('SELECT mf_id,mf_total,mf_description,mf_create_time,mf_update_time,mf_type,mf_status,bk_id,bk_code,bk_account_name,bk_account_number,im_id,im_filename FROM dd_money_transfer LEFT JOIN dd_bank ON mf_to_bank = bk_id LEFT JOIN dd_image ON im_transfer_id = mf_id WHERE mf_order_id = :order_id AND mf_status = "active"');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$data = parent::single();
		$data['bk_account_number'] = parent::BankNumberFormat($data['bk_account_number']);
		return $data;
	}

	public function UpdateStatusOrderProcess($param){
		parent::query('UPDATE dd_order SET od_status = :status, od_owner_read = "open" WHERE od_id = :order_id');
		parent::bind(':status', $param['order_action']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}

	public function AdminReadOrderProcess($param){
		parent::query('UPDATE dd_order SET od_admin_read = "close" WHERE od_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}

	public function UpdateSuccessTimeProcess($param){
		parent::query('UPDATE dd_order SET od_success_time = :success_time WHERE od_id = :order_id');
		parent::bind(':success_time', 	date('Y-m-d H:i:s'));
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
	}

	public function UpdateEmsOrderProcess($param){
		parent::query('UPDATE dd_order SET od_ems = :ems, od_shipping_time = :shipping_time WHERE od_id = :order_id');
		parent::bind(':shipping_time',	date('Y-m-d H:i:s'));
		parent::bind(':ems', $param['ems']);
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
	}

	public function CountItemInOrderProcess($param){
		parent::query('SELECT COUNT(odt_id) FROM dd_order_detail WHERE odt_order_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::single();

		return $dataset['COUNT(odt_id)'];
	}

	// Order activity log
	public function CreateOrderActivityProcess($param){
		parent::query('INSERT INTO dd_order_activity(odac_token,odac_member_id,odac_order_id,odac_action,odac_description,odac_create_time,odac_update_time) VALUE(:token,:member_id,:order_id,:order_action,:description,:create_time,:update_time)');

		parent::bind(':token', 			$param['token']);
		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':order_action', 	$param['order_action']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));

		parent::execute();
		return parent::lastInsertId();
	}

	public function NotificationCheckingProcess(){
		parent::query('SELECT COUNT(od_id) FROM dd_order WHERE od_admin_read = "open"');
		parent::execute();
		return $dataset = parent::single();
	}
}
?>