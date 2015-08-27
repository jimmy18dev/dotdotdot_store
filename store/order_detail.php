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
<script type="text/javascript" src="js/service/order.service.js"></script>

</head>

<body>
<?php include'header.php';?>

<h1>Order Detail (<?php echo $order->status;?>)</h1>
<?php $order->ListItemsInOrder(array('order_id' => $order->id));?>
<hr>

<?php if($order->status == 'TransferSuccess'){?>
<div>
	<p>EMS <input type="text" id="ems" placeholder="เลข ems"></p>
</div>
<?php }?>

<div>

	<?php if($order->status == 'TransferRequest'){?>
	<button onclick="javascript:OrderProcess(<?php echo $order->id;?>,'TransferAgain');">ยืนยันการโอนเงินไม่สำเร็จ</button>
	<button onclick="javascript:OrderProcess(<?php echo $order->id;?>,'TransferSuccess');">ยืนยันการโอนเงินสำเร็จ</button>
	<?php }?>

	<?php if($order->status == 'TransferSuccess'){?>
	<button onclick="javascript:EmsUpdate(<?php echo $order->id;?>);">ส่งสินค้าเรียบร้อยแล้ว</button>
	<?php }?>
</div>
</body>
</html>