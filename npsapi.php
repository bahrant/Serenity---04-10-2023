<?php

$npsapikey = 'LH3SoLmKgiGLnLY5gxK1EbA5fsBhlaTADoyePk4V';
$url = "https://developer.nps.gov/api/v1/parks?parkCode=&api_key=$npsapikey";

//  Initiate curl
$ch = curl_init();

// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Will return the response, if false it prints the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set the url
curl_setopt($ch, CURLOPT_URL,$url);

// Execute
$result=curl_exec($ch);

// Closing
curl_close($ch);
$parkresult = json_decode($result, true);
var_dump($parkresult);
//echo "<h1>" . $parkresult['data'][0]['fullName'] . "</h1>";
//echo "<p>" . $parkresult['data'][0]['description'] . "</p>";



