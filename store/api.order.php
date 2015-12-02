<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Order':
			switch ($_POST['action']) {
				case 'OrderProcess':
					if($user->Authentication() && $user->type == "administrator"){
						$order->OrderProcess(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'order_action' 	=> $_POST['order_action'],
						));

						if($_POST['order_action'] == "TransferAgain"){
							$bank->KillTransferMoney(array('order_id' => $_POST['order_id']));
						}

						// Get Order data
						$order->GetOrder(array('order_id' => $_POST['order_id']));

						// Send Notification Email to Customer
						if($_POST['order_action'] == "Expire"){}
						else if($_POST['order_action'] == "Cancel"){}
						else if($_POST['order_action'] == "Paying"){}
						else if($_POST['order_action'] == "TransferRequest"){}
						else if($_POST['order_action'] == "TransferAgain"){
							
							// Sending to Customer
							if(!empty($order->customer_email) && $order->customer_status == "verified"){
								$mail->addAddress($order->customer_email);
								$mail->Subject 	= 'หลักฐานการโอนเงินไม่ถูกต้อง!';
								$message 		= file_get_contents('template/email/again.html');
								$message 		= str_replace('%domain%' ,$metadata['domain'], $message);
								$message 		= str_replace('%name%', $order->customer_name, $message);
								$message 		= str_replace('%order_id%', $order->id, $message);
								$message 		= str_replace('%summary_payment%', number_format($order->summary_payments,2), $message);
								$mail->Body    	= $message;
								$mail->AltBody 	= 'This is the body in plain text for non-HTML mail clients';

								if(!$mail->send())
									$email_send = $mail->ErrorInfo;
								else
									$email_send = "Message has been sent";
							}
						}
						else if($_POST['order_action'] == "TransferSuccess"){
							// Sending to Customer
							if(!empty($order->customer_email) && $order->customer_status == "verified"){
								$mail->addAddress($order->customer_email);
								$mail->Subject 	= 'ชำระเงินค่าสินค้าแล้ว!';
								$message 		= file_get_contents('template/email/success.html');
								$message 		= str_replace('%domain%' ,$metadata['domain'], $message);
								$message 		= str_replace('%order_id%', $order->id, $message);
								$message 		= str_replace('%name%', $order->customer_name, $message);
								$message 		= str_replace('%summary_payment%', number_format($order->summary_payments,2), $message);
								$message        = str_replace('%customer_name%',$order->customer_name, $message);
								$message        = str_replace('%customer_address%',$order->customer_address, $message);
								$message        = str_replace('%customer_phone%',$order->customer_phone, $message);
								
								$mail->Body    	= $message;
								$mail->AltBody 	= 'This is the body in plain text for non-HTML mail clients';

								if(!$mail->send())
									$email_send = $mail->ErrorInfo;
								else
									$email_send = "Message has been sent";
							}
						}
						else if($_POST['order_action'] == "Shipping"){}
						else if($_POST['order_action'] == "Complete"){}

						// Save order activity log
						$order->CreateOrderActivity(array(
							'token' 		=> $user->token,
							'member_id' 	=> $user->id,
							'order_id' 		=> $order->id,
							'order_action' 	=> $_POST['order_action'],
							'description' 	=> '',
						));

						$api->successMessage('#'.$_POST['order_id'].' - '.$_POST['order_action'].' Successed! ('.$email_send.')','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'EmsUpdate':
					if($user->Authentication() && $user->type == "administrator"){
						$order->UpdateEmsOrder(array(
							'order_id' 		=> $_POST['order_id'],
							'ems' 			=> $_POST['ems'],
						));

						$order->OrderProcess(array(
							'member_id' 	=> MEMBER_ID,
							'order_id' 		=> $_POST['order_id'],
							'order_action' 	=> "Shipping",
							'description' 	=> '',
						));

						// Get Order data
						$order->GetOrder(array('order_id' => $_POST['order_id']));

						// Sending to Customer
						if(!empty($order->customer_email) && $order->customer_status == "verified"){
							$mail->addAddress($order->customer_email);
							$mail->Subject 	= 'แจ้งหมายเลขพัสดุสินค้า!';
							$message 		= file_get_contents('template/email/shipping.html');
							$message 		= str_replace('%domain%' ,$metadata['domain'], $message);
							$message 		= str_replace('%name%', $order->customer_name, $message);
							$message 		= str_replace('%order_id%', $order->id, $message);
							$message 		= str_replace('%ems%', $order->ems, $message);
							$mail->Body    	= $message;
							$mail->AltBody 	= 'This is the body in plain text for non-HTML mail clients';

							if(!$mail->send())
								$email_send = $mail->ErrorInfo;
							else
								$email_send = "Message has been sent";
						}

						// Save order activity log
						$order->CreateOrderActivity(array(
							'token' 		=> $user->token,
							'member_id' 	=> $user->id,
							'order_id' 		=> $order->id,
							'order_action' 	=> $_POST['order_action'],
							'description' 	=> '',
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