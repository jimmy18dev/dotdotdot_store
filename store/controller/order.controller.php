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
        $this->address = $data['od_address'];

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
        $this->m_message = $transfer['mf_description'];
        $this->m_bank_name = $transfer['bk_name'];
        $this->m_bank_number = $transfer['bk_account_number'];
        $this->m_photo = $transfer['im_filename'];
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