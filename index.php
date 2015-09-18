<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

if(!empty($user->current_order_id)){
	$order->GetOrder(array('order_id' => $user->current_order_id));
}

$order->CheckingOrder(array('id' => 0));
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

<title>Homepage</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/order.service.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	// MyCurrentOrder();
});
</script>

</head>

<body>
<?php include'header.php';?>

<div class="content">
	<div class="product">

		<?php for($i=0;$i<3;$i++){?>
		<div class="product-items">
			<div class="thumbnail">
				<img src="image/site/1.jpg" alt="">
			</div>
			<div class="detail">
				<div class="title">เสื้อ Thailand not for Sale.</div>
				<div class="control">
					<div class="buy-button">245.00 ฿</div>
				</div>
			</div>
		</div>
		<div class="product-items">
			<div class="thumbnail">
				<img src="image/site/2.jpg" alt="">
			</div>
			<div class="detail">
				<div class="title">เสื้อ Thailand not for Sale.</div>
				<div class="control">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
		</div>
		<div class="product-items product-higtlight">
			<div class="thumbnail">
				<img src="image/site/3.jpg" alt="">
			</div>
			<div class="detail">
				<div class="title">เสื้อ Thailand not for Sale.</div>
				<div class="control">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
		</div>
		<div class="product-items">
			<div class="thumbnail">
				<img src="image/site/1.jpg" alt="">
			</div>
			<div class="detail">
				<div class="title">เสื้อ Thailand not for Sale.</div>
				<div class="control">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
		</div>
		<div class="product-items">
			<div class="thumbnail">
				<img src="image/site/4.jpg" alt="">
			</div>
			<div class="detail">
				<div class="title">เสื้อ Thailand not for Sale.</div>
				<div class="control">
					<div class="buy-button">390.00 ฿</div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
</div>

<table border="1">
	<tr>
		<td>ID</td>
		<td>Title</td>
		<td>Description</td>
		<td>Amount</td>
		<td>Price</td>
		<td>Create</td>
		<td>Update</td>
	</tr>
	<?php $product->ListProduct(array('null' => 0));?>
	</table>

<?php
include'footer.php';
?>
</body>
</html>