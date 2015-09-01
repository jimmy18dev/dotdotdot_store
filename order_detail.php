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
<script type="text/javascript" src="js/money.transfer.js"></script>

</head>

<body>
<?php include'header.php';?>

<h1>Order Detail of <?php echo $user->name;?> (<?php echo $order->status;?>)</h1>
<?php $order->ListItemsInOrder(array('order_id' => $order->id));?>
<hr>

<?php if($order->status == 'shopping'){?>
<p>เลือกการส่งสินค้า
<select id="shipping_type">
  <option value="Ems">EMS (50 บาท)</option>
  <option value="Register">ลงทะเบียน (30 บาท)</option>
</select>
</p>

<hr>
<p>ยอดชำระรวม <?php echo $order->payments;?> บาท</p>
<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Cancel');">ยกเลิก</button>
<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Paying');">ชำระเงิน</button>
<?php }else if($order->status == 'Paying' || $order->status == 'TransferAgain'){?>
<form id="MoneyTransfer" action="money.transfer.process.php" method="post" enctype="multipart/form-data">
	<input type="file" class="input-file" id="post_files" name="image_file" accept="image/*"><br>

	<input type="text" name="order_id" value="<?php echo $order->id?>">
	<h4>ยืนยันการโอนเงิน</h4>
	<?php $bank->ListBank(array('null' => 0));?>
	<br>
	<p>จำนวนเงินที่โอน</p>
	<input type="text" name="total" placeholder="จำนวนเงินที่โอนเข้า" value="0">
	<p>หมายเหตุเพิ่มเติม</p>
	<textarea name="description" cols="60" rows="10" placeholder="เพิ่มเติม"></textarea>

	<p>ที่อยู่สำหรับส่งของ</p>
	<textarea name="address" cols="60" rows="10" placeholder="ที่อยู่"></textarea>

	<br><br>
	<button type="submit">ยืนยันการโอนเงิน</button>
</form>
<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Cancel');">ยกเลิกการสั่งซื้อ</button>
<?php }else if($order->status == "Shipping"){?>
<button onclick="javascript:OrderProcess(<?php echo $order->id?>,'Complete');">ได้รับสินค้าแล้ว</button>
<?php }?>
</body>
</html>