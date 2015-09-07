<?php
class AddressModel extends Database{

	// public function ListBankProcess($param){
	// 	parent::query('SELECT * FROM dd_bank');
	// 	parent::execute();
	// 	$dataset = parent::resultset();
	// 	return $dataset;
	// }

	public function CreateAddressProcess($param){
		parent::query('INSERT INTO dd_address(ad_member_id,ad_address,ad_create_time,ad_update_time) VALUE(:member_id,:address,:create_time,:update_time)');
		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':address', 		$param['address']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));

		parent::execute();
		return parent::lastInsertId();
	}

	public function EditAddressProcess($param){
		parent::query('UPDATE dd_address SET ad_address = :address, ad_update_time = :update_time WHERE ad_id = :address_id');
		parent::bind(':address_id', 	$param['address_id']);
		parent::bind(':address', 		$param['address']);
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::execute();
	}

	public function ListAddressProcess($param){
		parent::query('SELECT * FROM dd_address');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function GetAddressProcess($param){
		parent::query('SELECT * FROM dd_address WHERE ad_id = :address_id');
		parent::bind(':address_id', $param['address_id']);
		parent::execute();
		return parent::single();
	}
}
?>