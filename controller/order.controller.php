<?php
class OrderController extends OrderModel{
	public $id;
	public $create_time;
	public $update_time;
	public $type;
	public $status;

	// -----------------
	// ORDER STATE.
	// -----------------
	// - Expire
	// - Shopping
	// - Paying
	// - TransferRequest
	// - TransferConfirm
	// - Shipping
	// - Complete
	// -----------------

	public function AddtoOrder($param){
		// Order checking
		$order_checking = parent::CheckingAlreadyOrderProcess($param);
		if(empty($order_checking)){
			$order_id = parent::CreateOrderProcess($param);
			$param['order_id'] = $order_id;
		}
		else{
			$param['order_id'] = $order_checking;
		}

		if(parent::CheckingAlreadyItemInOrderProcess($param)){
			$items_id = parent::AddItemsInOrderProcess($param);
			// add product to order success.
			return true;
		}
		else{
			return false;
		}
	}

	public function ListMyOrder($param){
		$data = parent::ListMyOrderProcess($param);
	}

	public function GetProduct($param){
        //$data = parent::GetProductProcess($param);
        $this->id = $data['pd_id'];
    }

    public function Checking($param){
    	return parent::CheckingAlreadyOrderProcess($param);
    }
}
?>