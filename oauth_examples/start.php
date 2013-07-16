<?php

session_start();

require ("../lib/tumblrPHP.php");

// Enter your Consumer / Secret Key:
$consumer = "CONSUMER_KEY";
$secret = "SECRET_KEY";

// Create a new instance of the Tumblr Class with your Conumser and Secret when you create your app.
$tumblr = new Tumblr($consumer, $secret);

// Get the request tokens based on your consumer and secret and store them in $token
$token = $tumblr->getRequestToken();

// Set session of those request tokens so we can use them after the application passes back to your callback URL
$_SESSION['oauth_token'] = $token['oauth_token'];
$_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];

// Grab the Authorize URL and pass through the variable of the oauth_token
$data = $tumblr->getAuthorizeURL($token['oauth_token']);

// The user will be directed to the "Allow Access" screen on Tumblr
header("Location: " . $data);
?>