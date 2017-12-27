<?php

	
	//Create a route that will handle Twilio webhook requests
	require_once __DIR__.'/vendor/autoload.php';
	use Twilio\Twiml;

	$response = new Twiml();

	// If the user entered digits, process their request
	if (array_key_exists('Digits', $_POST)) {

	    $response->say($_POST['Digits']);

	} else {
	    // If no input was sent, use the <Gather> verb to collect user input
	    $gather = $response->gather(array('numDigits' => 3));
	    // use the <Say> verb to request input from the user
	    $gather->say('Lets play fizzbuzz. Enter a number!');

	    // If the user doesn't enter input, loop
	    $response->redirect('/voice');
	}

	// Render the response as XML in reply to the webhook request
	header('Content-Type: text/xml');
	echo $response;


?>
