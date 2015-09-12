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

<title>Order Detail</title>

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
		<div class="topic">
			<div class="topic-caption"><i class="fa fa-file-text-o"></i>รายการสั่งซื้อ #<?php echo $order->id;?></div>
			<div class="filter"></div>
		</div>

		<div class="order-state">
			<div class="state-items">
				<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				<div class="caption">ช็อป</div>
			</div>
			<div class="state-items">
				<div class="icon"><i class="fa fa-barcode"></i></div>
				<div class="caption">ชำระเงิน</div>
			</div>
			<div class="state-items">
				<div class="icon"><i class="fa fa-money"></i></div>
				<div class="caption">โอนเงิน</div>
			</div>
			<div class="state-items">
				<div class="icon"><i class="fa fa-truck"></i></div>
				<div class="caption">จัดส่ง</div>
			</div>
			<div class="state-items">
				<div class="icon"><i class="fa fa-check"></i></div>
				<div class="caption">รับของ</div>
			</div>
		</div>

		<div class="list">

			<div class="money-transfer-form">
				<div class="topic">ยืนยันการโอนเงิน รายการสั่งซื้อที่ <?php echo $order->id;?></div>
				<form id="MoneyTransfer" action="money.transfer.process.php" method="post" enctype="multipart/form-data">
				<div class="form">
					<div class="form-items">
						<div class="label">
							ภาพถ่ายสลิปใบโอนเงิน
						</div>
						<div class="input">
							<input type="file" class="input-file" id="post_files" name="image_file" accept="image/*">
						</div>
					</div>

					<div class="form-items">
						<div class="label">
							ยอดเงินที่โอน
						</div>
						<div class="input">
							<input type="text" name="total" placeholder="จำนวนเงินที่โอนเข้า" value="0">
						</div>
					</div>

					<div class="form-items">
						<div class="label">
							หมายเหตุเพิ่มเติม
						</div>
						<div class="input">
							<textarea name="description" cols="60" rows="10" placeholder="เพิ่มเติม"></textarea>
						</div>
					</div>

					<div class="form-items">
						<div class="label">โอนเข้าธนาคาร</div>
						<div class="input">
							<?php $bank->ListBank(array('null' => 0));?>
						</div>
					</div>

					<div class="form-items">
						<div class="label">ที่อยู่สำหรับส่งสินค้า</div>
						<div class="input">
							<?php echo $address->ListAddress(array('member_id' => MEMBER_ID));?>
							<a href="address_editor.php?order=<?php echo $order->id;?>">ที่อยู่ใหม่</a>
						</div>
					</div>

					<div class="form-submit">
						<button class="submit-button" type="submit">ยืนยันการโอนเงิน</button>
					</div>

					<input type="hidden" name="order_id" value="<?php echo $order->id?>">
				</div>
				</form>
			</div>


			<?php $order->ListItemsInOrder(array('order_id' => $order->id));?>

			<div class="items-payments subtotal">
				<div class="detail"><i class="fa fa-clone"></i>ราคาสินค้ารวม : </div>
				<div class="value">
					<?php echo number_format($order->payments);?>
				</div>
			</div>

			<div class="items-payments">
				<div class="detail">
					<i class="fa fa-truck"></i>ค่าบิรการส่งสินค้า : 
					
					<select id="shipping_type" class="shipping-select" onchange="javascript:SummaryPayments();">
						<option value="Ems">EMS (50 บาท)</option>
						<option value="Register">ลงทะเบียน (30 บาท)</option>
					</select>
				</div>
				<div class="value">
					<?php echo $order->shipping_payments;?>
				</div>
			</div>

			<div class="items-payments total-payments">
				<div class="detail"><i class="fa fa-barcode"></i>ยอดเงินที่ต้องชำระ : </div>
				<div class="value">
					<?php echo number_format($order->summary_payments);?>
				</div>
			</div>

			<input type="hidden" id="all-payments" value="<?php echo $order->summary_payments;?>">

			<div class="payments-submit">
				<div class="button" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Paying');">ชำระเงิน</div>
				<div class="button cancel" onclick="javascript:OrderProcess(<?php echo $order->id?>,'Cancel');">ยกเลิก</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>