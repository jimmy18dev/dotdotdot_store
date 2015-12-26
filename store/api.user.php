<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'User':
			switch ($_POST['action']) {
				case 'SetAdmin':
					if($_POST['member_id'] != $user->id && $user->Authentication()){
						$user->SetAdmin(array('member_id' => $_POST['member_id'],));
						$api->successMessage('Set Administrator successed!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'UnsetAdmin':
					if($_POST['member_id'] != $user->id && $user->Authentication()){
						$user->UnsetAdmin(array('member_id' => $_POST['member_id'],));
						$api->successMessage('Unset Administrator successed!','','');
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
			$api->errorMessage('USER API ERROR!');
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
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('USER GET API ERROR!');
			break;
	}
}

// API Request is Fail or Null calling
else{
	$api->errorMessage('API NOT FOUND!');
}

exit();
?>