<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>The Ultimate LendUp Challenge</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="Kevin" content="SitePoint">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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


	<script>

		//After the user inputs a correct phone number, we send that number to outCall.php to process the number
		// and make the call.
		jQuery(document).ready(function($){

			var request;
			$("#phone-call").submit(function(event){


			    var $this = $(this);
			    // Prevent default posting of form - put here to work in case of errors
			    event.preventDefault();
			    // Abort any pending request
			    
			    if (request) {
			        request.abort();
			    }
			    // Fire off the request to /form.php

			    request = $.ajax({
			        url: "outCall.php",
			        type: "post",
			        data: {
			          phoneNum: document.getElementById("phoneNum").value,
			        }
			    });
			    
			    // Callback handler that will be called on success
			    request.done(function (response, textStatus, jqXHR){
			        // Log a message to the console
			        console.log("Hooray, it worked!");
			        //$("#success-body").append("<p>The following part number has been added to the database: </p> <p> <b style='font-size:30px'>" + response + "</b> </p>");

			        //alert(response);
			        if ($.trim(response) == "FAILURE")
			        {
			          $('#failure').empty();
			          $('#failure').append("Input is invalid. Please try again.");
			          $('#confirm').button('reset');

			        }
			        else
			        {
			          $('#myModal').modal('toggle');
			          // $("#success-body").append("<p>The following part number has been added to the database: </p> <p> <b style='font-size:30px'>" + response + "</b> </p>");
			          
			        }
			    });

			    // Callback handler that will be called on failure
			    request.fail(function (jqXHR, textStatus, errorThrown){
			        // Log the error to the console
			        console.error(
			            "The following error occurred: "+
			            textStatus, errorThrown
			        );
			    });
			});
		});
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>