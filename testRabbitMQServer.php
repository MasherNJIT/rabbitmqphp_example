#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password) //this determines what return code is going to bne 
{
    // lookup username in database
	var_dump($request);
	$username = $request['username'];
	$password = $request['password'];
	$mysqli = require __DIR__ . "/database.php";
	$sql = sprintf('SELECT password_hash FROM
       	users WHERE uname ="%s"', $mysqli->real_escape_string($username));
	$result = $mysqli->query($sql);
	$user = $result->fetch_assoc();
	// check password
	if ($statement->fetch()) {
		if (password_verify($password, $user["password_hash"])) {
   	            return true;
		} else {
			return false;
		}
	}
}

function requestProcessor($request) //this is what sends return code 
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      //return doLogin($request['username'],$request['password']);
      echo $request['username'] . $request['password'] //tests to make sure the username and password made it over to the database
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed"); //this is the code that returns 0 or 1 based on if the credentials are there
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
