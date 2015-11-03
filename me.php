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

<div class="container">

	<div class="container-page">
		<div class="profile">
			<div class="profile-avatar">
				<?php if(empty($user->facebook_id)){?>
				<img src="image/avatar.png" alt="">
				<?php }else{?>
				<img src="https://graph.facebook.com/<?php echo $user->facebook_id;?>/picture?type=square" alt="">
				<?php }?>
			</div>
			<div class="profile-info">
				<p class="big">คุณ <?php echo $user->name;?></p>
				<p class="link"><a href="profile-edit.php"><i class="fa fa-sign-out"></i>แก้ไขข้อมูลส่วนตัว</a> | <a href="logout.php" class="logout"><i class="fa fa-sign-out"></i>ออกจากระบบ</a></p>
				<p>เบอร์ติดต่อ: <?php echo $user->phone;?></p>
				<p>Email: <?php echo $user->email;?></p>
				<p>เป็นสมาชิกเมื่อ <?php echo $user->create_time_facebook_format;?></p>
			</div>	
		</div>

		<div class="list-content">
			<?php $order->ListMyOrder(array('member_id' => MEMBER_ID));?>
		</div>
	</div>
</div>
</body>
</html>