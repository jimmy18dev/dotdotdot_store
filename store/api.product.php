<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Product':
			switch ($_POST['action']) {
				case 'SetCover':
					if(true){
						$product->SetCover(array(
							'product_id' 	=> $_POST['product_id'],
							'image_id' 		=> $_POST['image_id'],
						));

						$api->successMessage('SetCover success!','null',$dataset);
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'DeletePhoto':
					if(true){
						$product->DeletePhoto(array(
							'product_id' 	=> $_POST['product_id'],
							'image_id' 		=> $_POST['image_id'],
						));

						$api->successMessage('Photo\'s Deleted!','null',$dataset);
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('COMMENT POST API ERROR!');
			break;
	}
}

// API Request $_GET
else if($_GET['calling'] != ''){
	switch ($_GET['calling']) {
		case 'Comment':
			switch ($_GET['action']) {
				case 'List':
					break;
				case 'LiveComment':
					break;
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('COMMENT GET API ERROR!');
			break;
	}
}

// API Request is Fail or Null calling
else{
	$api->errorMessage('API NOT FOUND!');
}

exit();
?>