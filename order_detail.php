<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$order->GetOrder(array('order_id' => $_GET['id']));
?>

<!DOCTYPE html>
<html lang="th" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">	

<?php
//include'favicon.php';
?>

<title>ใบสั่งซื้อ <?php echo $order->id;?></title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.form.min.js"></script>
<script type="text/javascript" src="js/lib/numeral.min.js"></script>
<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript" src="js/service/user.service.js"></script>
<script type="text/javascript" src="js/money.transfer.js"></script>
<script type="text/javascript" src="js/order.app.js"></script>

</head>

<body>
<?php include'header.php';?>

<div class="content">
	<div class="container">
		<div class="topic"><i class="fa fa-file-text-o"></i>ใบสั่งซื้อ <?php echo $order->id;?></div>

		<?php if($order->status != "Complete" && $order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>
		<div class="order-state">
			<div class="state-items <?php echo ($order->status == 'Shopping'?'state-active':'');?>">
				<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				<div class="caption">ช็อป</div>
			</div>
			<div class="state-items <?php echo ($order->status == 'Paying'?'state-active':'');?>">
				<div class="icon"><i class="fa fa-barcode"></i></div>
				<div class="caption">ชำระเงิน</div>
			</div>
			<div class="state-items <?php echo ($order->status == 'TransferRequest' || $order->status == 'TransferAgain'?'state-active':'');?>">
				<div class="icon"><i class="fa fa-money"></i></div>
				<div class="caption">โอนเงิน</div>
			</div>
			<div class="state-items <?php echo ($order->status == 'TransferSuccess'?'state-active':'');?>">
				<div class="icon"><i class="fa fa-check"></i></div>
				<div class="caption">กำลังจัดส่ง</div>
			</div>
			<div class="state-items <?php echo ($order->status == 'Shipping'?'state-active':'');?>">
				<div class="icon"><i class="fa fa-truck"></i></div>
				<div class="caption">รอรับของ</div>
			</div>
		</div>
		<?php }?>

		<div class="list">
			<?php if($order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>
				<?php if($order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="time"><i class="fa fa-clock-o"></i>23 ธันวาคม 2558 เวลา 15:20</div>
				<div class="order-box order-message">
					<p class="icon"><i class="fa fa-thumbs-o-up"></i></p>
					<p>การสั่งซื้อเสร็จสมบูรณ์ ขอบคุณที่ใช้บริการค่ะ</p>
				</div>
				<?php }?>

				<?php if($order->status == "Shipping" || $order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="time"><i class="fa fa-clock-o"></i>23 ธันวาคม 2558 เวลา 15:20</div>
				<div class="order-box order-message">
					<p class="icon"><i class="fa fa-truck"></i></p>
					<p>จัดส่งสินค้าเรียบร้อยแล้วค่ะ</p>
					<p class="shipping-code"><?php echo $order->ems;?></p>

					<?php if($order->status == "Shipping"){?>
					<div class="form-submit">
						<button class="submit-button" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Complete');">รับสินค้าแล้ว</button>
						<div class="form-caption">คุณ <?php echo $user->name;?> ได้รับสินค้าแล้วใช่หรือไม่ ?</div>
					</div>
					<?php }?>
				</div>
				<?php }?>

				<?php if($order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="time"><i class="fa fa-clock-o"></i>23 ธันวาคม 2558 เวลา 15:20</div>
				<div class="order-box order-message">
					<p class="icon"><i class="fa fa-check"></i></p>
					<p>ยืนยันการโอนเงินเรียบร้อย กำลังจัดส่งสินค้าค่ะ</p>
					<p title="<?php echo $order->confirm_time_thai_format;?>">เมื่อ <?php echo $order->confirm_time_facebook_format;?></p>
				</div>
				<?php }?>

				<?php if($order->status == "Paying"){?>
				<!-- Message -->
				<div class="time"><i class="fa fa-clock-o"></i>23 ธันวาคม 2558 เวลา 15:20</div>
				<div class="order-box order-message">
					<p class="icon"><i class="fa fa-clock-o"></i></p>
					<p>กรุณาชำระภายในวันที่ <?php echo $order->expire_time_thai_format;?> (<?php echo $order->expire_time_datediff;?>)</p>
					<p class="note">หากเกินกำหนดชำระเงินแล้ว สินค้าจะหลุดจอง ขอบคุณค่ะ</p>
				</div>
				<?php }?>

				<?php if($order->status == "Paying" || $order->status == "TransferAgain"){?>
				<!-- Money Transfer -->
				<div class="order-box order-money-transfer">
					<div class="topic">ยืนยันการโอนเงิน</div>
					<form id="MoneyTransfer" action="money.transfer.process.php" method="post" enctype="multipart/form-data">
					<div class="form">
						<div class="form-items">
							<div class="label">โอนเข้าธนาคาร</div>
							<div class="input">
								<select name="to_bank" class="input-select">
									<option value="0">เลือกบัญชีที่คุณโอนเข้า...</option>
									<?php $bank->ListBank(array('null' => 0));?>
								</select>
							</div>
						</div>

						<div class="form-items">
							<div class="label">
								ยอดเงินที่โอน
							</div>
							<div class="input">
								<input type="text" class="input-text" name="total" placeholder="ยอดชำระ <?php echo number_format($order->summary_payments);?> บาท">
							</div>
						</div>

						<div class="form-items">
							<div class="label">
								ภาพถ่ายสลิปใบโอนเงิน
							</div>
							<div class="input">
								<div class="image-input">
									<span id="photo_files_div"></span>
									<span id="photo_thumbnail">
										<div class="icon"><i class="fa fa-camera"></i> เลือกภาพ</div>
									</span>
									<input type="file" class="input-file" id="photo_files" name="image_file" accept="image/*">
								</div>
							</div>
						</div>

						<div class="form-items">
							<div class="label">ชื่อผุ้รับสินค้า</div>
							<div class="input">
								<input type="text" class="input-text" name="realname" placeholder="ชื่อ-นามสกุล..." value="<?php echo $user->name;?>">
							</div>
						</div>

						<div class="form-items full-size">
							<div class="input">
								<textarea name="address" class="input-text input-textarea" placeholder="ที่อยู่สำหรับส่งสินค้า..."><?php echo $order->address;?></textarea>
							</div>
						</div>

						<div class="form-items full-size">
							<div class="input">
								<textarea name="description" class="input-text input-textarea" placeholder="เพิ่มเติม..."><?php echo $order->description;?></textarea>
							</div>
						</div>

						

						<div class="form-submit">
							<button class="submit-button" type="submit">ยืนยันการโอนเงิน</button>
						</div>

						<input type="hidden" id="order_id" name="order_id" value="<?php echo $order->id?>">
					</div>
					</form>
				</div>
				<?php }?>

				<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>
				<!-- Money transfer info -->
				<div class="time"><i class="fa fa-clock-o"></i>23 ธันวาคม 2558 เวลา 15:20</div>
				<div class="order-box order-money-transfer">
					<div class="topic">หลักฐานการโอนเงิน รายการสั่งซื้อที่ <?php echo $order->id;?></div>
					<div class="form">
						<div class="form-items">
							<div class="label">โอนเข้าธนาคาร</div>
							<div class="input">ธนาคาร<?php echo $order->m_bank.' '.$order->m_bank_number;?></div>
						</div>

						<div class="form-items">
							<div class="label">
								ยอดเงินที่โอน
							</div>
							<div class="input"><?php echo number_format($order->m_total);?><span class="currency">฿</span></div>
						</div>

						<div class="form-items">
							<div class="label">
								ภาพถ่ายสลิปใบโอนเงิน
							</div>
							<div class="input">
								<div class="image-input">
									<img src="image/upload/normal/<?php echo $order->m_photo;?>" alt="">
								</div>
							</div>
						</div>

						<div class="form-items full-size">
							<div class="input"><i class="fa fa-truck"></i><?php echo $user->name;?></div>
						</div>

						<div class="form-items full-size">
							<div class="input"><i class="fa fa-truck"></i><?php echo $order->address;?></div>
						</div>

						<div class="form-items full-size">
							<div class="input"><i class="fa fa-comments"></i><?php echo $order->m_description;?></div>
						</div>
					</div>
				</div>
				<?php }?>


				<div class="time"><i class="fa fa-clock-o"></i>23 ธันวาคม 2558 เวลา 15:20</div>
				<div class="order-box order-list">
					<div class="topic-caption">
						<div class="title">รายการสินค้า</div>
						<div class="pay">รวม</div>
						<div class="quantity">จำนวน</div>
					</div>

					<?php
					$order->ListItemsInOrder(array(
						'order_id' 		=> $order->id,
						'order_status' 	=> $order->status,
					));
					?>

					<div class="items-payments subtotal">
						<div class="detail"><i class="fa fa-clone"></i>ราคาสินค้ารวม : </div>
						<div class="value">
							<span id="subpayments-display"><?php echo number_format($order->payments,2);?></span>
							<span class="currency">฿</span>
						</div>
					</div>

					<div class="items-payments">
						<div class="detail">
							<i class="fa fa-truck"></i>ค่าบริการส่ง : 
							<?php if($order->status == "Shopping"){?>
							<select id="shipping_type" class="shipping-select" onchange="javascript:SummaryPayments();">
								<option value="Ems">EMS</option>
								<option value="Register">ลงทะเบียน</option>
							</select>
							<?php }else{
								echo $order->shipping_type;
							}?>
						</div>
						<div class="value">
							<span id="shipping_payments"><?php echo number_format($order->shipping_payments,2);?></span>
							<span class="currency">฿</span>
						</div>
					</div>

					<div class="items-payments total-payments">
						<div class="detail"><i class="fa fa-barcode"></i>ยอดเงินที่ต้องชำระ : </div>
						<div class="value">
							<span id="payments-display"><?php echo number_format($order->summary_payments,2);?></span>
							<span class="currency">฿</span>
						</div>
					</div>

					<input type="hidden" id="all-payments" value="<?php echo $order->summary_payments;?>">

					<?php if($order->status == "Shopping"){?>
					<div class="form-submit">
						<div class="submit-button" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Paying');"><i class="fa fa-check"></i>ชำระเงิน</div>
					</div>
					<?php }?>
				</div>
			<?php }else{?>
			<div class="order-box order-message">
				<p class="icon"><i class="fa fa-thumbs-o-up"></i></p>
				<p>กรุณาเลือกสินค้าที่คุณต้องการค่ะ</p>
			</div>
			<?php }?>
		</div>
	</div>
</div>

<!-- Loading process submit photo to uploading. -->
<div id="filter">
	<div class="logo">dotdotdot</div>
	<div id="loading-bar"></div>
	<div id="loading-message"></div>
	<div class="cancel"><a href="me.php" target="_parent">ยกเลิก</a></div>
</div>

<script type="text/javascript" src="js/image.thumbnail.js"></script>

</body>
</html>