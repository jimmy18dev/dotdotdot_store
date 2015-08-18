<?php
require_once'config/autoload.php';
include'sdk/facebook-sdk/autoload.php';
include'facebook.php';
?>

<?php
// Process
// Get place data
$place->GetPlace(array('place_id' => $_GET['place_id']));

// Get post data
$post->GetPost(array('post_id' => $_GET['post']));

// Current page
$current_page = array(
	'page' => 'editor',
);

if(!empty($post->id) && $post->id > 0){
	$current_page['mode'] = 'post-edit';
}

// Member banned direct to profile
if($me->status == "caution" || $me->status == "banned"){
   	header("Location: member.php?id=".$me->id);
    die();
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

<title>Editor</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.autosize.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.form.min.js"></script>

</head>

<body>

<form id="PostCreate" action="post.process.php" method="post" enctype="multipart/form-data">
<?php
include'header.php';
?>
<div id="editor">
	<div class="editor-container">
		<div class="poster-photo">
			<img src="https://graph.facebook.com/<?php echo $me->id;?>/picture?type=square" alt="<?php echo $me->fname;?>">
		</div>
		<!-- Caption message -->
		<div class="caption-input">
			<textarea class="input-textarea animated" id="post-text" name="post_text" placeholder="แสดงความคิดเห็นของคุณ..." autofocus onKeyUp="javascript:OffensiveWord();"><?php echo $post->text;?></textarea>

			<!-- Photo upload -->
			<div class="photo-input">
				<span id="post_files_div"></span>
				<span id="post_thumbnail">
					<?php if(empty($post->image_normal)){?>
					<div class="icon"><i class="fa fa-camera"></i> เลือกภาพ</div>
					<?php }else{?>
					<img src="<?php echo $post->image_large;?>" alt="">
					<?php }?>
				</span>
				<input type="file" class="input-file" id="post_files" name="image_file" accept="image/*">
			</div>

			<!-- Rating -->
			<div class="rating-input">
				<span class="rating-items" id="rating-1" onClick="javascript:RatingSelect(1);"><i class="fa fa-star"></i></span>
				<span class="rating-items" id="rating-2" onClick="javascript:RatingSelect(2);"><i class="fa fa-star"></i></span>
				<span class="rating-items" id="rating-3" onClick="javascript:RatingSelect(3);"><i class="fa fa-star"></i></span>
				<span class="rating-items" id="rating-4" onClick="javascript:RatingSelect(4);"><i class="fa fa-star"></i></span>
				<span class="rating-items" id="rating-5" onClick="javascript:RatingSelect(5);"><i class="fa fa-star"></i></span>
				<span class="rating-caption" id="rating-caption"> - ให้คะแนนสำหรับโพสต์นี้</span>
			</div>
		</div>
	</div>


	<input type="hidden" name="post_rating" id="rating" value="<?php echo (empty($post->rating) ? '0' : $post->rating);?>">

	<input type="hidden" name="post_title" value="<?php echo $post->title;?>">
	<input type="hidden" name="post_subtitle" value="<?php echo $post->subtitle;?>">

	<!-- Post info -->
	<input type="hidden" name="place_id" id="place_id" value="<?php echo (empty($place->id) ? $post->place_id : $place->id);?>">
	<input type="hidden" name="post_id" value="<?php echo (empty($post->id) ? '0' : $post->id);?>">

	<!-- Memeber info -->
	<input type="hidden" name="member_id" value="<?php echo $me->id;?>">
	<input type="hidden" name="token" value="<?php echo $me->token;?>">
</div>
</form>


<!-- Loading process submit photo to uploading. -->
<div id="filter">
	<div id="loading-bar"></div>
	<div id="loading-message">กำลังอัพโหลด...</div>
	<div class="cancel"><a href="index.php" target="_parent">ยกเลิก</a></div>
</div>

<!-- JS Lib -->
<script type="text/javascript" src="js/editor.js"></script>
<?php if(empty($post->id)){?>
<script type="text/javascript" src="js/editor.thumbnail.js"></script>
<?php }?>
<script type="text/javascript" src="js/rating.js"></script>
</body>
</html>