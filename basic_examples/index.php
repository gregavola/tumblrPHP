<?php

require ("tumblrPHP.php");

// Enter your Consumer (Also known as oyur API KEY)
$consumer = "CONSUMER_KEY";

// Create a new instance of the Tumblr Class with your Conumser when you create your app. You can pass an empty string for the secret, or you can add it.
$tumblr = new Tumblr($consumer, "");

// Grab the followers by using the oauth_get method.
$info = $tumblr->get("/blog/blog.untappd.com/info");

print_r($info);

?>