#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
    // lookup username in database
	var_dump($request);
	$username = $request['username'];
	$password = $request['password'];
	$mysqli = /*database connection */
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

function requestProcessor($request)
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
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
