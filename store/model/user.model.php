<?php
class UserModel extends Database{

	// Set to Administartor
	public function SetAdminProcess($param){
		parent::query('UPDATE dd_member SET me_type = "administrator", me_update_time = :update_time WHERE me_id = :member_id');
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':member_id', 		$param['member_id']);
		parent::execute();
	}

	// Set to Member,Customer
	public function UnsetAdminProcess($param){
		parent::query('UPDATE dd_member SET me_type = "member", me_update_time = :update_time WHERE me_id = :member_id');
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':member_id', 		$param['member_id']);
		parent::execute();
	}

	// Create New Post /////////////
	public function RegisterUserProcess($param){
		parent::query('INSERT INTO dd_member(me_email,me_phone,me_name,me_fb_id,me_fb_name,me_password,me_create_time,me_update_time,me_ip,me_type,me_status) VALUE(:email,:phone,:name,:fb_id,:fb_name,:password,:create_time,:update_time,:ip,:type,:status)');

		parent::bind(':email', 			$param['email']);
		parent::bind(':phone', 			$param['phone']);
		parent::bind(':name', 			$param['name']);
		parent::bind(':fb_id', 		$param['fb_id']);
		parent::bind(':fb_name', 		$param['fb_name']);
		parent::bind(':password', 		$param['password']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':ip',				parent::GetIpAddress());
		parent::bind(':type', 			$param['type']);
		parent::bind(':status', 		$param['status']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function UpdateUserProcess($param){
		parent::query('UPDATE dd_member SET me_email = :email, me_fb_name = :fb_name, me_update_time = :update_time WHERE me_fb_id = :fb_id');

		parent::bind(':email', 			$param['email']);
		parent::bind(':fb_name', 		$param['fb_name']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':fb_id', 			$param['fb_id']);

		parent::execute();
	}

	public function UpdateUserInfoProcess($param){
		parent::query('UPDATE dd_member SET me_name = :name, me_phone = :phone, me_update_time = :update_time WHERE me_id = :member_id');

		parent::bind(':name', 			$param['name']);
		parent::bind(':phone', 			$param['phone']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':member_id', 		$param['member_id']);

		parent::execute();
	}

	// Check Member ID already
	public function AlreadyUserProcess($param){
		parent::query('SELECT me_id FROM dd_member WHERE me_id = :member_id OR me_fb_id = :facebook_id OR me_email = :email OR me_phone = :phone');
		parent::bind(':member_id',		$param['member_id']);
		parent::bind(':facebook_id',	$param['facebook_id']);
		parent::bind(':email',			$param['email']);
		parent::bind(':phone',			$param['phone']);
		parent::execute();
		$data = parent::single();

		if(empty($data['me_id']))
			return true;
		else
			return false;
	}

	// Get Member Data //////////////////////
	public function GetUserProcess($param){
		parent::query('SELECT * FROM dd_member WHERE me_id = :member_id');
		parent::bind(':member_id',		$param['member_id']);
		parent::execute();
		$dataset = parent::single();

		$dataset['user_create_time_facebook_format'] 	= parent::date_facebookformat($dataset['me_create_time']);
		$dataset['user_create_time_thai_format'] 		= parent::date_thaiformat($dataset['me_create_time']);

		return $dataset;
	}

	public function GetCurrentOrderProcess($param){
		parent::query('SELECT od_id FROM dd_order WHERE od_member_id = :member_id AND od_status = "Shopping"');
		parent::bind(':member_id', 		$param['member_id']);
		parent::execute();
		$data = parent::single();
		return $data['od_id'];
	}

	// Get Member Data //////////////////////
	public function LoginUserProcess($param){
		parent::query('SELECT me_id FROM dd_member WHERE (me_email = :email OR me_phone = :phone) AND me_password = :password');
		parent::bind(':email', 		$param['email']);
		parent::bind(':phone', 		$param['phone']);
		parent::bind(':password', 	$param['password']);
		parent::execute();
		$data = parent::single();
		return $data['me_id'];
	}

	// Get token
	public function GetTokenProcess($param){
		// Update token time
		parent::query('UPDATE dd_token SET tk_update_time = :update_time WHERE (tk_member_id = :member_id AND tk_device = :device AND tk_user_agent = :user_agent)');

		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':member_id',		$param['member_id']);
		parent::bind(':device',			$param['device']);
		parent::bind(':user_agent',		$param['user_agent']);
		parent::execute();

		// Get
		parent::query('SELECT tk_member_id,tk_token,tk_device,tk_model,tk_os,tk_browser,tk_user_agent,tk_ip,tk_create_time,tk_update_time,tk_expired FROM dd_token WHERE (tk_member_id = :member_id AND tk_device = :device AND tk_user_agent = :user_agent)');

		parent::bind(':member_id',		$param['member_id']);
		parent::bind(':device',			$param['device']);
		parent::bind(':user_agent',		$param['user_agent']);

		parent::execute();
		return parent::single();
	}

	// Order Management
	// Automation Create Order.
	public function CreateOrderProcess($param){
		parent::query('INSERT INTO dd_order(od_member_id,od_create_time,od_update_time) VALUE(:member_id,:create_time,:update_time)');

		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));

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

	// CUSTOMER ///////////////////////////////
	public function ListAllMemberProcess($param){
		parent::query('SELECT * FROM dd_member WHERE 1=1');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}
}
?>