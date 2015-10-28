<?php
class OrderController extends OrderModel{
	public $id;
    public $total;
    public $amount;
    public $payments;
    public $description;
    public $summary_payments;

    // Customer
    public $customer_name;
    public $customer_address;
    public $customer_phone;
    public $customer_email;

    // Time Update
    public $create_time;
    public $update_time;
    public $expire_time_thai_format;
    public $expire_time_datediff;
    public $confirm_time_facebook_format;
    public $confirm_time_thai_format;
    public $ems;
    public $type;
    public $status;

    // Money Transfer
    public $m_total;
    public $m_message;
    public $m_bank_name;
    public $m_bank_number;
    public $m_photo;

    // Shipping
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
		if($this->CheckProductAmount($param)){
			parent::EditItemsInOrderProcess($param);
			// Update order summary
			$this->UpdateOrderProcess($param);
		}
	}

	public function CheckProductAmount($param){
		// Check amount of Product.
		$unit = parent::CheckProductAmountProcess($param);
		
		if($param['amount'] <= $unit)
			return true;
		else
			return false;
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
		$order_status = $param['order_status'];
		$this->RenderItemsInOrder('null',$data,$order_status);
	}

	public function CountItemInOrder($param){
		return parent::CountItemInOrderProcess($param);
	}

	public function GetOrder($param){
        $data = parent::GetOrderProcess($param);

        $this->id = $data['od_id'];
        $this->total = $data['od_total'];
        $this->amount = $data['od_amount'];
        $this->payments = $data['od_payments'];
        $this->description = $data['od_description'];

        // Customer data
        $this->customer_name = $data['me_name'];
        $this->customer_address = $data['od_address'];
        $this->customer_phone = $data['me_phone'];
        $this->customer_email = $data['me_email'];

        // time update
        $this->create_time = $data['od_create_time'];
        $this->update_time = $data['od_update_time'];
        $this->expire_time_thai_format = $data['order_expire_time_thai_format'];
        $this->expire_time_datediff = $data['order_expire_time_datediff'];
        $this->confirm_time_facebook_format = $data['order_confirm_time_facebook_format'];
        $this->confirm_time_thai_format = $data['order_confirm_time_thai_format'];

        $this->ems = $data['od_ems'];
        $this->type = $data['od_type'];
        $this->status = $data['od_status'];

        $this->shipping_type = $data['od_shipping_type'];

        if($this->shipping_type == "Ems")
        	$this->shipping_payments = 50;
        else if($this->shipping_type == "Register")
        	$this->shipping_payments = 30;
        else
        	$this->shipping_payments = 50;
        
        $this->summary_payments = $this->payments + $this->shipping_payments;

        // Get Money transfer
        $transfer = parent::GetMoneyTransferProcess(array('order_id' => $this->id));
        $this->m_total = $transfer['mf_total'];
        $this->m_description = $transfer['mf_description'];
        $this->m_bank = $transfer['bk_name'];
        $this->m_bank_number = $transfer['bk_account_number'];
        $this->m_photo = $transfer['im_filename'];
    }

    private function RenderOrder($mode,$data){
        foreach ($data as $var){
        	include'template/order/order.items.php';
        }
        unset($data);
    }

    private function RenderItemsInOrder($mode,$data,$order_status){
        foreach ($data as $var){
        	include'template/order/items.in.order.items.php';
        }
        unset($data);
    }

    public function Test($param){
    	parent::UpdatePayingTimeProcess($param);
    }

    public function OrderProcess($param){

    	// Update order status
    	parent::UpdateStatusOrderProcess($param);

    	// Update Shipping Type (EMS,Register)
    	if($param['order_action'] == 'Paying'){
    		if($this->CheckingAllAmountInOrder($param)){

    			// Subtraction of Product
    			$param['action'] = 'subtraction';
    			$this->UpdateProductAmount($param);

    			// Update Shipping in Order
    			parent::UpdateShippingTypeOrderProcess($param);

    			// Update Paying and Expire time to Order
    			parent::UpdatePayingTimeProcess($param);
    		}
    	}
    	// Update Address id to Order
    	else if($param['order_action'] == 'TransferRequest'){
    		parent::UpdateAddressOrderProcess($param);
    		parent::UpdateConfirmTimeProcess($param);
    	}
        else if($param['order_action'] == 'Complete'){
            parent::UpdateCompleteTimeProcess($param);
        }
    	else if($param['order_action'] == 'Cancel'){
    		$param['action'] = 'restore';
    		$this->UpdateProductAmount($param);
    	}

    	// Save order activity log
    	if($param['order_action'] == "Delete" || $param['order_action'] == "Expire"){
    		$param['member_id'] = 0; // 0 = System
    	}
    	parent::CreateOrderActivityProcess($param);
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

	public function CheckingAllAmountInOrder($param){
		$checking = false;
		$dataset = parent::ListItemsInOrderProcess($param);

		foreach ($dataset as $var){
    		$unit = parent::CheckProductAmountProcess(array('product_id' => $var['odt_product_id']));

    		if($var['odt_amount'] <= $unit){
    			$checking = true;
    		}
    		else{
    			$checking = false;
    			break;
    		}
    	}

    	return $checking;
	}

	public function UpdateProductAmount($param){
		$action = $param['action'];
		$dataset = parent::ListItemsInOrderProcess($param);

		foreach ($dataset as $var){
	    	$unit = parent::CheckProductAmountProcess(array('product_id' => $var['odt_product_id']));

	    	if($action == 'subtraction')
	    		$param['unit'] = $unit - $var['odt_amount'];
	    	else if($action == 'restore')
	    		$param['unit'] = $unit + $var['odt_amount'];
	    	else
	    		return false;

	    	$param['product_id'] = $var['odt_product_id'];
	    	parent::UpdateProductAmountProcess($param);
	    }
	}


    public function CheckingOrder($param){
    	$dataset = parent::ListOrderProcess($param);

    	foreach ($dataset as $var){
    		$expire_time = strtotime($var['od_update_time']) + 60;
    		$delete_time = $expire_time + 60;

    		$time_to_expire = $expire_time-time();
    		$time_to_delete = $delete_time-time();

    		if($var['od_status'] == 'Paying'){
    			if(time() > $expire_time){
	    			echo'[Expire] ';
	    			$this->OrderProcess(array(
						'member_id' 	=> MEMBER_ID,
						'order_id' 		=> $var['od_id'],
						'order_action' 	=> 'Expire',
					));
	    		}
    		}

    		if($var['od_status'] == 'Expire'){
	    		if(time() > $delete_time){

	    			// Restore all product items in order to Stock
    				$this->UpdateProductAmount(array(
    					'order_id' 		=> $var['od_id'],
    					'action' 		=> 'restore',
    				));
	    			
	    			echo'[Delete] ';
	    			$this->OrderProcess(array(
						'member_id' 	=> MEMBER_ID,
						'order_id' 		=> $var['od_id'],
						'order_action' 	=> 'Delete',
					));
	    		}
    		}

    		echo time().' Expire ('.$time_to_expire.' วืนาที) / Delete ('.$time_to_delete.' วินาที)'.' / Status: '.$var['od_status'].'<br>';
    	}
    }
}
?>