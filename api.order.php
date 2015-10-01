<?php
require_once'config/autoload.php';
header("Content-type: text/json");
// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Order':
			// Get Order data
			$order->GetOrder(array('order_id' => $_POST['order_id']));

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

						if($_POST['order_action'] == "Paying"){
							$mail->addAddress('mrjimmy18@gmail.com');
							$mail->Subject = 'ทดสอบส่ง email จาก igensite.com';

							// Retrieve the email template required
							$message = file_get_contents('template/email/money_transfer.html');

							// Replace the % with the actual information
							$message = str_replace('%order_id%', $order->id, $message);
							$message = str_replace('%payment%', number_format($order->summary_payments,2), $message);
// 							$message = '
// <html>
// <head>
// <meta charset="utf-8">
// </head>
// <body style="background-color:#FFFFFF;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-family:sans-serif;line-height:1.5em;" >
// <div class="container" style="width:100%;float:left;display:inline-block;text-align:center;" >
// <div class="topic" style="width:100%;padding-top:3%;padding-bottom:3%;padding-right:0%;padding-left:0%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#000000;font-size:1.2em;font-weight:bold;" >ยืนยันการสั่งซื้อเลขที่ #324502</div>
// <div class="info" style="width:100%;padding-top:3%;padding-bottom:3%;padding-right:0%;padding-left:0%;float:left;display:inline-block;" >
// 	<p style="font-size:1.2em;" >กรุณาชำระภายใน 30 กันยายน 2558 เวลา 16:40 (1 วัน)</p>
// 	<p class="payments" style="font-size:3em;font-weight:bold;" >7,390.00 ฿</p>
// 	<p class="note" style="font-size:1em;color:#AAAAAA;" >หากเกินกำหนดชำระเงินแล้ว สินค้าจะหลุดจอง ขอบคุณค่ะ</p>
// </div>
// <div class="bank" style="width:94%;padding-top:3%;padding-bottom:3%;padding-right:3%;padding-left:3%;float:left;display:inline-block;background-color:#FAFAFA;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:1.2em;text-align:left;" >
// 	<div class="caption" style="color:#AAAAAA;font-size:0.8em;" >ช่องทางการโอนเงิน</div>
// 	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
// 		<p class="name">ธนาคารกรุงไทย</p>
// 		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
// 	</div>
// 	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
// 		<p class="name">ธนาคารกรุงไทย</p>
// 		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
// 	</div>
// 	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
// 		<p class="name">ธนาคารกรุงไทย</p>
// 		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
// 	</div>
// 	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
// 		<p class="name">ธนาคารกรุงไทย</p>
// 		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
// 	</div>
// 	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
// 		<p class="name">ธนาคารกรุงไทย</p>
// 		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
// 	</div>
// </div>
// <div class="confirm" style="width:60%;padding-top:10%;padding-bottom:10%;padding-right:20%;padding-left:20%;float:left;display:inline-block;" >
// 	<a href="http://dotdotdot.local/order_detail.php?id=1" style="text-decoration:none;" >
// 	<div class="button" style="text-decoration:none;background-color:#000000;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:#FFFFFF;padding-top:5%;padding-bottom:5%;padding-right:10%;padding-left:10%;font-size:1.2em;" >ยืนยันการโอนเงิน</div>
// 	</a>
// </div>
// <div class="footer" style="width:100%;float:left;display:inline-block;border-top-width:1px;border-top-style:solid;border-top-color:#000000;font-size:1em;padding-top:3%;padding-bottom:3%;padding-right:0%;padding-left:0%;font-weight:bold;" >
// 	<span class="text" style="text-align:right;float:left;" >dotdotdot limited 2016</span>
// 	<a href="http://dotdotdot.local/order_detail.php?id=1" style="text-decoration:none;color:#000000;float:right;" >ตรวจสอบรายการสินค้า</a></div>
// </div>
// </body>
// </html>
// ';
							$mail->Body    = $message;
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

							if(!$mail->send()){
								// $mail->ErrorInfo;
								$email_send = $mail->ErrorInfo;
							}else {
								$email_send = "Message has been sent";
							}
						}
						$api->successMessage('#'.$_POST['order_id'].' - '.$_POST['order_action'].' Successed! ('.$email_send.')','','');
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