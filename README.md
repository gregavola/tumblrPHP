# tumblrPHP - A PHP Library for the Tumblr API (V2)

This a library written to interact with the Tumblr API (http://www.tumblr.com/docs/en/api/v2) using both oAuth Authenticated Calls and Non-Authenticated calls.<br />

# Update 
The OAuth Script has been tested and is now working again.

# Requirements
PHP 5+<br />
CURL<br />
oAuth for PHP (included in this repo)<br />

# Getting Started
Follow the instructions in <code>oauth_examples/..</code> for a detailed example of the OAuth authentication. If you want basic authentication examples, please see the <code>basic_examples/..</code> folder.

<br />After obtaining the Authentication tokens, if you want to make authenticated calls you just need to use the following method:

<pre>
$tumblr = new Tumblr(consumer, secret, user_token, user_secret);
$res = $tumblr->oauth_get(METHOD_HERE, PARAMS_HERE);
</pre>

If you are using non-authenticated calls - all you need to do is use the <code>get</code> method:

<pre>
$tumblr = new Tumblr(consumer, secret);
$res = $tumblr->get(METHOD_HERE, PARAMS_HERE);
</pre>

# To Do
Error Handling

# Getting Help
If you need help or have questions, please contact Greg Avola on Twitter at http://twitter.com/gregavola

# About
This library was inspired by Abraham's version of Twitter OAuth - https://github.com/abraham/twitteroauth
