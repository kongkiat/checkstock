<?php  

  // PRESTASHOP SETTINGS FILE
//require_once ('config/settings.inc.php');

// Pay no attention to this statement.
// It's only needed if timezone in php.ini is not set correctly.
date_default_timezone_set("UTC");

// The current time. Needed to create the Timestamp parameter below.
$now = new DateTime();

// The parameters for our GET request. These will get signed.
$parameters = array(
    // The user ID for which we are making the call.
    'UserID' => 'kong_kiat@hotmail.com',

    // The API version. Currently must be 1.0
    'Version' => '1.0',

    // The API method to call.
    'Action' => 'ProductUpdate',

    // The format of the result.
    'Format' => 'XML',

    // The current time formatted as ISO8601
    'Timestamp' => $now->format(DateTime::ISO8601)
);

// Sort parameters by name.
ksort($parameters);

// URL encode the parameters.
$encoded = array();
foreach ($parameters as $name => $value) {
    $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
}

// Concatenate the sorted and URL encoded parameters into a string.
$concatenated = implode('&', $encoded);

// The API key for the user as generated in the Seller Center GUI.
// Must be an API key associated with the UserID parameter.
$api_key = 'b0fc26364938d75482f10f0c26af3ec730083163';

// Compute signature and add it to the parameters.
$parameters['Signature'] =
    rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));
	
	
	
	
	
// ...continued from above

// Replace with the URL of your API host.
$url = "https://sellercenter-api.zalora.co.th/";

// Build Query String
$queryString = http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);

// Open cURL connection
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url."?".$queryString);




$url_feed = $url."?".$queryString;


//echo $url_feed;
//echo '<br>';
echo 'Update ';
echo (new \DateTime())->format('Y-m-d H:i:s');


//อ่าน File XML เก็บไว้ในตัวแปร
$myfile = fopen("check_stocks.xml", "r") or die("Unable to open file!");
$input_xml =  fread($myfile,filesize("check_stocks.xml"));
fclose($myfile);
  
//ส่งข้อมูล โดยใช้คำสั่ง  curl  
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url_feed );
  curl_setopt( $ch, CURLOPT_POST, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $input_xml );
  $result = curl_exec($ch);
  curl_close($ch);
  
  
?>  