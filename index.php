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
	$URL = "http://localhost:5555/invoke/Default:new_flowservice?num1=2&num2=4";

    
     switch ($LanID) {
        
        case "sguna002":
            
            $Status_MSG = "Your Cognizant ID $LanID has been validated. Thanks";
            break;
            
        default:
            $Status_MSG = "Your Cognizant  ID is not valid. Thanks";
            break;
    }
//HTTP options

$opts = array('http' =>

    array(

        'method'    => 'POST',

        'header'    => array ('Content-type: application/json', 'Authorization: Basic '.base64_encode("$username:$password")),

        'content' => "some_content"

    )

);



//Do request

$context = stream_context_create($opts);

$jsonStr = file_get_contents($URL, false, $context);



    	$obj = json_decode($jsonStr,true);
	$json1 = $obj['response'];
$json =json_decode($json1);
	$stdResponse="Nothing :-";
$message = '';
$message = ($json->errormessage == "null" OR empty($json->errormessage) )?"N/A":$json->errormessage;
$Status_MSG = " Status=".$json->status.";"." Message=".$message;

    $response = new \stdClass();
    $response->speech = "abcd" . $Status_MSG . $jsonStr;
    $response->displayText = "abcd" . $Status_MSG . $jsonStr;
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
