<?php
require_once'config/autoload.php';
header("Content-type: text/json");

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Config':
			switch ($_POST['action']) {
				case 'UpdateEmail':
					if(true){
						$config->UpdateEmailConfig(array(
							'email_host' 		=> $_POST['email_host'],
							'email_username' 	=> $_POST['email_username'],
							'email_password' 	=> $_POST['email_password'],
							'email_port' 		=> $_POST['email_port'],
							'email_address' 	=> $_POST['email_address'],
							'email_name' 		=> $_POST['email_name'],
						));
						$api->successMessage('Email config updated!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'UpdateFacebook':
					if(true){
						$config->UpdateFacebookConfig(array(
							'facebook_app_id' 		=> $_POST['facebook_app_id'],
							'facebook_app_secret' 	=> $_POST['facebook_app_secret'],
						));
						$api->successMessage('Facebook SDK updated!','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'UpdateMeta':
					if(true){
						$config->UpdateMetaConfig(array(
							'meta_title' 	=> $_POST['meta_title'],
							'meta_description' 	=> $_POST['meta_description'],
							'meta_sitename' 	=> $_POST['meta_sitename'],
							'meta_author' 	=> $_POST['meta_author'],
							'meta_keyword' 	=> $_POST['meta_keyword'],
						));
						$api->successMessage('Metadata updated!','','');
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