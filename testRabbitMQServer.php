#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doError($error)
{
	error_log("Error message here -> ". $error . "\n", 3, "/var/log/deployment.log");
}


function doLogin($uname, $passwd)
{	
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf('SELECT password_hash FROM users WHERE uname = "%s"',
	    $mysqli->real_escape_string($uname));
    $result = $mysqli->query($sql);

    if ($result && $user = $result->fetch_assoc()) {
	if (password_verify($passwd, $user["password_hash"])) {
		return array("returnCode" => '1',
		       'message' => "Server received request and processed: Login Successful");
	} else {
		return array("returnCode" => '0', 
		       'message' => "Server received request and processed: Invalid password");
        }
    } else {    
        return array("returnCode" => '0', 'message' => "Server received request and processed: User not found");
    }
}

function doRegister($uname, $passwd, $email)
{
	$password_hash = password_hash($passwd, PASSWORD_DEFAULT);
	$mysqli = require __DIR__ . "/database.php";

	$sql = "INSERT INTO users (uname, email, password_hash, join_date)
		VALUES (?, ?, ?, CURDATE())";
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

function doBooking($bookerName, $numGuest, $country, $city, $hotelName, $checkinDate, $checkOutDate)
{
	$mysqli = require __DIR__ . "/database.php";

        $sql = "INSERT INTO bookings (user_id, guest, country, city, check_in, check_out, hotel_name)
                VALUES (?, ?, ?, ?, CURDATE(), CURDATE(), ?)";
        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
           return array("returnCode" => "0", "message" => 'stmt didnt prepare');
	}
	
	$stmt->bind_param("sssssss", $bookerName, $numGuest, $country, $city, $checkinDate, $checkOutDate, $hotelName);

        if ($stmt->execute()) {
          return array("returnCode" => "1", "message" => 'success');
	} else {
	  return array("returnCode" => "0", "message" => 'fail');
	}

}

$err = false;
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
    case "error":
      $err = true;
      return doError($request['error']);
    case "booking":
      return doBooking($request['bookerName'],$request['numGuest'],$request['country'],$request['city'],$request['hotelName'],$request['checkinDate'],$request['checkOutDate']);	    
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

if ($err) {
	$server = new rabbitMQServer("testRabbitMQError.ini","testServer");
}

$server->process_requests('requestProcessor');
exit();
?>
