<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

if(!empty($user->current_order_id)){
	$order->GetOrder(array('order_id' => $user->current_order_id));
}
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

<title><?php echo $user->name;?></title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>

</head>

<body>
<?php include'header.php';?>

<div class="content">
	<!-- Profile -->
	<div class="profile">
		<div class="avatar">
			<?php if(empty($user->facebook_id)){?>
			<img src="image/avatar.png" alt="">
			<?php }else{?>
			<img src="https://graph.facebook.com/<?php echo $user->facebook_id;?>/picture?type=square" alt="">
			<?php }?>
		</div>
		<div class="name"><?php echo $user->name;?></div>
		<div class="info">เป็นสมาชิกเมื่อ <?php echo $user->create_time_facebook_format;?></div>
		<div class="info"><a href="logout.php" class="logout">ออกจากระบบ</a></div>
	</div>

	<div class="container">
		<div class="list">
			<div class="order-box order-list">
				<div class="topic-caption">
					<div class="title">รายการสั่งซื้อ</div>
					<div class="pay">รวม</div>
					<div class="quantity">จำนวน</div>
				</div>

				<?php $order->ListMyOrder(array('member_id' => MEMBER_ID));?>
			</div>
		</div>
	</div>
</div>
</body>
</html>