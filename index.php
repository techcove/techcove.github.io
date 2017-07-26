<?php

###############################################################
# Page Password Protect 2.13
###############################################################
# Visit http://www.zubrag.com/scripts/ for updates
############################################################### 
#
# Usage:
# Set usernames / passwords below between SETTINGS START and SETTINGS END.
# Open it in browser with "help" parameter to get the code
# to add to all files being protected. 
#    Example: password_protect.php?help
# Include protection string which it gave you into every file that needs to be protected
#
# Add following HTML code to your page where you want to have logout link
# <a href="http://www.example.com/path/to/protected/page.php?logout=1">Logout</a>
#
###############################################################

/*
-------------------------------------------------------------------
SAMPLE if you only want to request login and password on login form.
Each row represents different user.

$LOGIN_INFORMATION = array(
  'zubrag' => 'root',
  'test' => 'testpass',
  'admin' => 'passwd'
);

--------------------------------------------------------------------
SAMPLE if you only want to request only password on login form.
Note: only passwords are listed

$LOGIN_INFORMATION = array(
  'root',
  'testpass',
  'passwd'
);

--------------------------------------------------------------------
*/

##################################################################
#  SETTINGS START
##################################################################

// Add login/password pairs below, like described above
// NOTE: all rows except last must have comma "," at the end of line
$LOGIN_INFORMATION = array(
  'techcove' => 'T3chcove!',
  'admin' => 'adminpass',
  'passwd'=>'admin'
);

// request login? true - show login and password boxes, false - password box only
define('USE_USERNAME', true);

// User will be redirected to this page after logout
define('LOGOUT_URL', 'http://www.example.com/');

// time out after NN minutes of inactivity. Set to 0 to not timeout
define('TIMEOUT_MINUTES', 0);

// This parameter is only useful when TIMEOUT_MINUTES is not zero
// true - timeout time from last activity, false - timeout time from login
define('TIMEOUT_CHECK_ACTIVITY', true);

##################################################################
#  SETTINGS END
##################################################################


///////////////////////////////////////////////////////
// do not change code below
///////////////////////////////////////////////////////

// show usage example
if(isset($_GET['help'])) {
  die('Include following code into every page you would like to protect, at the very beginning (first line):<br>&lt;?php include("' . str_replace('\\','\\\\',__FILE__) . '"); ?&gt;');
}

// timeout in seconds
$timeout = (TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60);

// logout?
if(isset($_GET['logout'])) {
  setcookie("verify", '', $timeout, '/'); // clear password;
  header('Location: ' . LOGOUT_URL);
  exit();
}

if(!function_exists('showLoginPasswordProtect')) {

// show login form
function showLoginPasswordProtect($error_msg) {
?>
<html>
<head>
  <title>Please enter password to access this page</title>
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
</head>
<body>
  <style>
    input { border: 1px solid black; }
  </style>
  <div style="width:500px; margin-left:auto; margin-right:auto; text-align:center">
  <form method="post">
    <h3>Please enter password to access this page</h3>
    <font color="red"><?php echo $error_msg; ?></font><br />
<?php if (USE_USERNAME) echo 'Login:<br /><input type="input" name="access_login" /><br />Password:<br />'; ?>
    <input type="password" name="access_password" /><p></p><input type="submit" name="Submit" value="Submit" />
  </form>
  <br />
  <a style="font-size:9px; color: #B0B0B0; font-family: Verdana, Arial;" href="http://www.zubrag.com/scripts/password-protect.php" title="Download Password Protector">Powered by Password Protect</a>
  </div>
</body>
</html>

<?php
  // stop at this point
  die();
}
}

// user provided password
if (isset($_POST['access_password'])) {

  $login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
  $pass = $_POST['access_password'];
  if (!USE_USERNAME && !in_array($pass, $LOGIN_INFORMATION)
  || (USE_USERNAME && ( !array_key_exists($login, $LOGIN_INFORMATION) || $LOGIN_INFORMATION[$login] != $pass ) ) 
  ) {
    showLoginPasswordProtect("Incorrect password.");
  }
  else {
    // set cookie if password was validated
    setcookie("verify", md5($login.'%'.$pass), $timeout, '/');
    
    // Some programs (like Form1 Bilder) check $_POST array to see if parameters passed
    // So need to clear password protector variables
    unset($_POST['access_login']);
    unset($_POST['access_password']);
    unset($_POST['Submit']);
  }

}

else {

  // check if password cookie is set
  if (!isset($_COOKIE['verify'])) {
    showLoginPasswordProtect("");
  }

  // check if cookie is good
  $found = false;
  foreach($LOGIN_INFORMATION as $key=>$val) {
    $lp = (USE_USERNAME ? $key : '') .'%'.$val;
    if ($_COOKIE['verify'] == md5($lp)) {
      $found = true;
      // prolong timeout
      if (TIMEOUT_CHECK_ACTIVITY) {
        setcookie("verify", md5($lp), $timeout, '/');
      }
      break;
    }
  }
  if (!$found) {
    showLoginPasswordProtect("");
  }

}

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