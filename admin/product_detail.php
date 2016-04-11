<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "product";

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

<?php include'favicon.php';?>

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

<div class="container">
	<div class="content content-container">
		<div class="tab">
			<a href="product_detail.php?id=<?php echo $_GET['id'];?>" class="<?php echo (empty($_GET['tab'])?'active':'');?>"><i class="fa fa-file-o"></i><span class="caption">ข้อมูลสินค้า</span></a>
			<?php if($product->type != "sub"){?>
			<a href="product_detail.php?id=<?php echo $_GET['id'];?>&tab=subproduct" class="<?php echo ($_GET['tab']=='subproduct'?'active':'');?>"><i class="fa fa-files-o"></i><span class="caption">สินค้าย่อย</span></a>
			<?php }?>
			<a href="product_detail.php?id=<?php echo $_GET['id'];?>&tab=history" class="<?php echo ($_GET['tab']=='history'?'active':'');?>"><i class="fa fa-list"></i><span class="caption">ประวัติสินค้า</span></a>
			<a href="product_detail.php?id=<?php echo $_GET['id'];?>&tab=stat" class="<?php echo ($_GET['tab']=='stat'?'active':'');?>"><i class="fa fa-pie-chart"></i><span class="caption">สถิติ</span></a>

			<a href="product_editor.php?id=<?php echo $product->id;?>" class="right"><i class="fa fa-cog"></i><span class="caption">แก้ไข</span></a>
		</div>
		<div class="detail">
			<header class="info">
				<?php if($product->type == "sub"){?>
				<h2><?php echo $product->parent_title;?></h2>
				<?php }?>
				<h1><?php echo $product->title;?></h1>
				<p><a href="../product-<?php echo $product->id?>.html"><i class="fa fa-tv"></i>ดูหน้าเพจ</a> | เริ่มขาย <?php echo $product->create_time;?></p>
			</header>

			<?php if(empty($_GET['tab'])){?>

			<?php if($product->type != "sub" && !empty($product->image_filename)){?>
			<section class="photo">
				<h4>ภาพสินค้า <a href="product_editor.php?id=<?php echo $product->id;?>#photo">[เพิ่มรูปภาพ]</a></h4>
				<div class="photo-container">
					<div class="photo-items" id="image-<?php echo $var['im_id'];?>">
						<img src="../image/upload/square/<?php echo $product->image_filename;?>" alt="">
						<div class="setcover-btn active"><i class="fa fa-check"></i> เป็นภาพหน้าปกแล้ว</div>
					</div>

					<?php $product->ListPhotoProduct(array('product_id' => $product->id));?>
				</div>
			</section>
			<?php }?>

			<section class="description">
				<h4>คำอธิบาย <a href="product_editor.php?id=<?php echo $product->id;?>#description">[แก้ไข]</a></h4>
				<div class="description-text"><?php echo (empty($product->description)?'ยังไม่มีคำอธิบายสำหรับสินค้าชิ้นนี้':nl2br($product->description));?></div>
			</section>

			<?php if($product->type != "root"){?>
			<section class="description">
				<h4>ราคาขาย <a href="product_editor.php?id=<?php echo $product->id;?>#price">[แก้ไข]</a></h4>
				<div class="description-text"><?php echo number_format($product->price,2);?> บาท</div>
			</section>

			<section class="description">
				<h4>สินค้าคงเหลือ</h4>
				<div class="description-text"><?php echo $product->quantity;?> ชิ้น</div>

				<!-- Product control -->
				<div class="control">
					<a href="quantity.php?id=<?php echo $product->id;?>&action=import" class="control-btn"><i class="fa fa-plus"></i>นำเข้าสินค้า</a>
					<a href="quantity.php?id=<?php echo $product->id;?>&action=export" class="control-btn"><i class="fa fa-arrow-left"></i>โอนสินค้าออก</a>
				</div>
			</section>
			<?php }?>

			<?php }else if($_GET['tab'] == "subproduct"){?>
			<!-- Subproduct -->
			<div class="subproduct">
				<a href="product_editor.php?parent=<?php echo $product->id;?>">
				<div class="subproduct-btn"><i class="fa fa-plus"></i>เพิ่มสินค้าย่อย</div>
				</a>
				<?php $product->ListSubProduct(array('product_id' => $product->id,'render' => 'subproduct-items'));?>
			</div>
			<?php }else if($_GET['tab'] == "stat"){?>
			<section class="stat">
				<?php if($product->type != "sub"){?>
				<div class="stat-items">
					<div class="value"><?php echo number_format($product->view);?><span class="unit">ครั้ง</span></div>
					<div class="caption">แสดงสินค้า</div>
				</div>
				<div class="stat-items">
					<div class="value"><?php echo number_format($product->read);?><span class="unit">ครั้ง</span></div>
					<div class="caption">สนใจสินค้า</div>
				</div>
				<div class="stat-items">
					<div class="value <?php echo ($product->interest_ratio>80?'green':'');?>"><?php echo number_format($product->interest_ratio);?><span class="unit">%</span></div>
					<div class="caption">ความน่าสนใจ</div>
				</div>
				<?php }?>
				<div class="stat-items">
					<div class="value"><?php echo number_format($product->total_in_order);?><span class="unit">ชิ้น</span></div>
					<div class="caption">สั่งซื้อสินค้า</div>
				</div>
			</section>
			<?php }else if($_GET['tab'] == "history"){?>
			<section class="history">
				<?php $product->HistoryProduct(array('product_id' => $product->id));?>
			</section>
			<?php }?>
		</div>
	</div>
</div>

</body>
</html>