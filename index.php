<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST')
{
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
    
    $LanID = $json->result->parameters->LanID;
    $ActaulLanID = $json->result->resolvedQuery;
    $Environment = $json->result->parameters->Environment;
    $ServerName = $json->result->parameters->ServerName;
    $EnquireCommand = $json->result->parameters->EnquireCommand;
    $ServerCommand = $json->result->parameters->ServerCommand;
    $ConfirmCommand = $json->result->parameters->ConfirmCommand;
    $CC_ServerName = $json->result->parameters->CC_ServerName;
    $CC_Auth = $json->result->parameters->CC_Auth;
    $RuntimeComp_S = $json->result->parameters->RuntimeComp_S;
    $RuntimeComp = $json->result->parameters->RuntimeComp;
    $Options = "******Try any other server or command for $Environment - $ServerName $LanID or proceed to exit";
  //  $CC_ServerName = '100.100.123.12:5555';
	$username = "Administrator";
	$password = "manage";
    
    switch ($LanID) {
        
        case "sguna002":
            
            $Status_MSG = "Your Cognizant ID $LanID has been validated. Thanks";
            break;
            
        default:
            $Status_MSG = "Your Cognizant  ID is not valid. Thanks";
            break;
    }


	$context = stream_context_create(array(
    'http' => array(
        'header'  => ["Content-Type: application/json" , "Accept: application/json" , "Authorization: Basic " . base64_encode(($username:$password)],'method'  => 'GET')));

    	$URL="http://192.168.0.9:5555/rest/Default/new_rest/_get?num1=2&num2=4";
    	$jsonStr = file_get_contents($URL,false,$context);
	$obj = json_decode($jsonStr,true);
	$json1 = $obj['response'];
	$json =json_decode($json1);
	$stdResponse="Nothing :-";
	$message = '';
	$message = ($json->errormessage == "null" OR empty($json->errormessage) )?"N/A":$json->errormessage;
	$Status_MSG = " Status=".$json->status.";"." Message=".$message;
 
    
    $response = new \stdClass();
    $response->speech = "7-Eleven Resp: "  .    $Status_MSG . $obj;
    $response->displayText = "7-Eleven Resp: "  .  $Status_MSG . $obj;
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