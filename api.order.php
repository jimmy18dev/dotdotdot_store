<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Order':
			switch ($_POST['action']) {
				case 'AddToOrder':
					if(true){
						$msg_return = $order->AddtoOrder(array(
							'member_id' 	=> MEMBER_ID,
							'product_id' 	=> $_POST['product_id'],
							'amount' 		=> $_POST['amount'],
						));

						// return value
						// - message for action status.
						// - return for current order id.
						$api->successMessage($msg_return,$user->current_order_id,'');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'EditInOrder':
					if(true){
						$order->EditItemsInOrder(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'product_id' 	=> $_POST['product_id'],
							'amount' 		=> $_POST['amount'],
						));
						$api->successMessage('Edit Product in Order Successed.','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'RemoveInOrder':
					if(true){
						$order->RemoveItemsInOrder(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'product_id' 	=> $_POST['product_id'],
						));
						$api->successMessage('Remove Product in Order Successed.','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'OrderProcess':
					if(true){
						$order->OrderProcess(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'order_action' 	=> $_POST['order_action'],
							'order_shipping_type' => $_POST['order_shipping_type'],
						));
						$api->successMessage('Order '.$_POST['order_id'].' is '.$_POST['order_action'].' Successed!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('COMMENT POST API ERROR!');
			break;
	}
}

// API Request $_GET
else if($_GET['calling'] != ''){
	switch ($_GET['calling']) {
		case 'Order':
			switch ($_GET['action']) {
				case 'MyCurrentOrder':
					if(!empty(MEMBER_ID)){
						$order->MyCurrentOrder(array('member_id' => MEMBER_ID));
					}else{
						$api->successMessage('Successed!','','');
					}
					break;
				case 'LiveComment':
					break;
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('COMMENT GET API ERROR!');
			break;
	}
}

// API Request is Fail or Null calling
else{
	$api->errorMessage('API NOT FOUND!');
}

exit();
?>