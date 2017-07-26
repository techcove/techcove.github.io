<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-07-29',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<table border='1'><tr><th>Course Name</th><th>Course Date</th><th>Paid</th><th>Unpaid</th></tr>";
echo "<tr><td>Facebook Effective Advertising</td><td>29 July 2017</td><td>";
echo(count($result) - 3);
echo "</td>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-07-29',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>



<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-05',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<tr><td>Beginner Coding Bootcamp</td><td>5th August 2017</td><td>";

echo(count($result) - 3 );
echo "</td>";

// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>


<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-05',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>


<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-12',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<tr><td>Web Design and Creation</td><td>12th August 2017</td><td>";

echo(count($result) - 3);
echo "</td>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-12',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-19',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<tr><td>Beginner Coding Bootcamp</td><td>19th August 2017</td><td>";

echo(count($result) - 3 );
echo "</td>";

// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>


<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-19',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-26',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<tr><td>Facebook Effective Advertising</td><td>26 August 2017</td><td>";

echo(count($result) - 3);
echo "</td>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-08-26',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-09-02',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<tr><td>Beginner Coding Bootcamp</td><td>2nd September 2017</td><td>";

echo(count($result) - 3 );
echo "</td>";

// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>


<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-09-02',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-09-09',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<tr><td>Web Design and Creation</td><td>9th September 2017</td><td>";

echo(count($result) - 3);
echo "</td>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-09-09',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>

<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'paid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-09-16',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';
echo "<tr><td>Beginner Coding Bootcamp</td><td>16th September 2017</td><td>";

echo(count($result) - 3 );
echo "</td>";

// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>


<?php

$url = 'https://techcove.api-us1.com';


$params = array(


  'api_key' => '74980610984a373d45d4a06925ac9f6f4779dfef7690c55dcb6db0c0f95d22914fe39c80',

  'api_action' => 'contact_list',

  'api_output' => 'serialize',

  // a comma-separated list of IDs of contacts you wish to fetch
  'filters[tagname]' => 'unpaid',
  // 'filters[fields][%COURSE_SELECTION%]' => 'Beginner Coding Bootcamp',
  'filters[fields][%COURSE_DATE%]' => '2017-09-16',
  
  'full' => 0,


);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';

// echo count($result);

// The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

echo "<td>";
echo(count($result) - 3);
echo "</td></tr>";


// Raw response printed out
// echo 'Raw response printed out:<br />';
// echo '<pre>';
// print_r($response);
// echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;

?>