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
<script type="text/javascript" src="js/service/user.service.js"></script>

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
				<p class="big">เปลี่ยนรหัสผ่านใหม่</p>

				<div class="form">
					<div class="form-items">
						<input type="text" id="password" class="input-text" placeholder="ไม่น้อยกว่า 6 ตัวอักษร...">
					</div>

					<div class="form-submit">
						<div class="submit-btn" onclick="javascript:ChangePassword();">บันทึก</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
</body>
</html>