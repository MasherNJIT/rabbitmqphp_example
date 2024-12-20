<?php

require_once '';

Requests::register_autoloader();

$url = 'https://test.api.amadeus.com/v1/security/oauth2/token';

$data = array(
'client_id' => 'NAfrtWx0wEC5PTJeNyb4CGs3JXWfBrcA',
'client_secret' => 'F2AstWMpYX752IG4',
'grant_type' => 'client_credentials'
);

$headers_1 = array('Content-Type' => 'application/x-www-form-urlencoded');

$requests_response = Requests::post($url, $headers_1, $data);

$body = json_decode($requests_response->body);
$token = $body->access_token;

$endpoint = 'https://test.api.amadeus.com/v1/reference-data/locations/hotels/by-city';

$hotel_data = array(
    'cityCode' => 'EWR'
);

$params = http_build_query($hotel_data);

$end_url = $endpoint.'?'.$params;

$headers_2 = array('Authorization' => 'Bearer '.$token);

$response = Requests::get($end_url, $headers_2);

$body_2 = json_decode($response->body, true);

$hotelNames = [];

foreach ($body_2['data'] as $hotel) {
     $hotelNames[] = $hotel["name"];
}

echo json_encode($hotelNames);

?>