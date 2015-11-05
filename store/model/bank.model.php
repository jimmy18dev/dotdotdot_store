<?php
class BankModel extends Database{

	public function CreateBankProcess($param){
		parent::query('INSERT INTO dd_bank(bk_code,bk_account_branch,bk_account_name,bk_account_number) VALUE(:code,:branch,:name,:number)');

		parent::bind(':code', 		$param['code']);
		parent::bind(':branch', 	$param['branch']);
		parent::bind(':name', 		$param['name']);
		parent::bind(':number', 	$param['number']);

		parent::execute();
		return parent::lastInsertId();
	}

	public function KillTransferMoneyProcess($param){
		parent::query('UPDATE dd_money_transfer SET mf_status = "cancel" WHERE mf_order_id = :order_id');
		parent::bind(':order_id', 		$param['order_id']);
		parent::execute();
	}

	public function ListBankProcess($param){
		parent::query('SELECT * FROM dd_bank');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}
}
?>