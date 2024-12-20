#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "rating request sent";
}

$request = array();
$registration = array(); 
$review = array();
/*
$request['type'] = "Login";
$request['username'] = "steve";
$request['password'] = "password";
^Use for testing purposes only without login page^
*/ 
//Sending Login
$review['type'] = "review";
$review['review'] = $_POST['review'];
$review['password'] = $_POST['password'];
$review['rate'] = $_POST['rate'] //should be a number 1-5
$review['photo'] =$_FILES['photo']; //should upload file path up to the db 


$review['message'] = $msg;
$response = $client->send_request($review);
//$response = $client->publish($request);



if($response['returnCode'] == 1) //This picks up return code 
//if the front-end recieves a message from the MQ with a return code of 1, it means the review send is successful 
{
  header("Location: booking.php"); 
  alert("Your review has been sent");
  //echo "Heres the username" .$request['username'].   "and heres the password"  .$request['password']; //NOTE: this is just testing to make sure that hte username and password went over
}
else if ($response['returnCode'] == 0) //returns user back to login page if login is a failure 
{
  header("Location: booking.php"); 
  alert("Failed to send review");
}

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
