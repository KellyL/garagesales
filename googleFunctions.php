<?php

  // this function will take a street address and use the google geocode service to convert to lat/long coordinates.
  function addressToLatLng($addr)
  {
  	//make the address URL safe and encode special characters
    $address = str_replace(" ", "+", urlencode($addr));
    //this is the call to the google geocode api
  	$details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "&sensor=false";

  	// use curl to make the query and parse the JSON response
  	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $details_url);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$response = json_decode(curl_exec($ch), true);

  	if($response['status'] != 'OK')
  	{
  		return null;
  	}

  	//print_r($response);
  	$geometry = $response['results'][0]['geometry'];
  	$longitude = $geometry['location']['lng'];
  	$latitude = $geometry['location']['lat'];

  	$array = array('latitude' => $geometry['location']['lat'], 'longitude' => $geometry['location']['lng']);

  	return $array;

  }

  function createMapMaker($string)
  {

  }

//  $city = "254 St. Charles Street, Dryden, ON";
//  $arr = addressToLatLng($city);
//  print_r($arr);
?>