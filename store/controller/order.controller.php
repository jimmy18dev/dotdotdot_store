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

	public function ListOrder($param){
		$data = parent::ListOrderProcess($param);
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

        echo'<pre>';
        print_r($param);
        echo'</pre>';
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

    	// Update Confirm time in Order
    	if($param['order_action'] == 'TransferSuccess'){
    		parent::UpdateConfirmTimeProcess($param);
    	}
    }

    public function UpdateEmsOrder($param){
    	parent::UpdateEmsOrderProcess($param);
    }
}
?>