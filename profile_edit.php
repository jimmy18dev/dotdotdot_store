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
		<p>แก้ไขข้อมูลส่วนตัวของคุณ</p>
	</div>
	<div class="container-page">
		<div class="order-detail">
			<div class="box-items">
				<div class="box box-fullsize">
					<div class="form">
						<p class="caption">ชื่อ - นามกลุล</p>
						<input type="text" class="input-text input-fullsize" id="name" value="<?php echo $user->name;?>" autofocus>
						
						<p class="caption">ที่อยู่ (สำหรับจัดส่งสินค้า)</p>
						<textarea id="address" class="input-text input-fullsize"><?php echo $user->address;?></textarea>

						<p class="caption">เบอร์โทรศัพท์</p>
						<input type="tel" class="input-text input-fullsize" id="phone" value="<?php echo $user->phone;?>">

						<p class="caption">อีเมล</p>
						<input type="email" class="input-text input-fullsize" id="email" value="<?php echo $user->email;?>">

						<button class="submit-btn" onclick="javascript:EditInfo();">บันทึก<i class="fa fa-angle-right"></i></button>
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