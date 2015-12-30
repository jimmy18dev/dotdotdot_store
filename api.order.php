<?php
require_once'config/autoload.php';
header("Content-type: text/json");
// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Order':
			switch ($_POST['action']) {
				case 'AddToOrder':
					if($user->Authentication()){
						$msg_return = $order->AddtoOrder(array(
							'member_id' 	=> MEMBER_ID,
							'product_id' 	=> $_POST['product_id'],
							'amount' 		=> $_POST['amount'],
						));
						// return value
						// - message for action status.
						// - return for current order id.

						/*
						if($msg_return){
							// Save activity log
							$product->CreateActivity(array(
								'token' 		=> $user->token,
								'admin_id'      => $user->id,
	            				'product_id'    => $_POST['product_id'],
	            				'action'        => 'SoldOut',
	            				'value'         => $_POST['amount'],
	            				'deescription'  => '',
	            				'ref_id' 		=> $_POST['product_id'],
							));
						}
						*/

						$api->successMessage($msg_return,$user->current_order_id,'');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'EditInOrder':
					if($user->Authentication()){
						$order_return = $order->EditItemsInOrder(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'product_id' 	=> $_POST['product_id'],
							'amount' 		=> $_POST['amount'],
						));
						$api->successMessage('Edit Product in Order Successed.',$order_return,'');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'RemoveInOrder':
					if($user->Authentication()){
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
					if($user->Authentication()){ // Member Authentication before order process.
						// Order Process
						$order->OrderProcess(array(
							'member_id' 	=> MEMBER_ID,
							'token' 		=> $user->token,
							'order_id' 		=> $_POST['order_id'],
							'order_action' 	=> $_POST['order_action'],
							'order_shipping_type' => $_POST['order_shipping_type'],
						));

						// Get Order data
						$order->GetOrder(array('order_id' => $_POST['order_id']));

						// Send Notification Email to Customer
						if($_POST['order_action'] == "Expire"){}
						else if($_POST['order_action'] == "Cancel"){}
						else if($_POST['order_action'] == "Paying"){
							// Email Sending to Customer ///////////////////////////
							if($config->email_status && !empty($user->email) && $user->status == "verified"){
								$mail->addAddress($user->email);
								$mail->Subject 	= 'ยืนยันการสั่งซื้อสินค้า';
								$message 		= file_get_contents('template/email/paying.html');
								$message 		= str_replace('%domain%' ,$metadata['domain'], $message);
								$message 		= str_replace('%name%' ,$user->name, $message);
								$message 		= str_replace('%order_id%' ,$order->id, $message);
								$message 		= str_replace('%summary_payment%' ,number_format($order->summary_payments,2), $message);
								$message 		= str_replace('%expire_date%' ,$order->expire_time_thai_format, $message);
								$message 		= str_replace('%expire_count%' ,$order->expire_time_datediff, $message);
								$message 		= str_replace('%bank_list%' ,$bank->ListBankToEmail(array('id' => 0)), $message);
								$mail->Body    	= $message;
								$mail->AltBody 	= 'This is the body in plain text for non-HTML mail clients';

								if(!$mail->send())
									$email_send = $mail->ErrorInfo;
								else
									$email_send = "Message has been sent";
							}
							// End Email Process.
						}
						else if($_POST['order_action'] == "TransferRequest"){
							// Call Money Transfer file.
						}
						else if($_POST['order_action'] == "TransferAgain"){}
						else if($_POST['order_action'] == "TransferSuccess"){}
						else if($_POST['order_action'] == "Shipping"){}
						else if($_POST['order_action'] == "Complete"){

							// Email Sending to Customer ///////////////////////////
							if($config->email_status && !empty($user->email) && $user->status == "verified"){
								$mail->addAddress($user->email);
								$mail->Subject 	= 'ขอบคุณที่ใช่อุดหนุนสินค้าของเรา';
								$message 		= file_get_contents('template/email/complete.html');
								$message 		= str_replace('%domain%' ,$metadata['domain'], $message);
								$message 		= str_replace('%name%' ,$user->name, $message);
								$message 		= str_replace('%order_id%', $order->id, $message);
								$mail->Body    	= $message;
								$mail->AltBody 	= 'This is the body in plain text for non-HTML mail clients';

								if(!$mail->send())
									$email_send = $mail->ErrorInfo;
								else
									$email_send = "Message has been sent";
							}
							// End Email Process.

							// Email Sending to Administrator /////////////////
						    $admin_data = $user->ListAllAdministratorProcess();
						    if($config->email_status && !empty($var['me_email'])){
							    foreach ($admin_data as $var){
							        $mail->addAddress($var['me_email']);
							        $mail->Subject  = 'ใบสั่งซื้อที่ '.$order->id.' | ลูกค้าได้รับสินค้าแล้ว';
							        $message        = file_get_contents('template/email/complete.admin.html');
							        $message        = str_replace('%domain%' ,$metadata['domain'], $message);
							        $message        = str_replace('%name%', $user->name, $message);
							        $message        = str_replace('%order_id%', $_POST['order_id'], $message);
							        $mail->Body     = $message;
							        $mail->AltBody  = 'This is the body in plain text for non-HTML mail clients';

							        if(!$mail->send())
							            $email_send = $mail->ErrorInfo;
							        else
							            $email_send = "Message has been sent";
							    }
							}
						    // End Email Process.
						}

						// Save activity log
						$order->CreateOrderActivity(array(
							'token' 		=> $user->token,
							'member_id' 	=> $user->id,
							'order_id' 		=> $order->id,
							'order_action' 	=> $_POST['order_action'],
							'description' 	=> '',
						));

						// Return Message all Process in JSON format.
						$api->successMessage('#'.$_POST['order_id'].' - '.$_POST['order_action'].' Successed! ('.$email_send.')','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'EditAddress':
					if($user->Authentication()){
						// Edit name and phone
						$user->UpdateNamePhone(array(
					        'member_id'     => MEMBER_ID,
					        'name'          => $_POST['realname'],
					        'phone'         => $_POST['phone'],
					    ));

					    // Edit address in order
					    $order->EditAddress(array(
					    	'order_id' 		=> $_POST['order_id'],
					    	'address' 		=> $_POST['address'],
					    ));

						$api->successMessage('Name,Address,Phone updated!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'CancelTransfer':
					if($user->Authentication()){
						$order->OrderProcess(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'order_action' 	=> 'TransferAgain',
						));
						
						$bank->KillTransferMoney(array('order_id' => $_POST['order_id']));

						// Save activity log
						$order->CreateOrderActivity(array(
							'token' 		=> $user->token,
							'member_id' 	=> $user->id,
							'order_id' 		=> $_POST['order_id'],
							'order_action' 	=> 'TransferCancel',
							'description' 	=> '',
						));

						$api->successMessage('Money Transfer\'s Cancel!','','');
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
					$member_id = MEMBER_ID;
					if(!empty($member_id)){
						$order->MyCurrentOrder(array('member_id' => MEMBER_ID));
					}
					else{
						$api->successMessage('Successed!','','');
					}
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