<?php

$host = "10.241.148.28";
$dbname = "loginTest";
$username = "Evan";
$password = "password";

$mysqli = new mysqli(hostname: $host, username: $username, password: $password,  database: $dbname);
                     
if ($mysqli->connect_errno) {
	    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
