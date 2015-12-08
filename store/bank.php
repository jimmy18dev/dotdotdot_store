<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "bank";
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

<title>Bank</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/bank.service.js"></script>

</head>

<body>
<?php include'header.php';?>
<div class="container">
	<div class="content">
		<a href="bank-editor.php">
		<div class="create-btn">
			<div class="icon"><i class="fa fa-th"></i></div>
			<div class="caption">
				<p>เพิ่มบัญชีธนาคาร</p>
				<p class="tip">กดปุ่มนี้ เพื่อเพิ่มบัญชีธนาคารใหม่ในร้านของคุณ</p>
			</div>
		</div>
		</a>

		<?php echo $bank->ListBank(array('id' => 0));?>
	</div>
</div>
</body>
</html>