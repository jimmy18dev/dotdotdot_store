<?php
require_once'config/autoload.php';
include'sdk/facebook-sdk/autoload.php';
include'facebook.php';

// Get Order information.
$order->GetOrder(array('order_id' => $_GET['id']));

if(!MEMBER_ONLINE){
	header("Location: login.php");
	die();
}
if(MEMBER_ID != $order->customer_id){
	header("Location: 404.php");
	die();
}

// Order owner readed this order.
$order->ReadOrder(array('order_id' => $order->id));

// Current page
$current_page = "order";
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

<?php include'favicon.php';?>

<title>ใบสั่งซื้อ <?php echo $order->id;?></title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.autosize.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.form.min.js"></script>
<script type="text/javascript" src="js/lib/numeral.min.js"></script>

</head>

<body>
<?php include'header.php';?>

<div class="container container-fix">
	<div class="container-page">
		<?php if($order->status == "Shopping"){?>
		<a href="index.php" class="head-bar" id="head-bar">
			<span class="icon"><i class="fa fa-arrow-left"></i></span>
			<span class="caption">เลือกสินค้าเพิ่ม</span>
		</a>
		<?php }else{?>
		<a href="profile.php" class="head-bar" id="head-bar">
			<span class="icon"><i class="fa fa-arrow-left"></i></span>
			<span class="caption">ใบสั่งซื้อหมายเลข: <?php echo $order->id;?></span>
		</a>
		<?php }?>

		<div class="panel-fix">
			<div class="box">
				<?php if($order->status == "Shopping"){?>
				<div class="message">
					<p><i class="fa fa-file-o"></i></p>
					<p class="msg">กรุณาเลือกสินค้าและชำระเงินค่ะ</p>
				</div>
				<?php }else if($order->status == "TransferRequest"){?>
					<?php if($_GET['edit'] == "address"){?>
					<!-- Edit Name Address and Phone number of Customer -->
					<div class="form">
						<p class="topic">แก้ไขที่อยู่</p>
						<p class="caption">ชื่อ-นามสกุล</p>
						<input type="text" class="input-text" id="customer_name" value="<?php echo $order->customer_name;?>">
						
						<p class="caption">ที่อยู่ปัจจุบัน</p>
						<textarea class="input-text input-textarea" id="customer_address"><?php echo $order->customer_address;?></textarea>
						
						<p class="caption">เบอร์โทรศัพท์</p>
						<input type="text" class="input-text" id="customer_phone" value="<?php echo $order->customer_phone;?>">
						<button class="submit-btn" onclick="javascript:EditAddress(<?php echo $order->id?>);">บันทึก</button>
					</div>
					<?php }else{?>
					<div class="message">
						<p><i class="fa fa-hourglass-start"></i></p>
						<p class="msg">เรากำลังตรวจสอบหลักฐานการโอนเงิน...</p>
					</div>
					<?php }?>
				<?php }else if($order->status == "TransferSuccess"){?>
				<div class="message">
					<p><i class="fa fa-cube"></i></p>
					<p class="msg">กำลังจัดส่งสินค้า...</p>
				</div>
				<?php }else if($order->status == "Complete"){?>
				<div class="message message-success">
					<p><i class="fa fa-check-circle"></i></p>
					<p class="msg">การสั่งซื้อเสร็จสมบูรณ์</p>
				</div>
				<?php }else if($order->status == "Cencel"){?>
				<div class="message">
					<p><i class="fa fa-check"></i></p>
					<p class="msg">เกินกำหนดการชำระเงิน</p>
					<p class="msg">กรุณาเลือกสินค้าแล้วชำระเงินอีกครั้งค่ะ</p>
				</div>
				<?php }else if($order->status == "Paying" || $order->status == "TransferAgain" || $order->status == "Expire"){?>
				<div class="form">
					<form id="MoneyTransfer" action="money.transfer.process.php" method="post" enctype="multipart/form-data">
						<p class="caption">
							<span id="transfer_photo_icon" class="check"><i class="fa fa-check"></i></span>
							<span id="photo-input-caption" class="input-caption">ภาพถ่ายสลิปโอนเงิน</span>
						</p>

						<!-- Input file select -->
						<input type="file" class="input-file" id="photo_files" name="image_file" accept="image/*">

						<div class="input-image">
							<span id="photo_files_div"></span>
							<span id="photo_thumbnail">
								<div class="btn">
									<p><i class="fa fa-camera"></i>เลือกภาพ</p>
								</div>
							</span>
						</div>

						<p class="caption"><span id="transfer_total_icon" class="check"><i class="fa fa-check"></i></span>ยอดเงินที่โอน:</p>
						<input type="text" class="input-text" name="total" id="transfer_total" placeholder="0.00" autofocus>

						<p class="caption"><span id="transfer_bank_icon" class="check"><i class="fa fa-check"></i></span>โอนเข้าธนาคาร:</p>
						<select name="to_bank" id="transfer_bank" class="input-text input-select">
							<option value="0">เลือกบัญชีที่คุณโอนเข้า...</option>
							<?php $bank->ListBank(array('mode' => 'select'));?>
						</select>
						
						<p class="caption"><span id="transfer_name_icon" class="check"><i class="fa fa-check"></i></span>ชื่อผู้รับสินค้า</p>
						<input type="text" class="input-text" name="realname" id="transfer_realname" placeholder="ชื่อ-นามสกุล..." value="<?php echo $user->name;?>">
						<p class="caption"><span id="transfer_address_icon" class="check"><i class="fa fa-check"></i></span>ที่อยู่</p>
						<textarea name="address" id="transfer_address" class="input-text input-textarea animated" placeholder="ที่อยู่สำหรับส่งสินค้า..." id="transfer_address"><?php echo (empty($order->address)?$order->customer_address_history:$order->customer_address);?></textarea>
						<p class="caption"><span id="transfer_phone_icon" class="check"><i class="fa fa-check"></i></span>เบอร์โทรศัพท์</p>
						<input type="text" class="input-text" id="transfer_phone" name="phone" placeholder="เบอร์โทรศัพท์..." value="<?php echo $user->phone;?>">

						<!-- <textarea name="description" id="transfer_description" class="input-text input-textarea animated" placeholder="เพิ่มเติม..."><?php echo $order->description;?></textarea> -->

						<input type="hidden" id="order_id" name="order_id" value="<?php echo $order->id?>">
						<input type="hidden" id="max_filesize" value="<?php echo (int)(ini_get('upload_max_filesize'))*1048576;?>">
						<button class="submit-btn" type="submit"><i class="fa fa-arrow-up"></i>ส่งหลักฐาน</button>
					</form>
				</div>
				<?php }else if($order->status == "Shipping"){?>
				<div class="message">
					<p><i class="fa fa-truck"></i></p>
					<p>ทางเราได้จัดส่งสินค้าให้คุณ <?php echo $user->name;?> เรียบร้อยแล้ว</p>
					<p>คุณ <?php echo $user->name;?> ได้รับสินค้าแล้วใช่หรือไม่ ?</p>

					<button class="btn" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Complete');"><i class="fa fa-check"></i>รับสินค้าแล้ว</button>
				</div>
				<?php }?>
			</div>
		</div>


		<div class="panel">
			<div class="order-detail">
			<?php if($order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>
				<?php if($order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="box-items" id="complete">
					<div class="icon"><i class="fa fa-check"></i></div>
					<div class="box">
						<p class="big">เรียบร้อย</p>
						<p>การสั่งซื้อเสร็จสมบูรณ์ ขอบคุณที่ใช้บริการค่ะ</p>
						<p class="caption"> <span class="time" title="<?php echo $order->complete_time_th;?>"><?php echo $order->complete_time_fb;?></span></p>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "Shipping" || $order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="box-items" id="shipping">
					<div class="icon"><i class="fa fa-truck"></i></div>
					<div class="box">
						<p class="big">พัสดุหมายเลข <?php echo $order->ems;?></p>
						<p>เราจัดส่งสินค้าตามที่อยู่เรียบร้อยแล้วค่ะ</p>
						<p class="caption"><span class="time" title="<?php echo $order->shipping_time_th;?>"><?php echo $order->shipping_time_fb;?></span></p>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "TransferAgain"){?>
				<div class="box-items" id="complete">
					<div class="icon"><i class="fa fa-info-circle"></i></div>
					<div class="box">
						<p class="big">ส่งหลักฐานโอนเงินอีกครั้ง!</p>
						<p>เราไม่พบยอดโอนเงินที่คุณส่งหลักฐาน กรุณาตรวจสอบอีกครั้งค่ะ</p>
						<p class="caption">หากพบปัญหาในการส่งหลักฐาน กรุณาติดต่อทีมงานค่ะ</p>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="box-items" id="success">
					<div class="icon"><i class="fa fa-check"></i></div>
					<div class="box">
						<p class="big">ชำระเงินแล้ว</p>
						<p>ยืนยันการโอนเงินเรียบร้อย เรากำลังจัดส่งสินค้าให้นะคะ</p>
						<p class="caption"><span class="time" title="<?php echo $order->success_time_th;?>"><?php echo $order->success_time_fb;?></span></p>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>


				<?php if($_GET['edit'] != "address"){?>
				<!-- Address -->
				<div class="box-items" id="address">
					<div class="icon"><i class="fa fa-map-pin"></i></div>
					<div class="box">
						<p class="big">คุณ <?php echo $order->customer_name;?></p>
						<p><?php echo $order->customer_address;?></p>
						<p><?php echo $order->customer_phone?></p>
						<p class="caption">อัพเดทล่าสุด <span class="time" title="<?php echo $order->confirm_time_th;?>"><?php echo $order->confirm_time_fb;?></span></p>

						<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess"){?>
						<p class="edit"><a href="order-<?php echo $order->id;?>.html?edit=address">แก้ไขที่อยู่</a></p>
						<?php }?>
					</div>
				</div>
				<?php }?>

				<!-- Money transfer info -->
				<div class="box-items" id="transfer">
					<div class="icon"><i class="fa fa-file-text"></i></div>
					<div class="box">
						<p class="big">แจ้งโอนเงิน <span class="highlight"><?php echo number_format($order->m_total,2);?></span> บาท</p>
						<p>โอนเงินเข้า: <strong><?php echo $bank->BankName($order->m_bank_code);?></strong> <?php echo $order->m_bank_number;?></p>

						<?php if(!empty($order->m_message)){?>
						<p class="message">"<?php echo $order->m_message;?>"</p>
						<?php }?>

						<?php if(!empty($order->m_photo)){?>
						<div class="image">
							<img src="../image/upload/normal/<?php echo $order->m_photo;?>" alt="">
						</div>
						<?php }?>

						<p class="caption">หลักฐานการโอนเงิน · <span class="time" title="<?php echo $order->confirm_time_th;?>"><?php echo $order->confirm_time_fb;?></span></p>

						<?php if($order->status == "TransferRequest"){?>
						<p class="edit"><span onclick="javascript:CencelTransfer(<?php echo $order->id;?>);">ยกเลิก</span></p>
						<?php }?>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "Paying" || $order->status == "TransferAgain" || $order->status == "Expire"){?>
				<div class="box-items">
					<div class="icon"><i class="fa fa-barcode"></i></div>
					<div class="box">
						<p class="big">ยอดชำระเงิน <?php echo number_format($order->summary_payments,2);?> บาท</p>
						<p class="caption">ส่งหลักฐานการโอนเงิน</p>
						<p class="limit">กรุณาชำระภายในวันที่ <?php echo $order->expire_time_thai_format;?> (<?php echo $order->expire_time_datediff;?>)</p>

						<div class="bank">
							<?php $bank->ListBank(array('mode' => 'items'));?>
						</div>
					</div>
				</div>
				<?php }?>

				<div class="box-items" id="product-list">
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
					<div class="box">

						<?php if($order->status != "Shopping"){?>
						<p class="big">รายการสินค้า</p>
						<p class="caption">รายการสินค้า · <span class="time" title="<?php echo $order->paying_time_th;?>"><?php echo $order->paying_time_fb;?></span></p>
						<?php }?>

						<!-- Order list -->
						<div class="order-list">
							<div class="topic-caption">
								<div class="detail"><?php echo $order->total;?> รายการ</div>
								<div class="quantity">จำนวน</div>
								<div class="total">รวม</div>
							</div>

							<?php
							$order->ListItemsInOrder(array(
								'order_id' 		=> $order->id,
								'order_status' 	=> $order->status,
							));
							?>

							<?php if($order->total > 1){?>
							<div class="summary-items">
								<div class="summary-items-detail">รวมราคาสินค้า : </div>
								<div class="summary-items-total"><span id="subpayments-display"><?php echo number_format($order->payments,2);?></span></div>
							</div>
							<?php }?>

							<div class="summary-items">
								<div class="summary-items-detail"><i class="fa fa-truck"></i> 
									<?php if($order->status == "Shopping"){?>
									<select id="shipping_type" class="shipping-select" onchange="javascript:SummaryPayments();">
										<option value="Ems">พัสดุ EMS</option>
										<option value="Register">พัสดุลงทะเบียน</option>
									</select>
									<?php }else{
										echo ($order->shipping_type == "Ems"?"พัสดุด่วนพิเศษ (EMS)":"พัสดุลงทะเบียน");
									}?>
								</div>
								<div class="summary-items-total"><span id="shipping_payments"><?php echo number_format($order->shipping_payments,2);?></span></div>
							</div>

							<div class="summary-items summary-total">
								<div class="summary-items-detail">ยอดเงินที่ต้องชำระ : </div>
								<div class="summary-items-total">฿ <span id="payments-display"><?php echo number_format($order->summary_payments,2);?></span></div>
							</div>
						</div>

						<?php if($order->status == "Shopping"){?>
						<div class="form-control" id="paying-button">
							<div class="submit-btn" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Paying');">฿ <span id="payments-btn-display"><?php echo number_format($order->summary_payments,2);?></span> ชำระเงิน<i class="fa fa-arrow-right"></i></div>
						</div>
						<?php }?>

						<input type="hidden" id="all-payments" value="<?php echo $order->summary_payments;?>">
					</div>
				</div>
				<?php }else{?>
				<div class="box-items">
					<div class="icon"><i class="fa fa-file-o"></i></div>
					<div class="box">
						<p class="big">ไม่พบสินค้า!</p>
						<p>กรุณาเลือกสินค้าที่คุณต้องการก่อนนะคะ...</p>
					</div>
				</div>
				<?php }?>

				<? if($order->status == "Paying"){?>
				<div class="cancel-btn" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Cancel');"><i class="fa fa-times"></i>ยกเลิกการสั่งซื้อ</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>

<?php include'template/loading.dialog.box.php';?>

<?php if($order->status == "Paying" || $order->status == "TransferAgain" || $order->status == "Expire"){?>
<!-- Loading process submit photo to uploading. -->
<div class="progress-panel" id="progress-panel">
	<div class="message">
		<div class="icon" id="progress-icon"><i class="fa fa-cloud-upload"></i></div>
		<div class="caption" id="progress-message">กำลังส่งหลักฐาน...</div>
	</div>
	<div class="progress">
		<div class="progress-bar" id="progress-bar"></div>
	</div>

	<a href="profile.php" target="_parent" class="cancel">ยกเลิก</a>
</div>

<script type="text/javascript" src="js/min/image.thumbnail.min.js"></script>
<?php }?>

<script type="text/javascript" src="js/service/min/order.service.min.js"></script>
<script type="text/javascript" src="js/service/min/user.service.min.js"></script>
<script type="text/javascript" src="js/min/money.transfer.min.js"></script>
<script type="text/javascript" src="js/min/order.app.min.js"></script>
<script type="text/javascript" src="js/min/init.min.js"></script>

</body>
</html>