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

<?php include'favicon.php';?>

<title><?php echo $user->name;?></title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

</head>

<body>
<?php include'header.php';?>

<div class="container container-fix">
	<div class="container-page">
		<div class="head-bar">
			<div class="icon"><i class="fa fa-user"></i></div>
			<div class="caption">คุณ <?php echo $user->name;?></div>
		</div>
		<div class="panel-fix">
			<div class="box">
				<div class="message">
					<p><i class="fa fa-file-text-o"></i></p>
					<p class="msg">รายการสั่งซื้อของคุณ</p>
				</div>

				<p class="link">
					<a href="profile_edit.php">แก้ไขข้อมูล</a>
					<a href="profile_change_password.php">เปลี่ยนรหัส</a>
					<a href="logout.php" class="signout">ออกจากระบบ</a>
				</p>
			</div>
		</div>

		<!-- Photo -->
		<div class="panel">
			<?php $order->ListMyOrder(array('member_id' => MEMBER_ID));?>
		</div>
	</div>
</div>
</body>
</html>