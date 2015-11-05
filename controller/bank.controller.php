<?php
class BankController extends BankModel{
	public $status = 'Call ProductController success.';

	public function CreateMoneyTransfer($param){
        return parent::CreateMoneyTransferProcess($param);
    }

    public function ListBank($param){
		$dataset = parent::ListBankProcess($param);
		$this->Render($param['mode'],$dataset);
	}

    public function ListBankToEmail($param){
        $dataset = parent::ListBankProcess($param);
        $str = '';

        foreach ($dataset as $var){
            $str .= '<div class="bank-items" style="width:100%;padding-top:1%;padding-bottom:1%;padding-right:0%;padding-left:0%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;color:#777777;line-height:2em;" ><div class="name" style="color:#000000;" >'.$var['bk_name'].'</div><div class="account"><b style="color:#000000;" >'.$var['bk_account_number'].'</b> ชื่อบัญชี '.$var['bk_account_name'].'</div></div>';
        }

        return $str;
    }

	private function Render($mode,$data){
        foreach ($data as $var){
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
}
?>