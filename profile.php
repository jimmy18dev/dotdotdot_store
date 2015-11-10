<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

if(!MEMBER_ONLINE || MEMBER_ID != $user->id){
	header("Location: login.php");
	die();
}

if(!empty($user->current_order_id)){
	$order->GetOrder(array('order_id' => $user->current_order_id));
}

// Current page
$current_page = "profile";
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

<div class="container container-fix">

	<div class="container-page">
		<div class="profile">
			<p class="big" title="ไม่รวมค่าจัดส่งสินค้า">ยอดสั่งซื้อ <strong><?php echo number_format($user->total_payment,2);?></strong> บาท</p>
			<p>คุณ <?php echo $user->name;?> เป็นสมาชิกเมื่อ <?php echo $user->create_time_facebook_format;?></p>

			<p class="link">
				<a href="profile_edit.php">แก้ไขข้อมูล</a>
				<a href="profile_change_password.php">เปลี่ยนรหัส</a>
				<a href="logout.php" class="logout">ออกจากระบบ</a>
			</p>
		</div>

		<div class="list-content">
			<?php $order->ListMyOrder(array('member_id' => MEMBER_ID));?>
		</div>
	</div>
</div>
</body>
</html>