<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "order_detail";

$order->GetOrder(array('order_id' => $_GET['id']));
// Update admin read
if(!empty($order->id)){$order->AdminReadOrder(array('order_id' => $order->id));}
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
	<div class="content content-container">
		<?php if($order->status == "Cancel" || $order->status == "Expire" || $order->status == "Complete"){?>
		<div class="order-status-bar <?php echo strtolower($order->status);?>">
			<?php if($order->status == "Cancel"){?>
			<i class="fa fa-exclamation-triangle"></i>ยกเลิกการสั่งซื้อ
			<?php }else if($order->status == "Expire" || true){?>
			<i class="fa fa-clock-o"></i>เกินเวลาชำระเงิน
			<?php }else if($order->status == "Complete"){?>
			<i class="fa fa-check-circle"></i>เสร็จสมบูรณ์
			<?php }?>
		</div>
		<?php }?>

		<?php if($order->status != "Complete" && $order->status != "Cancel" && $order->status != "Expire" && $order->CountItemInOrder(array('order_id' => $order->id)) > 0){?>
		<div class="order-state">
			<a href="#product-list">
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

		<?php if($order->status == "Complete"){?>
		<!-- Complete -->
		<div class="order-dialog">
			<h2><i class="fa fa-check"></i><?php echo $order->complete_time_fb;?></h2>
			<p class="big"><span class="highlight">ส่งสินค้าเรียบร้อยแล้ว</span></p>
			<p>ลูกค้าได้รับสินค้าแล้ว</p>
		</div>
		<?php }?>

		<?php if($order->status == "Shipping" || $order->status == "Complete"){?>
		<!-- Shipping -->
		<div class="order-dialog">
			<h2><i class="fa fa-truck"></i>จัดส่งสินค้า · <?php echo $order->shipping_time_fb;?></h2>
			<p class="big"><?php echo $order->ems;?></p>
			<p>จัดส่งสินค้า: <?php echo ($order->shipping_type=="ems"?"EMS":"ลงทะเบียน");?></p>
		</div>
		<?php }?>

		<?php if($order->status == "TransferSuccess"){?>
		<!-- Shipping form -->
		<div class="order-dialog">
			<h2><i class="fa fa-commenting"></i>แจ้งหมายเลขพัสดุ</h2>
			<input type="text" class="input-text" id="ems" placeholder="หมายเลขพัสดุ...">
			<div class="control">
				<button class="button success" onclick="javascript:EmsUpdate(<?php echo $order->id;?>);">บันทึก</button>
			</div>
		</div>
		<?php }?>

		<?php if($order->status == "TransferRequest"){?>
		<!-- Money transfer checking -->
		<div class="order-dialog">
			<h2><i class="fa fa-commenting"></i>ตรวจสอบหลักฐานการโอนเงิน</h2>
			<p>หลักฐานการโอนเงินของคุณ <?php echo $order->customer_name;?> ถูกต้องหรือไม่ ?</p>
			<div class="control">
				<button class="button" onclick="javascript:OrderProcess(<?php echo $order->id;?>,'TransferSuccess');"><i class="fa fa-check"></i>ถูกต้อง</button>
				<button class="button fail-btn" onclick="javascript:OrderProcess(<?php echo $order->id;?>,'TransferAgain');"><i class="fa fa-times"></i>ไม่ถูกต้อง</button>
			</div>
		</div>
		<?php }?>

		<?php if($order->status == "TransferRequest" || $order->status == "TransferSuccess" || $order->status == "Shipping" || $order->status == "Complete"){?>
		<!-- Address -->
		<div class="order-dialog">
			<h2><i class="fa fa-map-pin"></i>ที่อยู่ลูกค้า</h2>
			<p class="big">คุณ <?php echo $order->customer_name;?></p>
			<p><?php echo $order->customer_address;?></p>
			<p>โทรศัพท์: <?php echo $order->customer_phone?></p>
		</div>

		<!-- Transfer confirm -->
		<div class="order-dialog">
			<h2><i class="fa fa-file-text"></i>หลักฐานการโอนเงิน · <?php echo $order->confirm_time_fb;?></h2>
			<p class="big">ยอดโอน <?php echo number_format($order->m_total);?> บาท</p>
			<p>โอนเงินเข้า <strong><?php echo $order->m_bank_name;?></strong> <?php echo $order->m_bank_number;?></p>

			<?php if(!empty($order->m_message)){?>
			<p class="message">"<?php echo $order->m_message;?>"</p>
			<?php }?>

			<?php if(!empty($order->m_photo)){?>
			<div class="image">
				<img src="../image/upload/normal/<?php echo $order->m_photo;?>" alt="">
			</div>
			<?php }?>
		</div>
		<?php }?>

		<?php if($order->status != "Shopping"){?>
		<div class="order-dialog">
			<h2><i class="fa fa-shopping-cart"></i>รายการสินค้า · <?php echo $order->paying_time_fb;?></h2>
			
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
					<div class="total"><?php echo number_format($order->shipping_payments);?> <span class="currency">บาท</span></div>
				</div>
				<div class="summary-items summary-total">
					<div class="detail">ยอดเงินที่ต้องชำระ :</div>
					<div class="total"><?php echo number_format($order->summary_payments);?> <span class="currency">บาท</span></div>
				</div>
			</div>
		</div>

		<?php }else{?>
		<div class="order-dialog">
			<h2><i class="fa fa-shopping-cart"></i>ใบสั่งซื้อที่ <?php echo $order->id;?></h2>
			<p class="big">กำลังเลือกสินค้า...</p>
		</div>
		<?php }?>
	</div>
</div>

<div id="alert">
	<div class="alert-message" id="alert-message"><i class="fa fa-circle-o-notch fa-spin"></i>รอสักครู่ ...</div>
</div>
</body>
</html>