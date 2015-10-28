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
<script type="text/javascript" src="js/service/order.service.js"></script>

</head>

<body>
<?php include'header.php';?>

<div class="container">
	<div class="topic">
		<div class="topic-caption">ใบสั่งซื้อ <?php echo $order-id;?></div>
	</div>

	<div class="content">
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

		<!-- Complete -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-check"></i></div>
			<div class="box">
				<p class="caption">สถานะ</p>
				<p class="big">เรียบร้อย</p>
				<p>ลูกค้าได้รับสินค้าแล้ว</p>
			</div>
		</div>

		<!-- Shipping form -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-commenting"></i></div>
			<div class="box">
				<p class="caption">แจ้งหมายเลขพัสดุ</p>
				<input type="text" class="input-text" id="ems" placeholder="หมายเลขพัสดุ...">

				<div class="control">
					<button class="button success" onclick="javascript:EmsUpdate(<?php echo $order->id;?>);"><i class="fa fa-check"></i>บันทึก</button>
				</div>
			</div>
		</div>

		<!-- Shipping -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-truck"></i></div>
			<div class="box">
				<p class="caption">จัดส่งสินค้า</p>
				<p class="big">ERD4538757</p>
				<p>จัดส่งสินค้าแบบ EMS</p>
			</div>
		</div>

		<!-- Money transfer checking -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-commenting"></i></div>
			<div class="box">
				<p class="caption">ตรวจสอบหลักฐานการโอนเงิน</p>

				<div class="control">
					<button class="button success" onclick="javascript:OrderProcess(<?php echo $order->id;?>,'TransferSuccess');"><i class="fa fa-check"></i>ถูกต้อง</button>
					<button class="button" onclick="javascript:OrderProcess(<?php echo $order->id;?>,'TransferAgain');"><i class="fa fa-times"></i>ไม่ถูกต้อง</button>
				</div>
			</div>
		</div>

		<!-- Address -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-map-pin"></i></div>
			<div class="box">
				<p class="caption">ที่อยู่ลูกค้า</p>
				<p class="big">ภูวดล ศรีเจริญ</p>
				<p>5 ม.1 ต.โนนห้อม อ.เมือง จ.ปราจีนบุรี 25000</p>
				<p>0801051930</p>
			</div>
		</div>

		<!-- Transfer confirm -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-file-text"></i></div>
			<div class="box">
				<p class="caption">หลักฐานการโอนเงิน</p>
				<p class="big">ยอดโอน 3454.00 บาท</p>
				<p>โอนเข้าธานาคาร กรุงไทย 3325635763</p>
				<div class="image">
					<img src="http://dotdotdot.local/image/upload/thumbnail/41fd3fa8e4b380449b766fec67f6ac74.jpg" alt="">
				</div>
				<p class="message">"ขออภัยด้วยครับ ผมชำระเงินช้าไป 2 วัน"</p>
			</div>
		</div>

		<!-- Order list -->
		<div class="order-list">
			<div class="topic-caption">
				<div class="detail">รายการสินค้า</div>
				<div class="quantity">จำนวน</div>
				<div class="total">รวม</div>
			</div>

			<?php
			$order->ListItemsInOrder(array(
				'order_id' 		=> $order->id,
				'order_status' 	=> $order->status,
			));
			?>

			<div class="summary-items">
				<div class="detail">ค่าบริการส่ง : Ems</div>
				<div class="total">50.00 ฿</div>
			</div>
			<div class="summary-items summary-total">
				<div class="detail">ยอดเงินที่ต้องชำระ :</div>
				<div class="total">85.00 ฿</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>