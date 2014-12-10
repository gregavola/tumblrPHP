<?php

session_start();

include ("../lib/tumblrPHP.php");

// Enter your Consumer / Secret Key:
$consumer = "CONSUMER_KEY";
$secret = "SECRET_KEY";

$tumblr = new Tumblr($consumer, $secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

// The oauth_verfier is set back from Tumblr and is needed to obtain access tokens
$oauth_verifier = $_GET['oauth_verifier'];

// User the getAcessToken method and pass through the oauth_verifier to get tokens;
$token = $tumblr->getAccessToken($oauth_verifier);

// Set the session for the new access tokens, replacing the request tokens
$_SESSION['oauth_token'] = $token['oauth_token'];
$_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];

// Create a new instance of the Tumblr Class with the Request Tokens that we just set at line 20 and 21
$tumblr = new Tumblr($consumer, $secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

// Grab the followers by using the oauth_get method.
$followers = $tumblr->oauth_get("/blog/blog.untappd.com/followers");

// Print the results to the screen
print_r($followers);



?>
