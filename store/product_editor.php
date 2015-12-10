<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "product_editor";

if(isset($_GET['id'])){
	$product->GetProduct(array('product_id' => $_GET['id']));
}
else if(isset($_GET['parent'])){
	// $product->GetProduct(array('product_id' => $_GET['parent']));
}

// Product Parent ID
if($product->parent > 0)
	$parent = $product->parent;
else if(isset($_GET['parent']))
	$parent = $_GET['parent'];
else
	$parent = 0;
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
<script type="text/javascript" src="js/lib/jquery.autosize.min.js"></script>
<script type="text/javascript" src="js/product-form.js"></script>

</head>
<body>
<?php include'header.php';?>

<div class="container">
	<div class="content content-container">
		<form id="ProductCreate" action="product.process.php" method="post" enctype="multipart/form-data">
		<div class="form">
			<div class="form-image <?php echo (isset($_GET['parent'])||$product->type=="sub"?'form-hidden':'');?>">
				<div class="caption">ภาพสินค้า</div>
				<div class="image-input-button">
					<input type="file" class="input-file" id="post_files" name="image_file[]" accept="image/*" multiple="multiple">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">ชื่อสินค้า <span class="required">*</span></div>
				<div class="input">
					<input type="text" class="input-text" name="title" placeholder="" value="<?php echo $product->title;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">รายละเอียดสินค้า</div>
				<div class="input">
					<textarea class="input-text input-textarea animated" name="description" placeholder=""><?php echo $product->description;?></textarea>
				</div>
			</div>
			<div class="form-items form-items-half">
				<div class="caption">ราคาต่อชิ้น (บาท)</div>
				<div class="input">
					<input type="text" class="input-text" name="price" placeholder="price" value="<?php echo (isset($product->price)?$product->price:0);?>">
				</div>
			</div>
			<div class="form-items form-items-half">
				<div class="caption">Code</div>
				<div class="input">
					<input type="text" class="input-text" name="code" placeholder="อักษรพิมพ์ใหญ่" value="<?php echo $product->code;?>">
				</div>
			</div>
			
			<div class="form-submit">
				<button type="submit" class="submit-button"><i class="fa fa-check"></i>บันทึก</button>
			</div>

			<input type="hidden" id="parent" name="parent" value="<?php echo $parent;?>">
			<input type="hidden" id="product_id" name="product_id" value="<?php echo (isset($_GET['parent'])?'':$product->id);?>">
			<input type="hidden" name="group" value="null">
		</div>
		</form>
	</div>
</div>

<!-- Loading process submit photo to uploading. -->
<div id="filter">
	<div id="loading-bar"></div>
	<div id="loading-message">กรุณารอสักครู่ ...</div>
	<div class="cancel"><a href="me.php" target="_parent">ยกเลิก</a></div>
</div>
</body>
</html>