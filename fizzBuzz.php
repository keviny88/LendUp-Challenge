<?php

	//Create a route that will handle Twilio webhook requests
	require_once __DIR__.'/vendor/autoload.php';
	use Twilio\Twiml;

	$replay= $_GET['replay'];
	$phoneNum= $_GET['phoneNum'];
	$hours= $_GET['hours'];
	$minutes= $_GET['minutes'];
	$seconds= $_GET['seconds'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	// Create connection to the MySQL database
	$conn = new mysqli($servername, $username, $password, "fizzbuzz");

	// Check connection
	if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
	}

	$response = new Twiml();

	//echo "BEGINNING!";

	function fizzBuzz($digit)
	{
		$result = "";
		echo $result;
		for ($i = 1; $i <= $digit; $i++)
		{
			if ($i % 3 == 0) {
				$result.= ", Fizz";
			}
			if ($i % 5 == 0) {
				$result.= ", Buzz";
			}
			if (($i % 5 != 0) && ($i % 3 != 0)) {
				$result.= ", ".$i;
			}
		}
		return $result;
	}

	// If this is a replay call, don't ask them to enter a number. Instead, just play out the fizzBuzz result of the replay
	if ($replay != 0)
	{
		$sql = "select * from calls where id='".$replay."'";
		$result = $conn->query($sql);
		$num_rows = $result->num_rows;
		if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
		  $fizz_num= $row['fizz_num'];
		}
		  } else {
		}

		$response->say(fizzBuzz($fizz_num));

	} elseif (array_key_exists('Digits', $_POST)) {
		$fizz = fizzBuzz($_POST['Digits']);
		//echo $fizz;
	    $response->say($fizz);

	} else {
	    // If no input was sent, use the <Gather> verb to collect user input
	    // A user has 3 seconds to enter a number, up to 5 digits
	    $gather = $response->gather(array('numDigits' => 3));
	    // use the <Say> verb to request input from the user
	    $gather->say('Lets play fizzbuzz. Enter a number!');

	    // If the user doesn't enter input, loop
	    $response->redirect('/voice');
	}

	$conn -> close();



	// Render the response as XML in reply to the webhook request
	header('Content-Type: text/xml');
	echo $response;
?>
