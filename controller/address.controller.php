<?php
class AddressController extends AddressModel{
    
	public function CreateAddress($param){
        return parent::CreateAddressProcess($param);
    }

 //    public function ListBank($param){
	// 	$dataset = parent::ListBankProcess($param);
	// 	$this->Render('null',$dataset);
	// }

	// private function Render($mode,$data){
 //        foreach ($data as $var){
 //        	include'template/bank/bank.items.php';
 //        }
 //        unset($data);
 //    }
}
?>