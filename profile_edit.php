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
		<p>ข้อมูลส่วนตัว 
			<a href="profile_change_password.php#start">เปลี่ยนรหัส</a>
		</p>
	</div>
	<div class="container-page">
		<div class="order-detail">
			<div class="box-items">
				<div class="icon"><i class="fa fa-user"></i></div>
				<div class="box">
					<p class="big">แก้ไขข้อมูลส่วนตัว</p>
					<p>คำแนะนำ</p>
					<p>1. เราแนะนำให้คุณใส่ชื่อที่ตรงกับบัตรประชาชน เพื่อระบุชื่อผู้รับสินค้าได้อย่างถูกต้อง</p>
					<p>2. เบอร์ติดต่อ เราขอให้ท่านใส่เบอร์มือถือหรือเบอร์ส่วนตัวที่ติดต่อได้</p>
					<p>3. เราแนะนำให้ท่านใช้อีเมลของ Gmail เพื่อความสะดวกในการใช้งาน</p>
					<p>4. ใส่ข้อมูลตามความเป็นจริง ช่วยให้การสั่งซื้อสินค้าเป็นไปด้วยความเรียบร้อย</p>
					<p>ปล. หากมีข้อสงสัยในการใช้งานเว็บ กรุณาติดต่อ 080XXXXXXX หรือ email@gmail.com</p>

					<div class="form">
						<p class="caption">ชื่อ - นามกลุล</p>
						<input type="text" class="input-text" id="name" value="<?php echo $user->name;?>" autofocus>
						<p class="caption">เบอร์โทรศัพท์</p>
						<input type="text" class="input-text" id="phone" value="<?php echo $user->phone;?>">
						<p class="caption">อีเมล</p>
						<input type="text" class="input-text" disabled id="email" value="<?php echo $user->email;?>">

						<button class="submit-btn" onclick="javascript:EditInfo();"><i class="fa fa-floppy-o"></i>บันทึก</button>
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