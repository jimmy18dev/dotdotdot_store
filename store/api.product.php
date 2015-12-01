<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Product':
			switch ($_POST['action']) {
				case 'SetCover':
					if($user->Authentication() && $user->type == "administrator"){
						$product->SetCover(array(
							'product_id' 	=> $_POST['product_id'],
							'image_id' 		=> $_POST['image_id'],
						));

						// Save activity log
						$product->CreateProductActivity(array(
							'token' 		=> $user->token,
							'admin_id'      => $user->id,
            				'product_id'    => $_POST['product_id'],
            				'action'        => 'SetCover',
            				'value'         => '',
            				'deescription'  => '',
            				'ref_id' 		=> $_POST['image_id'],
						));

						$api->successMessage('SetCover success!','null',$dataset);
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'DeletePhoto':
					if($user->Authentication() && $user->type == "administrator"){
						$product->DeletePhoto(array(
							'product_id' 	=> $_POST['product_id'],
							'image_id' 		=> $_POST['image_id'],
						));

						// Save activity log
						$product->CreateProductActivity(array(
							'token' 		=> $user->token,
							'admin_id'      => $user->id,
            				'product_id'    => $_POST['product_id'],
            				'action'        => 'DeletePhoto.',
            				'value'         => '',
            				'deescription'  => '',
            				'ref_id' 		=> $_POST['image_id'],
						));

						$api->successMessage('Photo\'s Deleted!','null',$dataset);
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'UpdateQuantity':
					if($user->Authentication() && $user->type == "administrator"){
						$product_id = $product->UpdateQuantity(array(
							'admin_id'		=> MEMBER_ID,
							'product_id' 	=> $_POST['product_id'],
							'action' 		=> $_POST['product_action'],
							'quantity' 		=> $_POST['quantity'],
						));

						// Save activity log
						$product->CreateProductActivity(array(
							'token' 		=> $user->token,
							'admin_id'      => $user->id,
            				'product_id'    => $_POST['product_id'],
            				'action'        => $_POST['product_action'],
            				'value'         => $_POST['quantity'],
            				'deescription'  => '',
            				'ref_id' 		=> '',
						));

						$api->successMessage('Quantity updated!','null',$dataset);
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'ChangeStatus':
					if($user->Authentication() && $user->type == "administrator"){

						$product->GetProduct(array('product_id' => $_POST['product_id']));

						$product->ChangeStatus(array(
							'product_id' 	=> $product->id,
							'status' 		=> $product->status,
						));

						if($product->status == "active"){
							$status = "disable";
						}
						else if($product->status == "disable"){
							$status = "active";
						}

						// Save activity log
						$product->CreateProductActivity(array(
							'token' 		=> $user->token,
							'admin_id'      => $user->id,
            				'product_id'    => $_POST['product_id'],
            				'action'        => $status,
            				'value'         => '',
            				'deescription'  => '',
            				'ref_id' 		=> '',
						));

						$api->successMessage('Status changed!',$status,$dataset);
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