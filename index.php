<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>The Ultimate LendUp Challenge</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="Kevin" content="SitePoint">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>



</head>

<body>
	<div class="container" style="padding-top: 150px">
		<h1 class="display-1" style="text-align: center;">FizzBuzz</h1>
		<form id="phone-call" role="form">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Phone Number</label>
		    <input type="number" class="form-control" id="phoneNum" aria-describedby="emailHelp" placeholder="Enter number">
		    <small id="emailHelp" class="form-text text-muted">We'll never share your number with anyone else.</small>
		  </div>

		  <h4>Add an optional delay to your call:</h4>
      <div class="form-group">
        <label for="exampleSelect1">Enter hours up to 5:</label>
		    <input type="number" class="form-control" id="hours" placeholder="Enter number" value= "0" max="2">
		    <small id="emailHelp" class="form-text text-muted">I mean, do you really want to be called hours later?</small>
      </div>
      <div class="form-group">
        <label for="exampleSelect1">Enter minutes up to 60:</label>
		    <input type="number" class="form-control" id="minutes"  placeholder="Enter number" value= "0" max="60">
      </div>
      <div class="form-group">
        <label for="exampleSelect1">Enter seconds up to 60:</label>
		    <input type="number" class="form-control" id="seconds" placeholder="Enter number" value= "0" max="60">
      </div>


		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

<!-- 	Contains modal that pops up on a sucessful phone call -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Success</h4>
	      </div>
	      <div id="success-body" class="modal-body">
	      	Your number has sucessfully been dailed!
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container" style="padding-top: 50px">
		<div class="box">
			<div class="box-body table-responsive table-striped" style= "overflow-x: hidden;">
				<table id="myCalls" class="table table-hover">
		      <thead>
		        <tr style="cursor:default;">
		          <th style="width:10%">Call Number</th>
		          <th style="width:20%">Phone Number</th>
		         	<th style="width:15%">FizzBuzz Number</th>
		          <th style="width:15%">Time of Call</th>
		          <th style="width:25%">Delay</th>
		          <th></th>
		        </tr>
		      </thead>

		      <tbody>
					<?php

					  $servername = "localhost";
					  $username = "root";
					  $password = "";
					  // Create connection
					  $conn = new mysqli($servername, $username, $password, "fizzbuzz");

					  // Check connection
					  if ($conn->connect_error) {
					     die("Connection failed: " . $conn->connect_error);
					  }

					  $sql = "select * from calls";
					  $result = $conn->query($sql);
					  $num_rows = $result->num_rows;

						if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
						  $id= $row['id'];
						  $phone= $row['phone'];
						  $fizz_num= $row['fizz_num'];
						  $call_date= $row['call_date'];
						  $hours= $row['hours'];
						  $minutes= $row['minutes'];
						  $seconds= $row['seconds'];

						echo "<tr class='class_row' id=".$id.">
						  <td style='font-size: 15px'>".$id."</td>
						  <td>".$phone."</td>
						  <td>".$fizz_num."</td>
						  <td>".$call_date."</td>
						  <td>".$hours." hours, ".$minutes." minutes, ".$seconds." seconds</td>
						  <td> 
	              <button id=".$id." phone='".$phone."' type='submit' style='width: 120px; font-size: 12px' type='button' class='btn btn-default replay'> Replay
	              </button>
						  </td>

						  </tr>";
						}
						  } else {
						  } 

						$conn -> close();

				  ?>
			    </tbody>
		    </table>
		  </div>
		</div>
	</div>



	<script>

		//After the user inputs a correct phone number, we send that number to outCall.php to process the number
		// and make the call.
		jQuery(document).ready(function($){

			$('#myCalls').DataTable();

			var request;
			//Function called when first submitting a call
			$("#phone-call").submit(function(event){


			    var $this = $(this);
			    // Prevent default posting of form - put here to work in case of errors
			    event.preventDefault();
			    // Abort any pending request
			    
			    if (request) {
			        request.abort();
			    }
			    // Fire off the request to /outCall.php

			    request = $.ajax({
			        url: "outCall.php",
			        type: "post",
			        data: {
			        	replay: 0,
			          phoneNum: document.getElementById("phoneNum").value,
			          hours: document.getElementById("hours").value,
			          minutes: document.getElementById("minutes").value,
			          seconds: document.getElementById("seconds").value,
			        }
			    });

			    $('#myModal').modal('toggle');
			    // Callback handler that will be called on success
			});

	    $('#myCalls').on("click", ".replay", function(e){
	      //alert($(this).attr('id'));

	      event.preventDefault();
	      if (request) {
	          request.abort();
	      }
	      var id= $(this).attr('id');
	      var phone= $(this).attr('phone');

		    request = $.ajax({
		        url: "outCall.php",
		        type: "post",
		        data: {
		        	replay: id,
		        	phone: phone
		        }
		    });


	      // Abort any pending request
	    });


		});
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>