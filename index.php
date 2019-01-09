<?php
$method = $_SERVER['REQUEST_METHOD'];
$method ='POST';
$LanID ='sguna002';

if ($method == 'POST')
{
    
     switch ($LanID) {
        
        case "sguna002":
            
            $Status_MSG = "Your Cognizant ID $LanID has been validated. Thanks";
            break;
            
        default:
            $Status_MSG = "Your Cognizant  ID is not valid. Thanks";
            break;
    }

    $response = new \stdClass();

    $response->speech = $Status_MSG;

    $response->displayText = $Status_MSG;

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
