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
	<div class="head-bar" id="start">
		<h1 class="name"><?php echo $user->name;?></h1>
		<p>รายการสั่งซื้อสุดท้ายของฉัน</p>

		<?php if(false){?>
		<div class="info-items">
			<div class="icon"><i class="fa fa-home"></i></div>
			<div class="content"><?php if(empty($user->address)){?><a href="profile_edit.php#start">เพิ่มที่อยู่</a><?}else{echo $user->address;}?></div>
		</div>
		<div class="info-items">
			<div class="icon"><i class="fa fa-phone"></i></div>
			<div class="content"><?php if(empty($user->phone)){?><a href="profile_edit.php#start">เพิ่มเบอร์โทรศัพท์</a><?}else{echo $user->phone;}?></div>
		</div>
		<div class="info-items">
			<div class="icon"><i class="fa fa-envelope"></i></div>
			<div class="content"><?php if(empty($user->email)){?><a href="profile_edit.php#start">เพิ่มอีเมล</a><?}else{echo $user->email;}?></div>
		</div>
		<div class="info-items">
			<div class="icon"><i class="fa fa-clock-o"></i></div>
			<div class="content">สมัครสมาชิกเมื่อ <?php echo $user->create_time_thai_format;?></div>
		</div>
		<?php }?>
		
	</div>
	<div class="container-page">
		<?php $order->ListMyOrder(array('member_id' => MEMBER_ID));?>
	</div>

	<div class="info-items info-items-btn">
			<div class="cotent">
				<div class="profile-control">
					<a class="btn btn-logout" href="logout.php">Logout</a>
					<a class="btn" href="profile_change_password.php#start">เปลี่ยนรหัสผ่าน</a>
					<a class="btn" href="profile_edit.php#start">แก้ไขข้อมูล</a>
				</div>
			</div>
		</div>
</div>
</body>

<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/min/init.min.js"></script>
</html>