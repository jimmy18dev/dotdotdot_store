<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Bank':
			switch ($_POST['action']) {
				case 'CreateBank':
					if(true){
						$bank->CreateBank(array(
							'bank_id'=>$_POST['bank_id'],
							'code' => $_POST['code'],
							'branch' => $_POST['branch'],
							'name' => $_POST['name'],
							'number' => $_POST['number'],
						));
						$api->successMessage('Bank Created!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'DeleteBank':
					if(true){
						$bank->DeleteBank(array('bank_id'=>$_POST['bank_id'],));
						$api->successMessage('Bank Deleted!','','');
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
			$api->errorMessage('BANK API ERROR!');
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