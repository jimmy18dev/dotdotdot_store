<?php
class BankController extends BankModel{

    public function CreateBank($param){
        parent::CreateBankProcess($param);
    }

	public function KillTransferMoney($param){
        parent::KillTransferMoneyProcess($param);
    }

    public function CreateMoneyTransfer($param){
        parent::CreateMoneyTransferProcess($param);
    }

    public function ListBank($param){
		$dataset = parent::ListBankProcess($param);
		$this->Render('null',$dataset);
	}

	private function Render($mode,$data){
        foreach ($data as $var){
        	include'template/bank/bank.items.php';
        }
        unset($data);
    }
}
?>