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
		<div class="topic-caption">ใบสั่งซื้อที่ <?php echo $order->id;?></div>
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

		<?php if($order->status == "Complete"){?>
		<!-- Complete -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-check"></i></div>
			<div class="box">
				<p class="caption"><?php echo $order->complete_time_fb;?></p>
				<p class="big">เรียบร้อย</p>
				<p>ลูกค้าได้รับสินค้าแล้ว</p>
			</div>
		</div>
		<?php }?>

		<?php if($order->status == "Shipping" || $order->status == "Complete"){?>
		<!-- Shipping -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-truck"></i></div>
			<div class="box">
				<p class="caption">จัดส่งสินค้า · <?php echo $order->shipping_time_fb;?></p>
				<p class="big"><?php echo $order->ems;?></p>
				<p>จัดส่งสินค้าแบบ <?php echo ($order->shipping_type=="ems"?"EMS":"ลงทะเบียน");?></p>
			</div>
		</div>
		<?php }?>

		<?php if($order->status == "TransferSuccess"){?>
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
		<?php }?>

		<?php if($order->status == "TransferRequest"){?>
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
		<?php }?>

		<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>
		<!-- Address -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-map-pin"></i></div>
			<div class="box">
				<p class="caption">ที่อยู่ลูกค้า</p>
				<p class="big"><?php echo $order->customer_name;?></p>
				<p><?php echo $order->customer_address;?></p>
				<p><?php echo $order->customer_phone?></p>
			</div>
		</div>

		<!-- Transfer confirm -->
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-file-text"></i></div>
			<div class="box">
				<p class="caption">หลักฐานการโอนเงิน · <?php echo $order->confirm_time_fb;?></p>
				<p class="big">ยอดโอน <?php echo number_format($order->m_total,2);?> บาท</p>
				<p>โอนเข้าธานาคาร <?php echo $order->m_bank_name;?> <?php echo $order->m_bank_number;?></p>
				<div class="image">
					<img src="../image/upload/thumbnail/<?php echo $order->m_photo;?>" alt="">
				</div>
				<p class="message">"<?php echo $order->m_message;?>"</p>
			</div>
		</div>
		<?php }?>

		<?php if($order->status != "Shopping"){?>
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-shopping-cart"></i></div>
			<div class="box">
				<p class="caption">รายการสินค้า · <?php echo $order->paying_time_fb;?></p>

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

					<div class="summary-items">
						<div class="detail">ค่าบริการส่ง : <?php echo ($order->shipping_type=="ems"?"EMS":"ลงทะเบียน");?></div>
						<div class="total"><?php echo number_format($order->shipping_payments,2);?> ฿</div>
					</div>
					<div class="summary-items summary-total">
						<div class="detail">ยอดเงินที่ต้องชำระ :</div>
						<div class="total"><?php echo number_format($order->summary_payments,2);?> ฿</div>
					</div>
				</div>
			</div>
		</div>
		<?php }else{?>
		<div class="order-dialog">
			<div class="icon"><i class="fa fa-shopping-cart"></i></div>
			<div class="box">
				<p class="caption">ใบสั่งซื้อที่ <?php echo $order->id;?></p>
				<p class="big">กำลังเลือกสินค้า...</p>
			</div>
		</div>
		<?php }?>
	</div>
</div>
</body>
</html>