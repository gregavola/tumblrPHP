<?php
// include the Tumblr PHP file. The directory is up to your choosing.
include ("lib/tumblrPHP.php");

// Enter your Consumer / Secret Key:
$consumer = "CONSUMER_KEY";
$secret = "SECRET_KEY";

// Start the Session
session_start();


// If we already have the oauth tokens set by the Session - let's use them to make a request
if ((isset($_SESSION['oauth_token']) && isset($_SESSION['oauth_token_secret'])))
{
	// set the Content Type to JSON (so we can use things like JSON Viewer in Firefox to view the response nicely)
	header("Content-type: application/json");
	
	// Create an instance of the Tumblr Class passing the consumer, secret, the access token for the user
	$tumblr = new Tumblr($consumer, $secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	
	// Grab the followers by using the oauth_get method.
	$followers = $tumblr->oauth_get("/blog/blog.untappd.com/followers");
	
	// Print the results to the screen
	echo json_encode($followers);
}
// If we detect the oauth_token is from the query string (this is after the user authorizes the account)
else if (isset($_GET['oauth_token'])) {
	
	// set the Content Type to JSON (so we can use things like JSON Viewer in Firefox to view the response nicely)
	header("Content-type: application/json");
	
	// Set up the instance of the class using the session REQUEST tokens set at line 51 and 52
	$tumblr = new Tumblr($consumer, $secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	
	// The oauth_verfier is set back from Tumblr and is needed to obtain access tokens
	$oauth_verifier = $_GET['oauth_verifier'];
	
	// User the getAcessToken method and pass through the oauth_verifier to get tokens;
	$token = $tumblr->getAcessToken($oauth_verifier);
	
	// Set the session for the new access tokens, replacing the request tokens
	$_SESSION['oauth_token'] = $token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];
	
	// Create a new instance of the Tumblr Class with the Request Tokens that we just set at line 40 and 41
	$tumblr = new Tumblr($consumer, $secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	
	// Grab the followers by using the oauth_get method.
	$followers = $tumblr->oauth_get("/blog/blog.untappd.com/followers");
	
	// Print the results to the screen
	echo json_encode($followers);
}
// If this is the first time we launch this page - it will need to auto redirect to the Tumblr site for account access approval
else
{
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
}


?>