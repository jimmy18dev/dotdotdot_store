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

							// Update member info
							$user->GetUser(array('member_id' => $register));

							// Sending to Customer
							if($config->email_status && !empty($user->email) && !empty($user->verify_code) && $user->status == "pending"){
								$mail->addAddress($user->email);
								$mail->Subject 	= 'ยืนยันอีเมลของคุณ';
								$message 		= file_get_contents('template/email/email_verify.html');
								$message 		= str_replace('%domain%' ,$metadata['domain'], $message);
								$message 		= str_replace('%name%' ,$user->name, $message);
								$message 		= str_replace('%email%' ,$user->email, $message);
								$message 		= str_replace('%code%' ,$user->verify_code, $message);
								$message        = str_replace('%sitename%' ,$config->meta_sitename, $message);
								$message        = str_replace('%copyrightyear%' ,date("Y"), $message);
								
								$mail->Body    	= $message;
								$mail->AltBody 	= 'This is the body in plain text for non-HTML mail clients';

								if(!$mail->send())
									$email_send = $mail->ErrorInfo;
								else
									$email_send = "Message has been sent";
							}
						}
						else{
							$login = $user->LoginUserProcess(array(
								'username' 	=> $_POST['email'],
								'password'	=> $_POST['password'],
							));

							if($login)
								$registered = true;
							else
								$registered = false;
						}

						// Set First member to Administrator
						if($register == 1){
							$user->SetAdminProcess();
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
						$dataset = $user->ForgetPassword(array('email' => $_POST['email']));
						$api->successMessage('Forget Code Sending to email!','','');

						// Sending to Customer
						if($config->email_status && !empty($dataset['email']) && !empty($dataset['forget_code'])){
							$mail->addAddress($dataset['email']);
							$mail->Subject 	= 'กู้คืนรหัสผ่านในบัญชีของคุณ';
							$message 		= file_get_contents('template/email/forget_password.html');
							$message 		= str_replace('%domain%' ,$metadata['domain'], $message);
							$message 		= str_replace('%email%' ,$dataset['email'], $message);
							$message 		= str_replace('%code%' ,$dataset['forget_code'], $message);
							$message        = str_replace('%sitename%' ,$config->meta_sitename, $message);
							$message        = str_replace('%copyrightyear%' ,date("Y"), $message);

							$mail->Body    	= $message;
							$mail->AltBody 	= 'This is the body in plain text for non-HTML mail clients';

							if(!$mail->send())
								$email_send = $mail->ErrorInfo;
							else
								$email_send = "Message has been sent";
						}
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