<?php
class BankController extends BankModel{
	public $status = 'Call ProductController success.';

	public function CreateMoneyTransfer($param){
        return parent::CreateMoneyTransferProcess($param);
    }

    public function KillTransferMoney($param){
        parent::KillTransferMoneyProcess($param);
    }

    public function ListBank($param){
		$dataset = parent::ListBankProcess($param);
		$this->Render($param['mode'],$dataset);
	}

    public function ListBankToEmail($param){
        $dataset = parent::ListBankProcess($param);
        $str = '';

        foreach ($dataset as $var){
            $var['bk_name'] = $this->BankName($var['bk_code']);
            $str .= '<p><b>'.$var['bk_name'].'</b><br> เลขบัญชี '.$var['bk_account_number'].' ชื่อบัญชี '.$var['bk_account_name'].' สาขา'.$var['bk_account_branch'].'</p>';
        }

        return $str;
    }

	private function Render($mode,$data){
        foreach ($data as $var){
            $var['bk_name'] = $this->BankName($var['bk_code']);
            if($mode == "select"){
                include'template/bank/bank.select.items.php';
            }
            else if($mode == "items"){
                include'template/bank/bank.items.php';
            }
        }
        unset($data);
    }

    // Convert Bank Code to Bank Name
    public function BankName($code){
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
}
?>