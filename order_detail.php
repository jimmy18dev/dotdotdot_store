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
			<div class="topic-caption">หมายเลขการสั่งซื้อ <?php echo $order->id;?></div>
			<div class="filter"></div>
		</div>

		<div class="list">
			<?php $order->ListItemsInOrder(array('order_id' => $order->id));?>

			<div class="total-items">
				<div class="caption">ค่าจัดส่งสินค้าแบบ <select id="shipping_type" onchange="javascript:SummaryPayments();">
  <option value="Ems">EMS (50 บาท)</option>
  <option value="Register">ลงทะเบียน (30 บาท)</option>
</select></div>
				<div class="value">50</div>
			</div>

			<div class="total-items total-payments">
				<div class="caption">ยอดเงินที่ต้องชำระ</div>
				<div class="value"><?php echo $order->summary_payments;?></div>

				<input type="hidden" id="all-payments" value="<?php echo $order->summary_payments;?>">
			</div>

			<div class="payments-submit">
				<div class="button">ชำระเงิน</div>
				<div class="button cancel">ยกเลิก</div>
			</div>
		</div>
	</div>
</div>

<?php if($order->status == 'Shopping'){?>
<?php }else if($order->status == 'Paying' || $order->status == 'TransferAgain'){?>
<p>ค่าสินค้าทั้งหมด <?php echo $order->payments;?> บาท</p>
<p>ค่าจัดส่งสินค้า(<?php echo $order->shipping_type;?>) <?php echo $order->shipping_payments;?> บาท</p>
<p>ยอดเงินที่ต้องชำระ <?php echo $order->summary_payments;?> บาท</p>
<hr>
<form id="MoneyTransfer" action="money.transfer.process.php" method="post" enctype="multipart/form-data">
	<p>ภาพสลิปโอนเงิน</p>
	<input type="file" class="input-file" id="post_files" name="image_file" accept="image/*"><br>

	<p>Order ID</p>
	<input type="text" name="order_id" value="<?php echo $order->id?>">
	
	<h4>ยืนยันการโอนเงิน</h4>
	<?php $bank->ListBank(array('null' => 0));?>
	<br>
	<p>จำนวนเงินที่โอน</p>
	<input type="text" name="total" placeholder="จำนวนเงินที่โอนเข้า" value="0">
	<p>หมายเหตุเพิ่มเติม</p>
	<textarea name="description" cols="60" rows="10" placeholder="เพิ่มเติม"></textarea>

	<p>ที่อยู่สำหรับส่งของ</p>
	<?php echo $address->ListAddress(array('member_id' => MEMBER_ID));?>
	<a href="address_editor.php?order=<?php echo $order->id;?>">ที่อยู่ใหม่</a>

	<br><br>
	<button type="submit">ยืนยันการโอนเงิน</button>
</form>
<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Cancel');">ยกเลิกการสั่งซื้อ</button>
<?php }else if($order->status == "Shipping"){?>
<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Complete');">ได้รับสินค้าแล้ว</button>
<?php }?>
</body>
</html>