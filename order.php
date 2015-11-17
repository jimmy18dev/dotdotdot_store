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
<script type="text/javascript" src="js/lib/jquery.autosize.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.form.min.js"></script>
<script type="text/javascript" src="js/lib/numeral.min.js"></script>
<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript" src="js/service/user.service.js"></script>
<script type="text/javascript" src="js/money.transfer.js"></script>
<script type="text/javascript" src="js/order.app.js"></script>
<script type="text/javascript" src="js/alert.app.js"></script>

</head>

<body>
<?php include'header.php';?>

<div class="container">
	<div class="container-page">
		<div class="panel-fix">
			<?php if($order->status != "Complete" && $order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>
			<div class="order-state">
				<!-- <div class="state-items <?php echo ($order->status == 'Shopping'?'state-active':'');?>">
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
					<div class="caption">ช็อป</div>
				</div> -->

				<a href="#product">
				<div class="state-items <?php echo ($order->status == 'Paying'?'state-active':'');?>">
					<div class="icon"><i class="fa fa-barcode"></i></div>
					<div class="caption">1. สั่งสินค้า</div>
				</div>
				</a>
				<a href="#transfer">
				<div class="state-items <?php echo ($order->status == 'TransferRequest' || $order->status == 'TransferAgain'?'state-active':'');?>">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="caption">2. โอนเงิน</div>
				</div>
				</a>

				<a href="#success">
				<div class="state-items <?php echo ($order->status == 'TransferSuccess'?'state-active':'');?>">
					<div class="icon"><i class="fa fa-check"></i></div>
					<div class="caption">3. ชำระเงินแล้ว</div>
				</div>
				</a>

				<a href="#shipping">
				<div class="state-items <?php echo ($order->status == 'Shipping'?'state-active':'');?>">
					<div class="icon"><i class="fa fa-truck"></i></div>
					<div class="caption">4. รอรับของ</div>
				</div>
				</a>
			</div>
			<?php }?>

			<!-- Shipping -->

				<?php if($order->status == "Shipping"){?>
				<div class="order-box">
					<div class="icon"><i class="fa fa-truck"></i></div>
					<div class="box">
						<p class="caption"><span class="time" title="<?php echo $order->shipping_time_th;?>"><?php echo $order->shipping_time_fb;?></span></p>
						<p class="big">ได้รับสินค้าแล้ว ใช่หรือไม่ ?</p>
						<p>คุณ <?php echo $user->name;?> ได้รับสินค้าแล้วใช่หรือไม่ ?</p>

						<div class="form-control">
							<button class="submit-btn" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Complete');">รับสินค้าแล้ว</button>
						</div>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "Paying" || $order->status == "TransferAgain"){?>
				<div class="order-box">
					<div class="icon"><i class="fa fa-barcode"></i></div>
					<form id="MoneyTransfer" action="money.transfer.process.php" method="post" enctype="multipart/form-data">
					<div class="box">
						<p class="caption">ส่งหลักฐานการโอนเงิน</p>
						<p class="big">ยอดชำระเงิน <?php echo number_format($order->summary_payments,2);?> บาท</p>
						<p>กรุณาชำระภายในวันที่ <?php echo $order->expire_time_thai_format;?> (<?php echo $order->expire_time_datediff;?>)</p>

						<div class="bank">
							<?php $bank->ListBank(array('mode' => 'items'));?>
						</div>

						<div class="form-items">
							<div class="label">ภาพถ่ายสลิปใบโอนเงิน</div>
							<div class="input">
								<div class="image-input">
									<span id="photo_files_div"></span>
									<span id="photo_thumbnail">
										<div class="btn">
											<p><i class="fa fa-camera"></i></p>
											<p>เลือกภาพ</p>
										</div>
									</span>
									<input type="file" class="input-file" id="photo_files" name="image_file" accept="image/*">
								</div>
							</div>
						</div>

						<div class="form-items">
							<div class="label">โอนเข้าธนาคาร: </div>
							<div class="input">
								<select name="to_bank" id="transfer_bank" class="input-text">
									<option value="0">เลือกบัญชีที่คุณโอนเข้า...</option>
									<?php $bank->ListBank(array('mode' => 'select'));?>
								</select>
							</div>
						</div>
						<div class="form-items">
							<div class="label">ยอดเงินที่โอน</div>
							<div class="input">
								<input type="text" class="input-text" name="total" id="transfer_total" placeholder="ยอดที่ต้องชำระ <?php echo number_format($order->summary_payments);?> บาท">
							</div>
						</div>

						<div class="form-items">
							<div class="label">ชื่อผุ้รับสินค้า</div>
							<div class="input">
								<input type="text" class="input-text" name="realname" id="transfer_realname" placeholder="ชื่อ-นามสกุล..." value="<?php echo $user->name;?>">
							</div>
						</div>

						<div class="form-items">
							<div class="label">ที่อยู่</div>
							<div class="input">
								<textarea name="address" class="input-text input-textarea animated" placeholder="ที่อยู่สำหรับส่งสินค้า..." id="transfer_address"><?php echo (empty($order->address)?$order->customer_address_history:$order->customer_address);?></textarea>
							</div>
						</div>

						<div class="form-items">
							<div class="label">เบอร์โทรศัพท์</div>
							<div class="input">
								<input type="text" class="input-text" id="transfer_phone" name="phone" placeholder="เบอร์โทรศัพท์..." value="<?php echo $user->phone;?>">
							</div>
						</div>

						<div class="form-items full-size">
							<div class="input">
								<textarea name="description" id="transfer_description" class="input-text input-textarea animated" placeholder="เพิ่มเติม..."><?php echo $order->description;?></textarea>
							</div>
						</div>

						<div class="form-control">
							<button class="submit-btn" type="submit"><i class="fa fa-cloud-upload"></i>ส่งหลักฐาน</button>
						</div>

						<input type="hidden" id="order_id" name="order_id" value="<?php echo $order->id?>">
					</div>
					</form>
				</div>
				<?php }?>
		</div>

		<!-- Photo -->
		<div class="panel">
			<div class="order-topic">ใบสั่งซื้อหมายเลข <?php echo $order->id;?></div>

			<div class="order-detail">
			<?php if($order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>
				<?php if($order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="order-box" id="complete">
					<div class="icon"><i class="fa fa-check"></i></div>
					<div class="box">
						<p class="caption"> <span class="time" title="<?php echo $order->complete_time_th;?>"><?php echo $order->complete_time_fb;?></span></p>
						<p class="big">เรียบร้อย</p>
						<p>การสั่งซื้อเสร็จสมบูรณ์ ขอบคุณที่ใช้บริการค่ะ</p>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "Shipping" || $order->status == "Complete"){?>

				<!-- Shipping -->
				<div class="order-box" id="shipping">
					<div class="icon"><i class="fa fa-truck"></i></div>
					<div class="box">
						<p class="caption"><span class="time" title="<?php echo $order->shipping_time_th;?>"><?php echo $order->shipping_time_fb;?></span></p>
						<p class="big"><?php echo $order->ems;?></p>
						<p>จัดส่งสินค้าเรียบร้อยแล้วค่ะ</p>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>
				<!-- Shipping -->
				<div class="order-box" id="success">
					<div class="icon"><i class="fa fa-check"></i></div>
					<div class="box">
						<p class="caption"><span class="time" title="<?php echo $order->success_time_th;?>"><?php echo $order->success_time_fb;?></span></p>
						<p class="big">ชำระเงินแล้ว</p>
						<p>ยืนยันการโอนเงินเรียบร้อย กำลังจัดส่งสินค้าค่ะ</p>
					</div>
				</div>
				<?php }?>

				<!-- Edit Name Address and Phone number of Customer -->
				<?php if($order->status == "TransferRequest" && $_GET['edit'] == "address"){?>
				<div class="order-box">
					<div class="icon"><i class="fa fa-map-pin"></i></div>
					<div class="box">
						<p class="caption">แก้ไขที่อยู่</p>
						<input type="text" class="input-text" id="customer_name" value="<?php echo $order->customer_name;?>">
						<textarea class="input-text input-textarea" id="customer_address"><?php echo $order->customer_address;?></textarea>
						<input type="text" class="input-text" id="customer_phone" value="<?php echo $order->customer_phone;?>">

						<div class="form-control">
							<button class="submit-btn" onclick="javascript:EditAddress(<?php echo $order->id?>);">บันทึก</button>
						</div>
					</div>
				</div>
				<?php }?>

				<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>


				<?php if($_GET['edit'] != "address"){?>
				<!-- Address -->
				<div class="order-box" id="address">
					<div class="icon"><i class="fa fa-map-pin"></i></div>
					<div class="box">
						<p class="caption">ที่อยู่ลูกค้า · <span class="time" title="<?php echo $order->confirm_time_th;?>"><?php echo $order->confirm_time_fb;?></span></p>
						<p class="big">คุณ <?php echo $order->customer_name;?></p>
						<p><?php echo $order->customer_address;?></p>
						<p><?php echo $order->customer_phone?></p>
						<p class="edit"><a href="order-<?php echo $order->id;?>.html?edit=address">แก้ไขที่อยู่</a></p>
					</div>
				</div>
				<?php }?>

				<!-- Money transfer info -->
				<div class="order-box" id="transfer">
					<div class="icon"><i class="fa fa-file-text"></i></div>
					<div class="box">
						<p class="caption">หลักฐานการโอนเงิน · <span class="time" title="<?php echo $order->confirm_time_th;?>"><?php echo $order->confirm_time_fb;?></span></p>
						<p class="big">ยอดโอน <span class="highlight"><?php echo number_format($order->m_total,2);?></span> บาท</p>
						<p>โอนเงินเข้า: <strong><?php echo $bank->BankName($order->m_bank_code);?></strong> <?php echo $order->m_bank_number;?></p>

						<?php if(!empty($order->m_message)){?>
						<p class="message">"<?php echo $order->m_message;?>"</p>
						<?php }?>

						<?php if(!empty($order->m_photo)){?>
						<div class="image">
							<img src="../image/upload/normal/<?php echo $order->m_photo;?>" alt="">
						</div>
						<?php }?>

						<p class="edit"><span onclick="javascript:CencelTransfer(<?php echo $order->id;?>);">ยกเลิก</span></p>
					</div>
				</div>
				<?php }?>

				<div class="order-box" id="product">
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
					<div class="box">
						<p class="caption">รายการสินค้า · <span class="time" title="<?php echo $order->paying_time_th;?>"><?php echo $order->paying_time_fb;?></span></p>

						<?php if($order->status != "Shopping"){?>
						<p class="big">ยอดเงินที่ต้องชำระ <span class="highlight"><?php echo number_format($order->summary_payments,2);?></span> บาท</p>
						<?php }?>

						<!-- Order list -->
						<div class="order-list">
							<div class="topic-caption">
								<div class="detail">สินค้า <?php echo $order->total;?> รายการ</div>
								<div class="quantity">จำนวน(ชิ้น)</div>
								<div class="total">รวม(บาท)</div>
							</div>

							<?php
							$order->ListItemsInOrder(array(
								'order_id' 		=> $order->id,
								'order_status' 	=> $order->status,
							));
							?>

							<?php if($order->total > 1){?>
							<div class="summary-items product-total">
								<div class="detail">รวมราคาสินค้า: </div>
								<div class="total"><span id="subpayments-display"><?php echo number_format($order->payments,2);?></span></div>
							</div>
							<?php }?>

							<div class="summary-items">
								<div class="detail">
									ค่าบริการส่ง: 
									<?php if($order->status == "Shopping"){?>
									<select id="shipping_type" class="shipping-select" onchange="javascript:SummaryPayments();">
										<option value="Ems">EMS</option>
										<option value="Register">ลงทะเบียน</option>
									</select>
									<?php }else{
										echo $order->shipping_type;
									}?>
								</div>
								<div class="total"><span id="shipping_payments"><?php echo number_format($order->shipping_payments,2);?></span></div>
							</div>

							<div class="summary-items summary-total">
								<div class="detail">ยอดเงินที่ต้องชำระ:</div>
								<div class="total"><span id="payments-display"><?php echo number_format($order->summary_payments,2);?></span></div>
							</div>
						</div>

						<?php if($order->status == "Shopping"){?>
						<div class="form-control" id="paying-button">
							<div class="submit-btn" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Paying');"><i class="fa fa-check"></i>ชำระเงิน</div>
						</div>
						<?php }?>

						<input type="hidden" id="all-payments" value="<?php echo $order->summary_payments;?>">
					</div>
				</div>
				<?php }else{?>
				<div class="order-box">
					<div class="icon"><i class="fa fa-map-pin"></i></div>
					<div class="box">
						<p class="caption">ตะกร้าสินค้าของคุณ</p>
						<p class="big">ไม่พบสินค้า!</p>
						<p>กรุณาเลือกสินค้าที่คุณต้องการก่อนนะค่ะ...</p>
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

<div class="dialog-box" id="dialog-box">
	<div class="icon" id="dialog-box-icon"><i class="fa fa-circle-o-notch fa-spin"></i></div>
</div>

<?php if($order->status == "Paying" || $order->status == "TransferAgain"){?>
<!-- Loading process submit photo to uploading. -->
<div id="filter">
	<div id="loading-message">กำลังส่งภาพ</div>
	<div id="loading-bar"></div>
	<div class="cancel"><a href="me.php" target="_parent">ยกเลิก</a></div>
</div>

<script type="text/javascript" src="js/image.thumbnail.js"></script>
<?php }?>

</body>
</html>