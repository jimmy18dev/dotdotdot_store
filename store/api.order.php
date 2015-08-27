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
						$order->AddtoOrder(array(
							'member_id' 	=> MEMBER_ID,
							'type' 			=> 'normal',
							'status' 		=> 'shopping',
							'product_id' 	=> $_POST['product_id'],
							'total' 		=> $_POST['amount'],
						));
						$api->successMessage('Add Product to Order Successed.','','');
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
						));

						if($_POST['order_action'] == "TransferAgain"){
							$bank->KillTransferMoney(array('order_id' => $_POST['order_id']));
						}

						$api->successMessage('Order '.$_POST['order_id'].' is '.$_POST['order_action'].' Successed!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'EmsUpdate':
					if(true){
						$order->UpdateEmsOrder(array(
							'order_id' 		=> $_POST['order_id'],
							'ems' 			=> $_POST['ems'],
						));

						$order->OrderProcess(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'order_action' 	=> "Shipping",
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
		case 'Comment':
			switch ($_GET['action']) {
				case 'List':
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