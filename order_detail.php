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
<!-- <link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/> -->

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

<h1>Order Detail of <?php echo $user->name;?> (<?php echo $order->status;?>)</h1>
<h3>Order Checking : <?php echo $order->CheckingAllAmountInOrder(array('order_id' => $order->id));?></h3>
<h5>สร้างเมื่อ <?php echo $order->create_time;?> | หมดอายุ <?php echo date('Y-m-d H:i:s', strtotime($order->create_time) + 86400);?> | ลบถาวร <?php echo date('Y-m-d H:i:s', strtotime($order->create_time) + 86400);?>,<?php echo strtotime($order->create_time);?></h5>
<?php $order->ListItemsInOrder(array('order_id' => $order->id));?>
<hr>

<?php if($order->status == 'Shopping'){?>
<p>เลือกการส่งสินค้า
<select id="shipping_type" onchange="javascript:SummaryPayments();">
  <option value="Ems">EMS (50 บาท)</option>
  <option value="Register">ลงทะเบียน (30 บาท)</option>
</select>
</p>

<hr>
<p>ยอดชำระรวม <input type="text" id="all-payments" value="<?php echo $order->summary_payments;?>"> บาท</p>

<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Cancel');">ยกเลิก</button>
<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Paying');">ชำระเงิน</button>

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