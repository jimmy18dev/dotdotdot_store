<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'User':
			switch ($_POST['action']) {
				case 'RegisterUser':
					if(true){
						$user->RegisterUser(array(
							'email' 	=> $_POST['email'],
							'phone' 	=> $_POST['phone'],
							'name' 		=> $_POST['name'],
							'fb_name' 	=> $_POST['fb_name'],
							'password' 	=> $_POST['password'],
							'type' 		=> 'member',
							'status' 	=> 'active',
						));
						$api->successMessage('New user Registered.','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'LoginUser':
					if(true){
						$login = $user->LoginUserProcess(array(
							'username' 	=> $_POST['username'],
							'password'	=> $_POST['password'],
						));
						$api->successMessage('User Logined.',$login,'');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'SubmitAddress':
					if(true){
						if($_POST['address_id'] == 0){
							$address->CreateAddress(array(
								'member_id' => MEMBER_ID,
								'address' 	=> $_POST['address'],
							));
							$api->successMessage('Address Created.','','');
						}
						else{
							$address->EditAddress(array(
								'member_id' => MEMBER_ID,
								'address' 	=> $_POST['address'],
								'address_id' => $_POST['address_id'],
							));
							$api->successMessage('Address Created.','','');
						}
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