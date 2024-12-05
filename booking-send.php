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
  $msg = "booking request sent";
}

$booking = array(); 


//Sending Registration
$booking ['type'] = "booking";
$booking ['bookerName'] = $_POST['bookerName'];
$booking ['numGuest'] = $_POST['numGuest'];
$booking ['country'] = "Poland"
$booking ['city'] = "Warsaw";
$booking ['hotelName'] = "Polish Hotel";
$booking ['checkinDate'] = $_POST['checkinDate'];
$booking ['checkOutDate'] = $_POST['checkOutDate'];

$booking ['message'] = $msg;
$response = $client->send_request($booking);

if($response['returnCode'] == 1) //This picks up return code 
//if the front-end recieves a message from the MQ with a return code of 1, it means the login is successful 
{
  echo "Booking successful "; 
  //echo "Heres the username" .$request['username'].   "and heres the password"  .$request['password']; //NOTE: this is just testing to make sure that hte username and password went over
}
else if ($response['returnCode'] == 0) //returns user back to login page if login is a failure 
{
  echo "You did not book a hotel womp womp ";
}

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
