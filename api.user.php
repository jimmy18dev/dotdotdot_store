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
						$register = $user->RegisterUser(array(
							'email' 	=> $_POST['email'],
							'phone' 	=> $_POST['phone'],
							'name' 		=> $_POST['name'],
							'fb_id' 	=> $_POST['fb_id'],
							'fb_name' 	=> $_POST['fb_name'],
							'password' 	=> $_POST['password'],
							'type' 		=> 'member',
							'status' 	=> 'pending',
							'refer' 	=> 'form',
						));

						if(!empty($register)){
							$_SESSION['member_id'] = $register;
            				setcookie('member_id', $register, COOKIE_TIME);
            				
							$registered = true;
						}
						else{
							$registered = false;
						}

						$api->successMessage('New user Registered.',$registered,'');
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
				case 'EditInfo':
					if(true){
						$user->UpdateUserInfo(array(
							'name' 	=> $_POST['name'],
							'phone'	=> $_POST['phone'],
							'email'	=> $_POST['email'],
							'member_id' => MEMBER_ID,
						));
						$api->successMessage('Information updated!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'ChangePassword':
					if(true){
						$user->ChangePassword(array(
							'password' 	=> $_POST['password'],
							'member_id' => MEMBER_ID,
						));
						$api->successMessage('Password Changed!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'ForgetPassword':
					if(true){
						$user->ForgetPassword(array('email' => $_POST['email']));
						$api->successMessage('Forget Code Sending to email!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'CreatePasswordForgetFunction':
					if(true){
						$user->ChangePasswordByForget(array(
							'email' 		=> $_POST['email'],
							'forget_code' 	=> $_POST['forget_code'],
							'password' 		=> $_POST['password'],
						));
						$api->successMessage('New Password Created!','','');
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