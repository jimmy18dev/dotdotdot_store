<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "product_quantity";

$product->GetProduct(array('product_id' => $_GET['id']));
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

<title>Product Detail</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/product.service.js"></script>

</head>

<body>

<?php include'header.php';?>
<?php
if($_GET['action'] == "import"){
	$caption = "นำเข้าสินค้า";
}
if($_GET['action'] == "export"){
	$caption = "โอนสินค้าออก";
}
?>
<div class="container">
	<div class="content content-container">
		<div class="form">
			<div class="form-items">
				<div class="caption"><?php echo $caption;?></div>
				<div class="caption"><?php echo $product->title;?> <?php echo ($product->type == "sub"?'('.$product->parent_title.') เหลือสินค้า '.$product->quantity.' ชิ้น':'');?></div>
				<div class="input">
					<input type="text" class="input-text" id="quantity" name="quantity">
				</div>
			</div>

			<input type="hidden" id="product_id" value="<?php echo $_GET['id'];?>">
			<input type="hidden" id="action" value="<?php echo $_GET['action'];?>">
			
			<div class="form-submit">
				<button type="submit" class="submit-button" onclick="javascript:UpdateQuantity();"><i class="fa fa-check"></i>SAVE</button>
			</div>
		</div>
	</div>
</div>

</body>
</html>