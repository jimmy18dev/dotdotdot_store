<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

if(isset($_GET['id'])){
	$product->GetProduct(array('product_id' => $_GET['id']));
}
else if(isset($_GET['parent'])){
	// $product->GetProduct(array('product_id' => $_GET['parent']));
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

<title>Product Create</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.form.min.js"></script>
<script type="text/javascript" src="js/product-form.js"></script>

</head>
<body>
<?php include'header.php';?>

<div class="container">
	<div class="topic">
		<?php if(isset($_GET['parent'])||$product->type=="sub"){?>
		<div class="topic-caption">เพิ่มสินค้าย่อย</div>
		<?php }else{?>
		<div class="topic-caption">เพิ่มสินค้าใหม่</div>
		<?php }?>
	</div>

	<div class="content content-container">
		<form id="ProductCreate" action="product.process.php" method="post" enctype="multipart/form-data">
		<div class="form">
			<div class="form-image <?php echo (isset($_GET['parent'])||$product->type=="sub"?'form-hidden':'');?>">
				<div class="image-input-button"><i class="fa fa-camera"></i>เลือกภาพสินค้า</div>
				<input type="file" class="input-file" id="post_files" name="image_file[]" accept="image/*" multiple="multiple">

				<div class="image-container">
					<!-- <div class="image-items">
						<img src="https://scontent-sin1-1.xx.fbcdn.net/hphotos-xfa1/v/t1.0-9/11892137_10203607885677223_1364990806829068049_n.jpg?oh=5643180349bc992073a72a2ac7fba06f&oe=56D15E02" alt="">
					</div> -->
				</div>
			</div>
			<div class="form-items">
				<div class="caption">ชื่อสินค้า</div>
				<div class="input">
					<input type="text" class="input-text" name="title" placeholder="title" value="<?php echo $product->title;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">รายละเอียดสินค้า</div>
				<div class="input">
					<input type="text" class="input-text input-textarea" name="description" placeholder="description" value="<?php echo $product->description;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">Code</div>
				<div class="input">
					<input type="text" class="input-text" name="code" value="<?php echo $product->code;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">จำนวน</div>
				<div class="input">
					<input type="text" class="input-text" name="quantity" placeholder="quantity" value="1" value="<?php echo $product->quantity;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">ราคาต่อชิ้น</div>
				<div class="input">
					<input type="text" class="input-text" name="price" placeholder="price" value="<?php echo (isset($product->price)?$product->price:0);?>">
				</div>
			</div>
			<div class="form-submit">
				<button type="submit" class="submit-button"><?php echo (isset($product->id)?'Save':'Create')?></button>
			</div>

			<input type="hidden" name="parent" value="<?php echo (isset($_GET['parent'])?$_GET['parent']:'0');?>">
			<input type="hidden" name="product_id" value="<?php echo (isset($_GET['parent'])?'':$product->id);?>">
			<input type="hidden" name="group" value="null">
		</div>
		</form>
	</div>
</div>
</body>
</html>