#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($uname, $passwd)
{	
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf('SELECT password_hash FROM users WHERE uname = "%s"',
	    $mysqli->real_escape_string($uname));
    $result = $mysqli->query($sql);

    if ($result && $user = $result->fetch_assoc()) {
	if (password_verify($passwd, $user["password_hash"])) {
		echo "success";
		return array("returnCode" => '1',
		       'message' => "Server received request and processed: Login Successful");
	} else {
		echo "bad password\n"; echo $user["password_hash"];
		return array("returnCode" => '0', 
		       'message' => "Server received request and processed: Invalid password");
        }
    } else {
	echo "user not found";    
        return array("returnCode" => '0', 'message' => "Server received request and processed: User not found");
    }
}

function doRegister($uname, $passwd, $email)
{
	$password_hash = password_hash($passwd, PASSWORD_DEFAULT);
	$mysqli = require __DIR__ . "/database.php";

	$sql = "INSERT INTO users (uname, email, password_hash)
		VALUES (?, ?, ?)";
	$stmt = $mysqli->stmt_init();

	if (!$stmt->prepare($sql)) {
           return array("returnCode" => "0", "message" => 'stmt didnt prepare');
        }

	$stmt->bind_param("sss", $uname, $email, $password_hash);
	
	if ($stmt->execute()) {
          return array("returnCode" => "1", "message" => 'success');
    
        } else {
            if ($mysqli->errno === 1062) {
               return array("returnCode" => "0", "message" => 'email taken, registration unsuccessful');
            } else {
                return array("returnCode" => "0", "message" => 'other error ',$mysqli->errno);
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
    case "register":
      return doRegister($request['username'],$request['password'],$request['email']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
