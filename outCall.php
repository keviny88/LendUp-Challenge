<?php
	//Create a route that will handle Twilio webhook requests
	require_once __DIR__.'/vendor/autoload.php';
	use Twilio\Rest\Client;

	//Retrieving the number that we will call
    $replay = $_POST["replay"];
	$phoneNum = $_POST["phoneNum"];


    // If this phone call is a replay. set the delay to zero
    if ($replay == 0) {
        $hours = $_POST["hours"];
        $minutes = $_POST["minutes"];
        $seconds = $_POST["seconds"];
    }
    else {
        $hours = 0;
        $minutes = 0;
        $seconds = 0;
    }
    $delay = $seconds + ($minutes * 60) + ($hours * 3600);

    
    $AccountSid = "AC7e77f203153635d9019244191774351a";
    $AuthToken = "d39dd623888a1dc52f480f252445dd76";

    //Delay by a user requested time
    sleep($delay);
    flush();

    // Step 3: Instantiate a new Twilio Rest Client
    $client = new Client($AccountSid, $AuthToken);

    try {
        // Initiate a new outbound call;
        $call = $client->account->calls->create(

            "+1".$phoneNum,

            "+17143861057",

            array("url" => "http://dc3f7a66.ngrok.io/LendUp-App/fizzBuzz.php?replay=".$replay.
                "&phoneNum=".$phoneNum."&hours=".$hours."&minutes=".$minutes."&seconds=".$seconds) 
        );
        echo "Started call: " . $call->sid;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
	

?>