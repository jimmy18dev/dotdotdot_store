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
		<h1><?php echo $user->name;?></h1>
		<p><a href="profile_edit.php#start">แก้ไขข้อมูลส่วนตัว</a> | เปลี่ยนรหัสผ่าน</p>
	</div>
	<div class="container-page">
		<div class="order-detail">
			<div class="box-items">
				<div class="icon"><i class="fa fa-lock"></i></div>
				<div class="box">
					<p class="big">ตั้งหรัสผ่านใหม่</p>
					<p>คำแนะนำ</p>
					<p>1. รหัสผ่านควรมีความมากกว่า 6 ตัวอักษรขึ้น</p>
					<p>2. ไม่ควรใช้คำที่เดาง่ายเช่น 123456 password 000000</p>
					<p>ปล. หากมีข้อสงสัยในการใช้งานเว็บ กรุณาติดต่อ 080XXXXXXX หรือ email@gmail.com</p>

					<div class="form">
						<p class="caption">ตั้งหรัสผ่านใหม่</p>
						<input type="password" id="password" class="input-text" placeholder="ไม่น้อยกว่า 6 ตัวอักษร..." autofocus>
						<button class="submit-btn" onclick="javascript:ChangePassword();"><i class="fa fa-floppy-o"></i>บันทึก</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include'template/loading.dialog.box.php';?>

<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/min/init.min.js"></script>
<script type="text/javascript" src="js/service/min/user.service.min.js"></script>
</body>
</html>