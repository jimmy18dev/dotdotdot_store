<?php
class OrderModel extends Database{
	
	public function ListOrderProcess($param){
		parent::query('SELECT od_id,me_name,od_total,od_amount,od_payments,od_create_time,od_update_time,od_type,od_status FROM dd_order LEFT JOIN dd_member ON od_member_id = me_id');
		parent::execute();
		$dataset = parent::resultset();
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
		parent::query('SELECT od_id,od_member_id,me_name,me_phone,me_email,od_total,od_amount,od_payments,od_create_time,od_update_time,od_paying_time,od_confirm_time,od_expire_time,od_shipping_time,od_complete_time,od_shipping_type,od_ems,od_address,od_type,od_status 
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

		return $dataset;
	}

	public function GetMoneyTransferProcess($param){
		parent::query('SELECT mf_id,mf_total,mf_description,mf_create_time,mf_update_time,mf_type,mf_status,bk_id,bk_name,bk_account_name,bk_account_number,im_id,im_filename FROM dd_money_transfer LEFT JOIN dd_bank ON mf_to_bank = bk_id LEFT JOIN dd_image ON im_transfer_id = mf_id WHERE mf_order_id = :order_id');
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

	public function CountItemInOrderProcess($param){
		parent::query('SELECT COUNT(odt_id) FROM dd_order_detail WHERE odt_order_id = :order_id');
		parent::bind(':order_id', $param['order_id']);
		parent::execute();
		$dataset = parent::single();

		return $dataset['COUNT(odt_id)'];
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