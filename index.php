<?php
$method = $_SERVER['REQUEST_METHOD'];
$method ='GET';
//$LanID ='sguna002';

if ($method == 'POST')
{
    $requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$LanID = $json->result->parameters->LanID;

    
     switch ($LanID) {
        
        case "sguna002":
            
            $Status_MSG = "Your Cognizant ID $LanID has been validated. Thanks";
            break;
            
        default:
            $Status_MSG = "Your Cognizant  ID is not valid. Thanks";
            break;
    }

    $response = new \stdClass();

    $response->speech = "abcd" . $Status_MSG . $LanID;

    $response->displayText = "abcd" . $Status_MSG . $LanID;

    $response->source = "webhook";
    echo json_encode($Status_MSG);
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
