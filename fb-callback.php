<?php
require_once'config/autoload.php';
include'sdk/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook([
	'app_id' 				=> APP_ID,
	'app_secret' 			=> APP_SECRET,
	'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

try{
	if(isset($_SESSION['facebook_access_token'])){
		$accessToken = $_SESSION['facebook_access_token'];
	}else{
		$accessToken = $helper->getAccessToken();
	}
}catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	$error_log = 'Graph returned an error: '.$e->getMessage();
	header('Location: login.php?error='.$error_log);
	exit;
}catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	$error_log = 'Facebook SDK returned an error: ' . $e->getMessage();
	header('Location: login.php?error='.$error_log);
  	exit;
}

if(isset($accessToken)) {
	if(isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		// $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		$_SESSION['facebook_longlived_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// redirect the user back to the same page if it has "code" GET variable
	if(isset($_GET['code'])){
		// header('Location: index.php?msg=error');
		$error_log = "isset(code) is Fail!";
	}

	// getting basic info about user
	try {
		$profile_request = $fb->get('/me?fields=id,email,name,first_name,last_name');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		$error_log = 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		// header("Location: index.php");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		$error_log = 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	// printing $profile array on the screen which holds the basic info about user'
	// echo'<pre>';
	// print_r($profile);
	// echo'</pre>';

	// Return member id after user registed.
	$member_id = $user->facebookLogin($profile['email'],$profile['id'],$profile['name']);

	// Set First member to Administrator
	if($member_id == 1){ $user->firstUserToAdministrator(); }

	// Set session
	$_SESSION['member_id'] = $member_id;
	// Set Cookie (1 year)
	setcookie('member_id',$member_id, COOKIE_TIME);

	// Redirect page after Login.
	if(!empty($_GET['return'])){
		header('Location: http://www.dotdotdotlimited.com/product-'.$_GET['return'].'.html');
	}else{
		header('Location: index.php?faceboook=login_successful');
	}
}else{
	header('Location: login.php?');
}
?>