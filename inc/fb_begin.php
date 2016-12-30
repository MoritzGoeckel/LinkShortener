<?php
require 'facebook.php';

header('P3P: CP="NOI ADM DEV COM NAV OUR STP"');

//init
$facebook = new Facebook(array(
  "appId"  => '377610565676276',
  "secret" => 'ea2bab7bec1ec369d4235b72559dde51',
  "domain" => 'minutus.de'));

// Try to get the $User
$user = $facebook->getUser();

if ($user && $user != "0" && $user != 0) {
	try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
		$logoutUrl = $facebook->getLogoutUrl();		
	} catch (FacebookApiException $e) {
		error_log($e);
		$user = "Error!";
	}
}
else 
{
	$loginUrl = $facebook->getLoginUrl(array('scope' => 'email', 'redirect' => 'http://minutus.de/index.php',));
}

//echo "User: " . $user;
//echo "<br>";
?>