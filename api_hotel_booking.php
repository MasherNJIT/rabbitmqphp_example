<?php

require_once 'vendor\rmccue\requests\library\Requests.php';

Requests::register_autoloader();

$url = 'https://test.api.amadeus.com/v1/security/oauth2/token';
$$data = array(
    'client_id' => 'NAfrtWx0wEC5PTJeNyb4CGs3JXWfBrcA',
    'client_secret' => 'F2AstWMpYX752IG4',
    'grant_type' => 'client_credentials'
    );

$headers = array('Content-Type' => 'application/x-www-form-urlencoded');
try {
$requests_response = Requests::post($url, $headers, $data);
echo 'Response from the authorization server:';
$response_body = json_decode($requests_response->body);
echo '<pre>', json_encode($response_body, JSON_PRETTY_PRINT), '</pre>';
if(property_exists($response_body, 'error')) die;
$access_token = $response_body->access_token;
} catch (Exception $e) {
print_r($e->getMessage());
}

?>