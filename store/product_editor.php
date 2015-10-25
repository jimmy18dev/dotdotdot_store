<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';

if(isset($_GET['id'])){
	$product->GetProduct(array('product_id' => $_GET['id']));
}
else if(isset($_GET['parent'])){
	$product->GetProduct(array('product_id' => $_GET['parent']));
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
		<div class="topic-caption">เพิ่มสินค้าใหม่</div>
	</div>

	<div class="content">
		<form id="ProductCreate" action="product.process.php" method="post" enctype="multipart/form-data">
		<div class="form">
			<div class="form-image">
				<div class="image-input">
					<div class="image-button"><i class="fa fa-camera"></i>เลือกภาพสินค้า</div>
					<input type="file" class="input-file" id="post_files" name="image_file[]" accept="image/*" multiple="multiple">
				</div>
				<div class="image-container">
					<?php for($i=0;$i<3;$i++){?>
					<div class="image-items">
						<img src="https://scontent-sin1-1.xx.fbcdn.net/hphotos-xfa1/v/t1.0-9/11892137_10203607885677223_1364990806829068049_n.jpg?oh=5643180349bc992073a72a2ac7fba06f&oe=56D15E02" alt="">
					</div>
					<div class="image-items">
						<img src="https://scontent-sin1-1.xx.fbcdn.net/hphotos-xfa1/v/t1.0-9/11892137_10203607885677223_1364990806829068049_n.jpg?oh=5643180349bc992073a72a2ac7fba06f&oe=56D15E02" alt="">
					</div>
					<div class="image-items">
						<img src="https://scontent-sin1-1.xx.fbcdn.net/hphotos-xfa1/v/t1.0-9/11892137_10203607885677223_1364990806829068049_n.jpg?oh=5643180349bc992073a72a2ac7fba06f&oe=56D15E02" alt="">
					</div>
					<div class="image-items">
						<img src="https://scontent-sin1-1.xx.fbcdn.net/hphotos-xfa1/v/t1.0-9/11892137_10203607885677223_1364990806829068049_n.jpg?oh=5643180349bc992073a72a2ac7fba06f&oe=56D15E02" alt="">
					</div>
					<?php }?>
				</div>
			</div>
			<div class="form-items">
				<div class="caption">รหัสสินค้า</div>
				<div class="input">
					<input type="text" class="input-text" name="product_id" value="<?php echo (isset($_GET['parent'])?'':$product->id);?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">Parent</div>
				<div class="input">
					<input type="text" class="input-text"  name="parent" value="<?php echo (isset($_GET['parent'])?$product->id:'0');?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">Code</div>
				<div class="input">
					<input type="text" class="input-text"  name="code" value="<?php echo $product->code;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">ชื่อสินค้า</div>
				<div class="input">
					<input type="text" class="input-text"  name="title" placeholder="title" value="<?php echo $product->title;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">รายละเอียดสินค้า</div>
				<div class="input">
					<input type="text" class="input-text input-textarea"  name="description" placeholder="description" value="<?php echo $product->description;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">จำนวน</div>
				<div class="input">
					<input type="text" class="input-text"  name="unit" placeholder="unit" value="1" value="<?php echo $product->unit;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">ราคาต่อชิ้น</div>
				<div class="input">
					<input type="text" class="input-text"  name="price" placeholder="price" value="<?php echo (isset($product->price)?$product->price:0);?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">กลุ่มสินค้า</div>
				<div class="input">
					<input type="text" class="input-text"  name="group" placeholder="group" value="shrit"><br>
				</div>
			</div>
			<div class="form-submit">
				<button type="submit" class="submit-button" ><?php echo (isset($product->id)?'Save':'Create')?></button>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>