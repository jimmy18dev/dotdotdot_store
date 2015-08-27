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
	// - TransferRequest, TransferAgain 
	// - TransferSuccess
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
		$this->RenderOrder('null',$data);
	}

	public function ListItemsInOrder($param){
		$data = parent::ListItemsInOrderProcess($param);
		$this->RenderItemsInOrder('null',$data);
	}

	public function GetOrder($param){
        $data = parent::GetOrderProcess($param);

        $this->id = $data['od_id'];
        $this->create_time = $data['od_create_time'];
        $this->update_time = $data['od_update_time'];
        $this->type = $data['od_type'];
        $this->status = $data['od_status'];
    }

    private function RenderOrder($mode,$data){
        foreach ($data as $var){
        	include'template/order/order.items.php';
        }
        unset($data);
    }

    private function RenderItemsInOrder($mode,$data){
        foreach ($data as $var){
        	include'template/order/items.in.order.items.php';
        }
        unset($data);
    }

    public function OrderProcess($param){
    	parent::UpdateStatusOrderProcess($param);
    }

    // EMS Number update in Order
    public function UpdateEmsOrder($param){
    	parent::UpdateEmsOrderProcess($param);
    }


    public function Checking($param){
    	return parent::CheckingAlreadyOrderProcess($param);
    }
}
?>