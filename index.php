<?php
$method = $_SERVER['REQUEST_METHOD'];
//$method ='GET';
//$LanID ='sguna002';

if ($method == 'POST')
{
    $requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$LanID = $json->result->parameters->LanID;
	$username = 'Administrator';
	$password = 'manage';
	//$URL = "http://192.168.0.9:8055/invoke/Default:new_flowservice?num1=2&num2=4";
	$URL = "http://localhost:8055/invoke/Default:new_flowservice?num1=2&num2=4";
	//$URL = 'https://localhost:8999/rest/Default/new_rest/_get?num1=2&num2=4';
	//https://localhost:8999/rest/Default/new_rest/_get?num1=1&num2=4

    
     switch ($LanID) {
        
        case "sguna002":
            
            $Status_MSG = "Your Cognizant ID $LanID has been validated. Thanks";
		     $URL="https://192.168.0.9:5665/rest/Default/new_restExp/_get?num1=2&num2=4";
$context = stream_context_create(array(
'https' => array(

       'header'    => ['Content-type: application/json' , 'Accept: application/json', 'Authorization: Basic '.base64_encode("$username:$password")], 'method'    => 'POST)));

$jsonStr = file_get_contents($URL, false, $context);
//$Status_MSG = "Your Cognizant ID $LanID/$jsonStr has been validated. Thanks";
$obj = json_decode($jsonStr,true);
$Status_MSG = $obj->{'sumTotal'};
            break;
            
        default:
            $Status_MSG = "Your Cognizant  ID is not valid. Thanks";
            break;
    }
	
/*
$URL="https://192.168.0.9:5665/rest/Default/new_restExp/_get?num1=2&num2=4";
$context = stream_context_create(array(
'https' => array(

       'header'    => ['Content-type: application/json' , 'Accept: application/json', 'Authorization: Basic '.base64_encode("$username:$password")], 'method'    => 'POST)));

$jsonStr = file_get_contents($URL, false, $context);
$obj = json_decode($jsonStr,true);
$Status_MSG = $obj->{'sumTotal'};
*/

//HTTP options
/*
$opts = array('http' =>

    array(

        'method'    => 'GET',

        'header'    => array ('Content-type: application/json', "Accept: application/json", 'Authorization: Basic '.base64_encode("$username:$password")),

       // 'content' => "some_content"

    )

);



//Do request

$context = stream_context_create($opts);

$jsonStr = file_get_contents($URL, false, $context);



    	$json = json_decode($jsonStr,true);
	//$json1 = $obj['Responses'];
//$json =json_decode($json1,true);
	//$stdResponse="Nothing :-";

$message = ($json->errormessage == "null" OR empty($json->errormessage) )?"N/A":$json->errormessage;
$Status_MSG = " Status=".$json->{'response'}->{'value'}.";"." Message=".$message;
*/
    $response = new \stdClass();
    $response->speech = "abcd" . $Status_MSG;
    $response->displayText = "abcd" . $Status_MSG;
    $response->source = "webhook";
    echo json_encode($response);
}
else
{
    //echo "This method not allowed here";
    $response = new \stdClass();
    $response->speech = "This method not allowed here";
    $response->displayText = "This method not allowed here";
    $response->source = "webhook";
    echo json_encode($response);
}

?>
