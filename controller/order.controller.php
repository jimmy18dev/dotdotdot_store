<?php
class OrderController extends OrderModel{
	public $id;
    public $total;
    public $amount;
    public $payments;
    public $description;
    public $summary_payments;

    // Customer
    public $customer_id;
    public $customer_name;
    public $customer_address;
    public $customer_address_history;
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
    public $status_text;
    public $state;

    // Datatime facebook format
    public $create_time_fb;
    public $update_time_fb;
    public $paying_time_fb;
    public $confirm_time_fb;
    public $success_time_fb;
    public $shipping_time_fb;
    public $complete_time_fb;
    public $expire_time_fb;

    // Datetime thai format
    public $create_time_th;
    public $update_time_th;
    public $paying_time_th;
    public $confirm_time_th;
    public $success_time_th;
    public $shipping_time_th;
    public $complete_time_th;
    public $expire_time_th;

    // Money Transfer
    public $m_total;
    public $m_message;
    public $m_bank_code;
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

    // ORDER PROCESS /////////////////////
    // Order Process main function
    public function OrderProcess($param){
        // Update Shipping Type (EMS,Register)
        if($param['order_action'] == 'Paying'){
            if($this->CheckingAllQuantityInOrder($param)){
                
                // Subtraction of Product
                $param['action'] = 'subtraction';
                $this->UpdateProductQuantity($param);

                // Update Shipping in Order (EMS or Register)
                parent::UpdateShippingTypeOrderProcess($param);

                // Update time at paying action
                parent::UpdatePayingTimeProcess($param);

                // Update order status to "Paying"
                parent::UpdateStatusOrderProcess($param);
            }
        }
        // Update Address id to Order
        else if($param['order_action'] == 'TransferRequest'){
            parent::UpdateAddressOrderProcess($param);
            parent::UpdateConfirmTimeProcess($param);
            
            // Update order status to "Transfer Request"
            parent::UpdateStatusOrderProcess($param);
        }
        else if($param['order_action'] == 'TransferAgain'){
            // Update order status to "Transfer Again"
            parent::UpdateStatusOrderProcess($param);
        }
        else if($param['order_action'] == 'Complete'){
            parent::UpdateCompleteTimeProcess($param);
            
            // Update order status to "Complete"
            parent::UpdateStatusOrderProcess($param);
        }
        else if($param['order_action'] == 'Cancel'){
            // Update order status to "Cancel"
            parent::UpdateStatusOrderProcess($param);
            // Restore all product items in order to Stock
            $this->UpdateProductQuantity(array('order_id' => $param['order_id'],'action'=>'restore'));
        }

        // // Save order activity log
        // if($param['order_action'] == "Delete" || $param['order_action'] == "Expire"){
        //     $param['member_id'] = 0; // 0 = System
        // }
        
        // Save order activity log
        // parent::CreateOrderActivityProcess($param);
    }

    // Edit address in order
    public function EditAddress($param){
        parent::UpdateAddressOrderProcess($param);
    }
    // END ORDER PROCESS /////////////////////


    // ITEMS IN ORDER ///////////////////
	public function AddtoOrder($param){

        // Find current order of Customer
		$current_order = parent::CheckingAlreadyOrderProcess(array('member_id' => $param['member_id']));
		
		if(empty($current_order)){
            // Create empty order and set to current order 
			$order_id = parent::CreateOrderProcess($param);
			$param['order_id'] = $order_id;
		}
		else{
			$param['order_id'] = $current_order;
		}

		if(parent::CheckingAlreadyItemInOrderProcess($param)){

			// Add product items to Order
			$items_id = parent::AddItemsInOrderProcess($param);

			// Update order summary
			$this->UpdateOrderProcess($param);

			// Return True for add product to order Success.
			return true;
		}
		else{
			return false;
		}
	}

    // Change Quantity items in order
    public function EditItemsInOrder($param){
        if($this->CheckProductQuantity(array('product_id' => $param['product_id'],'amount' => $param['amount']))){

            // Update items in order
            parent::EditItemsInOrderProcess($param);
            
            // Update order summary
            $this->UpdateOrderProcess($param);

            return true;
        }
        else{
            return false;
        }
    }

    public function CheckProductQuantity($param){
        // Check amount of Product.
        $quantity = parent::CheckProductQuantityProcess($param);
        
        if($param['amount'] <= $quantity)
            return true;
        else
            return false;
    }

    // END ITEMS IN ORDER ////////////////////////

	public function RemoveItemsInOrder($param){
		parent::RemoveItemsInOrderProcess($param);
		// Update order summary
		$this->UpdateOrderProcess($param);
	}

	public function ListMyOrder($param){
		$data = parent::ListMyOrderProcess($param);
		$this->RenderOrder('my-order',$data);
	}

    public function OrderProgress($param){
        $dataset = parent::OrderProgressProcess($param);
        $this->RenderOrder('order-in-progress',$dataset);
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
        $this->customer_id = $data['me_id'];
        $this->customer_name = $data['me_name'];
        $this->customer_address = $data['od_address'];
        $this->customer_phone = $data['me_phone'];
        $this->customer_email = $data['me_email'];

        $this->customer_address_history = parent::GetAddressHistoryProcess(array('member_id' => $this->customer_id));

        // time update
        $this->create_time = $data['od_create_time'];
        $this->update_time = $data['od_update_time'];
        $this->expire_time_thai_format = $data['order_expire_time_thai_format'];
        $this->expire_time_datediff = $data['order_expire_time_datediff'];
        $this->confirm_time_facebook_format = $data['order_confirm_time_facebook_format'];
        $this->confirm_time_thai_format = $data['order_confirm_time_thai_format'];

        // Datatime facebook format
        $this->create_time_fb = $data['order_create_time_facebook_format'];
        $this->update_time_fb = $data['order_update_time_facebook_format'];
        $this->paying_time_fb = $data['order_paying_time_facebook_format'];
        $this->confirm_time_fb = $data['order_confirm_time_facebook_format'];
        $this->success_time_fb = $data['order_success_time_facebook_format'];
        $this->shipping_time_fb = $data['order_shipping_time_facebook_format'];
        $this->complete_time_fb = $data['order_complete_time_facebook_format'];
        $this->expire_time_fb = $data['order_expire_time_facebook_format'];

        // Datetime thai format
        $this->create_time_th = $data['order_create_time_thai_format'];
        $this->update_time_th = $data['order_update_time_thai_format'];
        $this->paying_time_th = $data['order_paying_time_thai_format'];
        $this->confirm_time_th = $data['order_confirm_time_thai_format'];
        $this->success_time_th = $data['order_success_time_thai_format'];
        $this->shipping_time_th = $data['order_shipping_time_thai_format'];
        $this->complete_time_th = $data['order_complete_time_thai_format'];
        $this->expire_time_th = $data['order_expire_time_thai_format'];

        $this->ems = $data['od_ems'];
        $this->type = $data['od_type'];
        $this->status = $data['od_status'];

        if($this->status == "Shopping"){
            $this->status_text = "เลือกสินค้า";
            $this->state = 1;
        }else if($this->status == "Paying"){
            $this->status_text = "รอโอนเงิน";
            $this->state = 2;
        }else if($this->status == "TransferRequest"){
            $this->status_text = "รอตรวจสอบหลักฐาน";
            $this->state = 3;
        }else if($this->status == "TransferAgain"){
            $this->status_text = "ส่งหลักฐานอีกครั้ง";
            $this->state = 3;
        }else if($this->status == "TransferSuccess"){
            $this->status_text = "ชำระเงินแล้ว";
            $this->state = 4;
        }else if($this->status == "Shipping"){
            $this->status_text = "จัดส่งสินค้าแล้ว";
            $this->state = 5;
        }else if($this->status == "Complete"){
            $this->status_text = "เสร็จสมบูรณ์";
            $this->state = 6;
        }else if($this->status == "Expire"){
            $this->status_text = "เกินเวลาชำระเงิน";
        }else if($this->status == "Cancel"){
            $this->status_text = "ยกเลิกการสั่งซ์้อ";
        }else{
            $this->status_text = "ไม่ทราบ";
        }


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
        $this->m_bank_code = $transfer['bk_code'];
        $this->m_bank = $transfer['bk_name'];
        $this->m_bank_number = $transfer['bk_account_number'];
        $this->m_photo = $transfer['im_filename'];
    }

    private function RenderOrder($mode,$data){
        foreach ($data as $var){
            if($mode == "my-order"){
                include'template/order/order.items.php';
            }
            else if($mode == "order-in-progress"){
                include'template/order/order.progress.items.php';
            }
        }
        unset($data);
    }

    private function RenderItemsInOrder($mode,$data,$order_status){
        foreach ($data as $var){
        	include'template/order/items.in.order.items.php';
        }
        unset($data);
    }

    public function ReadOrder($param){
        parent::ReadOrderProcess($param);
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

    // Save all activity in order action.
    public function CreateOrderActivity($param){
        // Parameter: token, member_id, order_id, order_action, description
        parent::CreateOrderActivityProcess($param);
    }

    public function MyCurrentOrder($param){
    	$dataset = parent::ListMyCurrentOrderProcess($param);

    	$payments = 0;
    	foreach ($dataset as $var){
    		$payments += ($var['pd_price']*$var['odt_amount']);
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

    // Check Quantity items in all orders
	public function CheckingAllQuantityInOrder($param){
		$checking = false;
		$dataset = parent::ListItemsInOrderProcess($param);

		foreach ($dataset as $var){
    		$unit = parent::CheckProductQuantityProcess(array('product_id' => $var['odt_product_id']));

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

    // Update Product Quantity (Subtraction or Restore)
	public function UpdateProductQuantity($param){
		$action = $param['action'];
		$dataset = parent::ListItemsInOrderProcess($param);

		foreach ($dataset as $var){
	    	$quantity_now = parent::CheckProductQuantityProcess(array('product_id' => $var['product_id']));

	    	if($action == 'subtraction'){
	    		$quantity = $quantity_now - $var['product_amount'];
                // Save activity log
                parent::CreateProductActivityProcess(array(
                    'product_id'    => $var['product_id'],
                    'action'        => 'SoldOut',
                    'value'         => $var['product_amount'],
                    'ref_id'        => $var['odt_id'],
                ));
            }
	    	else if($action == 'restore'){
	    		$quantity = $quantity_now + $var['product_amount'];
                // Delete Activity Log
                parent::DeleteProductActivityProcess(array(
                    'product_id'    => $var['product_id'],
                    'ref_id'        => $var['odt_id'],
                ));
            }
	    	else{
	    		return false;
            }

            // Update Product Quantity
	    	parent::UpdateProductQuantityProcess(array('product_id' => $var['product_id'],'quantity' => $quantity));
	    }
	}

    // All Orders's expire time check and update status to "Expire"
    public function CheckingOrder(){
    	$dataset = parent::ListOrderCheckingProcess();
    	foreach ($dataset as $var){
            $expire = strtotime($var['od_expire_time']);
            $cancel = strtotime($var['od_expire_time']) + 43200; // 12 Hrs

            if(time() > $cancel){
                // Restore all product items in order to Stock
                $this->UpdateProductQuantity(array('order_id' => $var['od_id'],'action'=>'restore'));

                // Set Order status to "Cancel"
                parent::OrderCancelProcess(array('order_id' => $var['od_id']));
            }
            else if(time() > $expire){
                // Set Order status to "Expire"
                parent::OrderExpireProcess(array('order_id' => $var['od_id']));
            }
    	}
    }

    public function CreateProductActivity($param){
        parent::CreateProductActivityProcess($param);
    }
}
?>