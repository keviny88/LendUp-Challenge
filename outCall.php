<?php
	

	//Create a route that will handle Twilio webhook requests
	require_once __DIR__.'/vendor/autoload.php';
	use Twilio\Rest\Client;

	//Retrieving the number that we will call
	$phoneNum = $_POST["phoneNum"];
    $hours = $_POST["hours"];
    $minutes = $_POST["minutes"];
    $seconds = $_POST["seconds"];

    $delay = $seconds + ($minutes * 60) + ($hours * 3600);


    // Step 2: Set our AccountSid and AuthToken from https://twilio.com/console
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
            // Step 4: Change the 'To' number below to whatever number you'd like 
            // to call.
            "+19098393837",

            // Step 5: Change the 'From' number below to be a valid Twilio number 
            // that you've purchased or verified with Twilio.
            "+17143861057",

            // Step 6: Set the URL Twilio will request when the call is answered.
            array("url" => "http://127.0.0.1/LendUp-Heroku-App/fizzBuzz.php")
        );
        echo "Started call: " . $call->sid;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
	

?>