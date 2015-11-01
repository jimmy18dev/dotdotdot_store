<?php
class BankModel extends Database{

	public function ListBankProcess($param){
		parent::query('SELECT * FROM dd_bank');
		parent::execute();
		$dataset = parent::resultset();

		foreach ($dataset as $k => $var) {
			$dataset[$k]['bk_account_number'] 	= parent::BankNumberFormat($var['bk_account_number']);
		}

		return $dataset;
	}

	public function CreateMoneyTransferProcess($param){
		parent::query('INSERT INTO dd_money_transfer(mf_order_id,mf_to_bank,mf_member_id,mf_total,mf_description,mf_create_time,mf_update_time,mf_type) VALUE(:order_id,:to_bank,:member_id,:total,:description,:create_time,:update_time,:type)');

		parent::bind(':order_id', 		$param['order_id']);
		parent::bind(':to_bank', 		$param['to_bank']);
		parent::bind(':member_id', 		$param['member_id']);
		parent::bind(':total', 			$param['total']);
		parent::bind(':description', 	$param['description']);
		parent::bind(':create_time',	date('Y-m-d H:i:s'));
		parent::bind(':update_time',	date('Y-m-d H:i:s'));
		parent::bind(':type', 			$param['type']);

		parent::execute();
		return parent::lastInsertId();
	}
}
?>