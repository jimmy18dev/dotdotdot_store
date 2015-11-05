<?php
class BankController extends BankModel{

    public $id;
    public $code;
    public $name;
    public $account_branch;
    public $account_name;
    public $account_number;

    public function CreateBank($param){
        if(empty($param['bank_id'])){
            parent::CreateBankProcess($param);
        }
        else{
            parent::UpdateBankProcess($param);
        }
    }

    public function GetBank($param){
        $dataset = parent::GetBankProcess($param);

        $this->id               = $dataset['bk_id'];
        $this->code             = $dataset['bk_code'];
        $this->name             = $this->BankName($dataset['bk_code']);
        $this->account_branch   = $dataset['bk_account_branch'];
        $this->account_name     = $dataset['bk_account_name'];
        $this->account_number   = $dataset['bk_account_number'];
    }

    public function DeleteBank($param){
        if(parent::CheckingBankTransferProcess(array('bank_id' => $param['bank_id'])))
            parent::DeleteBankProcess(array('bank_id' => $param['bank_id']));
        else
            parent::DisableBankProcess(array('bank_id' => $param['bank_id']));
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

    // Convert Bank Code to Bank Name
    private function BankName($code){
        if($code == "BBL")
            $name = "ธนาคารกรุงเทพ";
        else if($code == "BAY")
            $name = "ธนาคารกรุงศรีอยุธยา";
        else if($code == "KBANK")
            $name = "ธนาคารกสิกรไทย";
        else if($code == "KTB")
            $name = "ธนาคารกรุงไทย";
        else if($code == "SCB")
            $name = "ธนาคารไทยพาณิชย์";
        else if($code == "TMB")
            $name = "ธนาคารทหารไทย";
        else if($code == "GSB")
            $name = "ธนาคารออมสิน";
        else{
            $name = "n/a";
        }

        return $name;
    }

	private function Render($mode,$data){
        foreach ($data as $var){
            $var['bk_name'] = $this->BankName($var['bk_code']);
        	include'template/bank/bank.items.php';
        }
        unset($data);
    }
}
?>