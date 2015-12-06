<?php
require_once'config/autoload.php';
$current_page = "order";
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

<title>Order</title>

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
	<div class="content">

		<!-- Order filter -->
		<div class="filter">

			<a href="index.php?filter=complete">
			<div class="filter-items <?php echo ($_GET['filter'] == "complete"?'filter-items-active':'');?>">
				<span class="filter-items-icon"><i class="fa fa-check-circle"></i></span>
				<span class="filter-items-caption">เรียบร้อย</span>
			</div>
			</a>

			<a href="index.php?filter=transfersuccess">
			<div class="filter-items <?php echo ($_GET['filter'] == "transfersuccess"?'filter-items-active':'');?>">
				<span class="filter-items-icon"><i class="fa fa-check"></i></span>
				<span class="filter-items-caption">ชำระแล้ว</span>
			</div>
			</a>

			<a href="index.php?filter=transferrequest">
			<div class="filter-items <?php echo ($_GET['filter'] == "transferrequest"?'filter-items-active':'');?>">
				<span class="filter-items-icon"><i class="fa fa-money"></i></span>
				<span class="filter-items-caption">โอนเงิน</span>
			</div>
			</a>

			<a href="index.php?">
			<div class="filter-items <?php echo (empty($_GET['filter'])?'filter-items-active':'');?>">
				<span class="filter-items-icon"><i class="fa fa-list"></i></span>
				<span class="filter-items-caption">ทั้งหมด</span>
			</div>
			</a>
		</div>

		<?php $order->ListOrder(array('filter' => $_GET['filter'],));?>
	</div>
</div>
</body>
</html>