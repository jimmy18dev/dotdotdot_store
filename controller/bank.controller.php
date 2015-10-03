<?php
class BankController extends BankModel{
	public $status = 'Call ProductController success.';

	public function CreateMoneyTransfer($param){
        return parent::CreateMoneyTransferProcess($param);
    }

    public function ListBank($param){
		$dataset = parent::ListBankProcess($param);
		$this->Render('null',$dataset);
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
        	include'template/bank/bank.items.php';
        }
        unset($data);
    }
}
?>