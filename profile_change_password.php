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
		<h1 class="name"><?php echo $user->name;?></h1>
		<p>เปลี่ยนรหัสผ่านของคุณ</p>

		<div class="info-items info-items-btn">
			<div class="cotent content-margin-left">
				<a class="btn btn-active" href="profile_change_password.php#start"><i class="fa fa-key"></i>เปลี่ยนรหัสผ่าน</a>
				<a class="btn" href="profile_edit.php#start"><i class="fa fa-cog"></i>แก้ไขข้อมูลส่วนตัว</a>
			</div>
		</div>
	</div>
	<div class="container-page">
		<div class="order-detail">
			<div class="box-items">
				<div class="box box-fullsize">
					<i class="fa fa-child"></i> <strong>คำแนะนำ</strong> รหัสผ่านควรมีความยาวมากกว่า 6 ตัวอักษรและคุรไม่ควรใช้คำที่เดาได้ง่าย เช่น 123456 password 000000

					<div class="form">
						<p class="caption">ตั้งหรัสผ่านใหม่</p>
						<input type="password" id="password" class="input-text" placeholder="ไม่น้อยกว่า 6 ตัวอักษร..." autofocus>
						<button class="submit-btn" onclick="javascript:ChangePassword();">บันทึก<i class="fa fa-angle-right"></i></button>
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