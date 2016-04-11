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

	public function UpdateBankProcess($param){
		parent::query('UPDATE dd_bank SET bk_code = :code, bk_account_branch = :branch, bk_account_name = :name, bk_account_number = :number WHERE bk_id = :bank_id');

		parent::bind(':code', 		$param['code']);
		parent::bind(':branch', 	$param['branch']);
		parent::bind(':name', 		$param['name']);
		parent::bind(':number', 	$param['number']);
		parent::bind(':bank_id',		$param['bank_id']);

		parent::execute();
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

		foreach ($dataset as $k => $var) {
			$dataset[$k]['bk_account_number_format'] 	= parent::BankNumberFormat($var['bk_account_number']);
		}

		return $dataset;
	}

	public function GetBankProcess($param){
		parent::query('SELECT * FROM dd_bank WHERE bk_id = :bank_id');
		parent::bind(':bank_id',		$param['bank_id']);
		parent::execute();
		$dataset = parent::single();
		return $dataset;
	}

	public function DeleteBankProcess($param){
		parent::query('DELETE FROM dd_bank WHERE bk_id = :bank_id');
		parent::bind(':bank_id',		$param['bank_id']);
		parent::execute();
	}

	public function DisableBankProcess($param){
		parent::query('UPDATE dd_bank SET bk_status = "disable" WHERE bk_id = :bank_id');
		parent::bind(':bank_id',		$param['bank_id']);
		parent::execute();
	}

	public function CheckingBankTransferProcess($param){
		parent::query('SELECT mf_id FROM dd_money_transfer WHERE mf_to_bank = :bank_id');
		parent::bind(':bank_id',		$param['bank_id']);
		parent::execute();
		$dataset = parent::single();

		if(empty($dataset['mf_id']))
			return true;
		else
			return false;
	}
}
?>