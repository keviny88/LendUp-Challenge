<?php

	
	//Create a route that will handle Twilio webhook requests
	require_once __DIR__.'\vendor\autoload.php';
	use Twilio\Twiml;


	//Use Twilio PHP SDK to build an XML response
	$response = new Twiml();

	// Use the <Gather> verb to collect user input
	$gather = $response->gather(array('numDigits' => 1));
	// use the <Say> verb to request input from the user
	$gather->say('Lets play the FizzBuzz game!');

	$response->redirect('/voice');

	header('Content-Type: text/xml');

	echo $response;

?>
