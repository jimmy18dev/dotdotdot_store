<?php
class OrderController extends OrderModel{
	public $id;
	public $total;
	public $amount;
	public $payments;
	public $summary_payments;
	public $create_time;
	public $update_time;
	public $type;
	public $status;

	public $shipping_type;
	public $shipping_payments;

	// -----------------
	// ORDER STATE.
	// -----------------
	// - Expire
	// - Cancel
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
			// Add product items to Order
			$items_id = parent::AddItemsInOrderProcess($param);

			// Update order summary
			$this->UpdateOrderProcess($param);

			// add product to order success.
			return true;
		}
		else{
			return false;
		}
	}

	public function EditItemsInOrder($param){
		parent::EditItemsInOrderProcess($param);
		// Update order summary
		$this->UpdateOrderProcess($param);
	}

	public function RemoveItemsInOrder($param){
		parent::RemoveItemsInOrderProcess($param);
		// Update order summary
		$this->UpdateOrderProcess($param);
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
        $this->total = $data['od_total'];
        $this->amount = $data['od_amount'];
        $this->payments = $data['od_payments'];
        $this->create_time = $data['od_create_time'];
        $this->update_time = $data['od_update_time'];
        $this->type = $data['od_type'];
        $this->status = $data['od_status'];

        $this->shipping_type = $data['od_shipping_type'];

        if($this->shipping_type == "Ems")
        	$this->shipping_payments = 50;
        else if($this->shipping_type == "Register")
        	$this->shipping_payments = 30;
        else
        	;

        $this->summary_payments = $this->payments + $this->shipping_payments;
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

    	// Update Shipping Type (EMS,Register)
    	if($param['order_action'] == 'Paying'){
    		parent::UpdateShippingTypeOrderProcess($param);
    	}
    	// Update Address id to Order
    	else if($param['order_action'] == 'TransferRequest'){
    		parent::UpdateAddressOrderProcess($param);
    	}
    }

    // EMS Number update in Order
    public function UpdateEmsOrder($param){
    	parent::UpdateEmsOrderProcess($param);
    }

    // Update Order amount, payments, update time
    public function UpdateOrderProcess($param){
    	// Get Order Summary.
    	$order_summary_data = parent::GetSummaryProcess($param);

    	$param['amount'] 	= $order_summary_data['amount'];
    	$param['payments'] 	= $order_summary_data['payments'];
    	$param['total'] 	= $order_summary_data['total'];
    	// Update Order Summary.
    	parent::UpdateSummaryOrderProcess($param);
    }

    public function MyCurrentOrder($param){
    	$dataset = parent::ListMyCurrentOrderProcess($param);

    	$payments = 0;
    	foreach ($dataset as $var){
    		$payments += $var['pd_price'];
    	}

    	$data = array(
			"apiVersion" => "1.0",
			"data" => array(
				"time_now" => date('Y-m-d H:i:s'),
				"payments" => $payments,
				"execute" => round(microtime(true)-StTime,4)."s",
				"amount" => floatval(count($dataset)),
				"items" => $dataset,
			),
		);

	    // JSON Encode and Echo.
	    echo json_encode($data);
    }

    // Export to json
	public function ExportToJson($message,$dataset){
		$data = array(
			"apiVersion" => "1.0",
			"data" => array(
				// "update" => time(),
				"time_now" => date('Y-m-d H:i:s'),
				"message" => $message,
				"execute" => round(microtime(true)-StTime,4)."s",
				"totalFeeds" => floatval(count($dataset)),
				"items" => $dataset,
			),
		);

	    // JSON Encode and Echo.
	    echo json_encode($data);
	}


    public function Checking($param){
    	return parent::CheckingAlreadyOrderProcess($param);
    }
}
?>