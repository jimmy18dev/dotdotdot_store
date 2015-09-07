<?php
class AddressController extends AddressModel{

    public $id;
    public $address;
    
	public function CreateAddress($param){
        return parent::CreateAddressProcess($param);
    }

    public function EditAddress($param){
        parent::EditAddressProcess($param);
    }

    public function GetAddress($param){
        $data = parent::GetAddressProcess($param);

        $this->id = $data['ad_id'];
        $this->address = $data['ad_address'];
    }

    public function ListAddress($param){
    	$dataset = parent::ListAddressProcess($param);
    	$this->RenderAddress('null',$dataset);
    }

    private function RenderAddress($mode,$data){
        foreach ($data as $var){
        	include'template/address/address.items.php';
        }
        unset($data);
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