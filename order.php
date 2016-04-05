<?php
require_once'config/autoload.php';

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

<title>หมายเลขของคำสั่งซื้อ #<?php echo $order->id;?></title>

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
	<div class="head-bar" id="start">
		<div class="head-content">
			<?php if($order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>
			<h1><?php echo ($order->status == "Shopping"?'ตะกร้าสินค้า':'หมายเลขของคำสั่งซื้อ '.$order->id);?></h1>

			<?php if($order->status != 'Shopping'){?>
			<p>สั่งเมื่อวันที่ <span class="time" title="<?php echo $order->paying_time_th;?>"><?php echo $order->paying_time_fb;?></span> <?php echo ($order->status=='Complete'?'<span class="complete">ปิดการขาย</span>':'<span class="payment">ยอดชำระ '.number_format($order->summary_payments,2).' ฿.</span>');?></p>
			<?php }?>

			<?php if($order->status == "Cancel"){?>
			<p>การสั่งซื้อถูกยกเลิก เนื่องจากเกินเวลาชำระเงินค่ะ</p>
			<?php }?>
			<?php }?>

		</div>

		<?php if($order->status != "Shopping" && $order->status != "Cancel" && $order->status != 'Complete'){?>
		<div class="order-state">
			<a href="#product-list" class="state-items <?php echo ($order->state >= 2 ?'state-active':'');?> <?php echo ($order->state == 2 ?'state-current':'');?>">
				<div class="caption">สั่งซื้อ</div>
				<div class="icon"><?php echo ($order->state > 1?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-circle-thin"></i>');?></div>
			</a>
			<div class="connect <?php echo ($order->state > 2 ?'connect-active':'');?>"></div>
			<a href="#transfer" class="state-items <?php echo ($order->state >= 3 ?'state-active':'');?> <?php echo ($order->state == 3 ?'state-current':'');?>">
				<div class="caption">โอนเงิน</div>
				<div class="icon"><?php echo ($order->state > 2?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-file-text-o"></i>');?></div>
			</a>
			<div class="connect <?php echo ($order->state > 3 ?'connect-active':'');?>"></div>
			<a href="#success" class="state-items <?php echo ($order->state >= 4 ?'state-active':'');?> <?php echo ($order->state == 4 ?'state-current':'');?>">
				<div class="caption">ชำระแล้ว</div>
				<div class="icon"><?php echo ($order->state > 3?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-check"></i>');?></div>
			</a>
			<div class="connect <?php echo ($order->state > 4 ?'connect-active':'');?>"></div>
			<a href="#shipping" class="state-items <?php echo ($order->state >= 5 ?'state-active':'');?> <?php echo ($order->state == 5 ?'state-current':'');?>">
				<div class="caption">ส่งของแล้ว</div>
				<div class="icon"><?php echo ($order->state > 4?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-truck"></i>');?></div>
			</a>
			<div class="connect <?php echo ($order->state > 5 ?'connect-active':'');?>"></div>
			<a href="#complete" class="state-items <?php echo ($order->state >= 6 ?'state-active':'');?>">
				<div class="caption">เรียบร้อย</div>
				<div class="icon"><?php echo ($order->state > 5?'<i class="fa fa-check-circle"></i>':'<i class="fa fa-thumbs-o-up"></i>');?></div>
			</a>
		</div>
		<?php }?>
	</div>

	<div class="container-page">
		<div class="order-detail">
			<?php if($order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>

			<?php if($order->status != 'Shopping'){?>
			<div class="box-items box-items-fix">
				<div class="datetime">วันที่/เวลา</div>
				<div class="box">รายละเอียด</div>
			</div>
			<?php }?>
			
			<?php if($order->status == "Complete"){?>
			<!-- Order complete dialog -->
			<div class="box-items box-items-success" id="complete">
				<div class="datetime"><span class="time"><?php echo $order->complete_time_th;?></span></div>
				<div class="box">
					<b class="topic"><i class="fa fa-check-circle"></i>ปิดการขาย</b>
					<div class="description">เราหวังว่าคุณจะมีความสุขกับสินค้าใหม่ที่คุณได้รับไป ขอบคุณสำหรับการช้อปปิ้งสินค้าออนไลน์กับเรา และหวังว่าจะได้รับโอกาสบริการคุณอีกครั้ง</div>
				</div>
			</div>
			<?php }?>

			<?php if($order->status == "Shipping" || $order->status == "Complete"){?>
			<!-- Order Shipping Dialog -->
			<div class="box-items" id="shipping">
				<div class="datetime"><span class="time"><?php echo $order->shipping_time_th;?></span></div>
				<div class="box">
					<b class="topic"><i class="fa fa-truck"></i>จัดส่งสินค้าแล้ว</b>
					<div class="description">สินค้าของคุณกำลังอยู่ระหว่างการจัดส่ง หมายเลขขนส่ง <strong>[<?php echo $order->ems;?>].</strong> คุณสามารถติดตามสถานะของสินค้าคุณได้ที่ <a href="http://track.thailandpost.co.th/tracking/default.aspx">Thailand Post Track & Trace</a></div>
					
					<?php if($order->status == "Shipping"){?>
					<div class="control">
						<div class="control-caption">ตอนนี้คุณได้รับสินค้าแล้วใช่หรือไม่ ?</div>
						<div class="btn btn-confirm" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Complete');">ได้รับสินค้าแล้ว<i class="fa fa-angle-right"></i></div>
					</div>
					<?php }?>
				</div>
			</div>
			<?php }?>

			<?php if($order->status == "Paying" || $order->status == "TransferAgain" || $order->status == "Expire"){?>
			<!-- Bank info for Money Transfer -->
			<div class="box-items" id="bank">
				<div class="datetime"><?php echo $order->paying_time_th;?></div>
				<div class="box">
					<b class="topic"><i class="fa fa-university"></i>เลขบัญชีธนาคาร</b>
					<div class="description">ยอดเงินที่ต้องชำระเงิน <strong><?php echo number_format($order->summary_payments,2);?> บาท</strong> <span>ชำระภายในวันที่ <?php echo $order->expire_time_thai_format;?> (อีก <?php echo $order->expire_time_datediff;?>)</span></div>

					<div class="bank">
						<?php $bank->ListBank(array('mode' => 'items'));?>
					</div>

					<div class="control"><a class="btn btn-edit" href="#money-transfer">ยันยืนการโอน</a></div>
				</div>
			</div>
			<?php }?>

			<?php if($order->status == "Paying" || $order->status == "TransferAgain" || $order->status == "Expire"){?>
			<!-- Money Transfer dialog -->
			<div class="box-items" id="money-transfer">
				<div class="datetime"><?php echo $order->paying_time_th;?></div>
				<div class="box">
					<?php if($order->status == "Paying"){?>
					<b class="topic"><i class="fa fa-file-text-o"></i>ส่งหลักฐานโอนเงิน</b>
					<?php }else if($order->status == "TransferAgain"){?>
					<b class="topic"><i class="fa fa-file-text-o"></i>ส่งหลักฐานโอนเงินอีกครั้ง</b>
					<div class="description">เราไม่พบยอดโอนเงินที่คุณส่งหลักฐานเข้ามา กรุณาตรวจสอบอีกครั้งค่ะ ขอบคุณค่ะ</div>
					<?php }?>

					<form class="form" id="MoneyTransfer" action="money.transfer.process.php" method="post" enctype="multipart/form-data">
						<p class="caption"><span id="photo-input-caption" class="input-caption">ภาพถ่ายสลิปโอนเงิน:</span></p>
						<!-- Input file select -->
						<input type="file" class="input-file" id="photo_files" name="image_file" accept="image/*">
						<div class="icon-checking"><span id="transfer_photo_icon" class="check"><i class="fa fa-check"></i></span></div>

						<!-- Image thumbnail container -->
						<div class="input-image">
							<span id="photo_files_div"></span>
							<span id="photo_thumbnail">
								<div class="btn">
									<p><i class="fa fa-camera"></i>เลือกภาพ</p>
								</div>
							</span>
						</div>

						<p class="caption">ยอดเงินที่โอน:</p>
						<input type="number" class="input-text" name="total" id="transfer_total" placeholder="0.00" autocomplete="off">
						<div class="icon-checking"><span id="transfer_total_icon" class="check"><i class="fa fa-check"></i></span></div>

						<p class="caption">โอนเข้าธนาคาร:</p>
						<select name="to_bank" id="transfer_bank" class="input-text input-select">
							<option value="0">เลือกบัญชีที่คุณโอนเข้า...</option>
							<?php $bank->ListBank(array('mode' => 'select'));?>
						</select>
						<div class="icon-checking"><span id="transfer_bank_icon" class="check"><i class="fa fa-check"></i></span></div>
							
						<p class="caption">ชื่อผู้รับสินค้า:</p>
						<input type="text" class="input-text" name="realname" id="transfer_realname" placeholder="ชื่อ-นามสกุล..." value="<?php echo $user->name;?>">
						<div class="icon-checking"><span id="transfer_name_icon" class="check"><i class="fa fa-check"></i></span></div>
						
						<p class="caption">ที่อยู่:</p>
						<textarea name="address" id="transfer_address" class="input-text input-textarea animated" placeholder="ที่อยู่สำหรับส่งสินค้า..." id="transfer_address"><?php echo (empty($order->address)?$user->address:$order->customer_address);?></textarea>
						<div class="icon-checking"><span id="transfer_address_icon" class="check"><i class="fa fa-check"></i></span></div>
						
						<p class="caption">เบอร์โทรศัพท์:</p>
						<input type="tel" class="input-text" id="transfer_phone" name="phone" placeholder="เบอร์โทรศัพท์..." value="<?php echo $user->phone;?>">
						<div class="icon-checking"><span id="transfer_phone_icon" class="check"><i class="fa fa-check"></i></span></div>
							
						<p class="caption">ฝากข้อความ:</p>
						<textarea name="description" id="transfer_description" class="input-text input-textarea animated" placeholder="เขียนข้อความที่นี่..."><?php echo $order->description;?></textarea>

						<input type="hidden" id="order_id" name="order_id" value="<?php echo $order->id?>">
						<input type="hidden" id="max_filesize" value="<?php echo (int)(ini_get('upload_max_filesize'))*1048576;?>">
						<button class="submit-btn" type="submit">ส่งหลักฐาน<i class="fa fa-angle-right"></i></button>
					</form>
				</div>
			</div>
			<?php }?>

			
			<?php if($order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>
			<!-- Payment Success and Confirm Money Transfer -->
			<div class="box-items box-items-success" id="success">
				<div class="datetime"><span class="time"><?php echo $order->success_time_th;?></span></div>
				<div class="box">
					<b class="topic"><i class="fa fa-check"></i>ชำระเงินแล้ว</b>
					<div class="description">สินค้าของคุณอยู่ระหว่างดำเนินการที่คลังสินค้าของเรา โดยจะพร้อมเพื่อเตรียมการจัดส่งภายในวันนี้</div>
				</div>
			</div>
			<?php }?>
			
			<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>

			<?php if($_GET['edit'] != "address"){?>
			<!-- Address Dialog -->
			<div class="box-items" id="address">
				<div class="datetime"><span class="time"><?php echo $order->confirm_time_th;?></span></div>
				<div class="box">
					<b class="topic"><i class="fa fa-map-pin"></i>ที่อยู่สำหรับจัดส่ง</b>
					<div class="description">ชื่อ <strong><?php echo $order->customer_name;?></strong><br>
					ที่อยู่ : <?php echo $order->customer_address;?> (เบอร์โทรศัพท์ <?php echo $order->customer_phone?>)</div>

					<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess"){?>
					<div class="control">
						<a class="btn btn-edit" href="order-<?php echo $order->id;?>.html?edit=address#address">แก้ไขที่อยู่<i class="fa fa-cog"></i></a>
					</div>
					<?php }?>
				</div>
			</div>
			<?php }?>

			<?php if($_GET['edit'] == 'address'){?>
			<!-- Edit Address Dialog -->
			<div class="box-items" id="address">
				<div class="datetime"><?php echo $order->confirm_time_th;?></div>
				<div class="box">
					<b class="topic"><i class="fa fa-map-pin"></i>ที่อยู่สำหรับจัดส่ง</b>
					<div class="description">แก้ไขที่อยู่สำหรับจัดส่งสินค้า กรุณาตรวจสอบความถูกต้องก่อนบันทึก</div>

					<!-- Edit Name Address and Phone number of Customer -->
					<div class="form">
						<p class="caption">ชื่อ-นามสกุล</p>
						<input type="text" class="input-text" id="customer_name" value="<?php echo $order->customer_name;?>">
							
						<p class="caption">ที่อยู่ปัจจุบัน</p>
						<textarea class="input-text input-textarea" id="customer_address"><?php echo $order->customer_address;?></textarea>
							
						<p class="caption">เบอร์โทรศัพท์</p>
						<input type="text" class="input-text" id="customer_phone" value="<?php echo $order->customer_phone;?>">
						<button class="submit-btn" onclick="javascript:EditAddress(<?php echo $order->id?>);">บันทึก<i class="fa fa-angle-right"></i></button>
					</div>
				</div>
			</div>
			<?php }?>

			<!-- Money Transfer Detail -->
			<div class="box-items" id="info-transfer">
				<div class="datetime"><?php echo $order->confirm_time_th;?></div>
				<div class="box">
					<b class="topic"><i class="fa fa-file-text-o"></i>แจ้งโอนเงินแล้ว</b>
					<div class="description"><strong>คุณแจ้งโอนเงิน <span class="highlight"><?php echo number_format($order->m_total,2);?></span> บาท</strong> โดยโอนเงินเข้าบัญชีของ <strong><?php echo $bank->BankName($order->m_bank_code);?></strong> เลขบัญชี <?php echo $order->m_bank_number;?></div>

					<?php if(!empty($order->m_description)){?>
					<div class="message">"<?php echo $order->m_description;?>"</div>
					<?php }?>

					<?php if(!empty($order->m_photo)){?>
					<div class="image">
						<a href="../image/upload/normal/<?php echo $order->m_photo;?>" target="_blank">
							<img src="../image/upload/normal/<?php echo $order->m_photo;?>" alt="">
						</a>
					</div>
					<?php }?>

					<?php if($order->status == "TransferRequest"){?>
					<div class="control">
						<div class="btn btn-delete" onclick="javascript:CencelTransfer(<?php echo $order->id;?>);">ลบการสลิปนี้<i class="fa fa-times"></i></div>
					</div>
					<?php }?>
				</div>
			</div>
			<?php }?>

			<!-- Product Items in Order -->
			<div class="box-items">
				<div class="datetime"><?php echo ($order->status == 'Shopping'?'ปัจจุบัน':$order->paying_time_th)?></div>
				<div class="box">
					<?php if($order->status == "Shopping"){?>
					<b class="topic"><i class="fa fa-shopping-cart"></i>รายการสินค้าในตะกร้า <a href="store.php">เลือกสินค้าเพิ่ม</a></b>
					<?php }else{?>
					<b class="topic"><i class="fa fa-shopping-cart"></i>รายการสินค้าของคุณ</b>
					<div class="description">เราได้รับคำสั่งซื้อของคุณเรียบร้อยแล้ว และกำลังดำเนินการตรวจสอบรายการคำสั่งซื้อนี้ ทางเราจะทำการส่งข้อมูลการอัพเดททางอีเมลให้คุณทราบโดยเร็ว</div>
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

						<?php if($order->status != "Cancel"){?>
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
								<div class="summary-items-total" id="shipping_payments_val"> + <span id="shipping_payments"><?php echo number_format($order->shipping_payments,2);?></span></div>
							</div>

							<div class="summary-items summary-total">
								<div class="summary-items-detail">ยอดเงินที่ต้องชำระ : </div>
								<div class="summary-items-total"><span id="payments-display"><?php echo number_format($order->summary_payments,2);?></span> ฿.</div>
							</div>
						<?php }?>
					</div>

					<?php if(empty($user->email) && $order->status == 'Shopping'){?>
					<div class="email-required">
						<p class="caption"><i class="fa fa-envelope"></i>เราจำเป็นต้องขออีเมลของคุณ เพื่อแจ้งสถานะส่งสินค้าและหมายเลขพัสดุของสินค้า ขอบคุณค่ะ</p>
						<input type="email" id="email" class="email-input" placeholder="กรอกอีเมลของคุณ...">
					</div>
					<?php }?>

					<?php if($order->status == "Shopping"){?>
					<div class="form-control" id="paying-button">
						<div class="submit-btn" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Paying');">ชำระเงิน<i class="fa fa-angle-right"></i></div>
					</div>
					<?php }?>

					<input type="hidden" id="all-payments" value="<?php echo $order->summary_payments;?>">
				</div>
			</div>
			<?php }else{?>

			<!-- Cart is Empty -->
			<div class="box-items">
				<div class="box box-fullsize">ตะกร้าว่างเปล่า กรุณาเลือกสินค้าที่คุณต้องการก่อนนะคะ...
					<div class="control"><a href="store.php" class="btn">ดูสินค้าทั้งหมด</a></div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>

	<?php if($order->status == "Paying"){?>
	<!-- Cancel Order -->
	<div class="order-control">
		<div class="cancel-btn" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Cancel');"><i class="fa fa-times"></i>ยกเลิกการสั่งซื้อ</div>
	</div>
	<?php }?>
</div>

<?php include'template/loading.dialog.box.php';?>

<?php if($order->status == "Paying" || $order->status == "TransferAgain" || $order->status == "Expire"){?>
<!-- Loading process submit photo to uploading. -->
<div class="progress-panel" id="progress-panel">
	<div class="message">
		<div class="icon" id="progress-icon"><i class="fa fa-cloud-upload"></i></div>
		<div class="caption" id="progress-message">กำลังส่งหลักฐานการโอน...</div>
	</div>
	<div class="progress">
		<div class="progress-bar" id="progress-bar"></div>
	</div>

	<a href="profile.php" target="_parent" class="cancel"><i class="fa fa-times"></i>ยกเลิก</a>
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