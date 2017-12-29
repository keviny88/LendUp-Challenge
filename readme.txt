Kevin Yin
This application was created using XAMPP, which can be found here: 
https://www.apachefriends.org/index.html

Thhe specs for this stack are: 
Apache 2.4.29, MariaDB 10.1.29, PHP 7.2.0, Tomcat 7.0.56

I opted to do my project in PHP, based off the LAMP stack. I apologize for the complicated setup, as I realize the LAMP stack may not be the most efficient way to deploy web apps fast and efficiently nowadays, but it is the set of languages I am most familiar with.

1. Import all files into your local environment. My application was located in a folder called "LendUp-App" inside of the htdocs folder of my xampp directory.

2. Go to the php.ini file, usually found in the php or etc folders. Change the variable, "max_execution_time" to 8000. I chose this number since it allotted a little over 2 hours delay, and I didn't think any more was necessary. 

3. Refresh the web server by restarting Apache and Tomcat. 

4. Since the Twilio API requires the application URL to be accessible over the internet, and I was using XAMPP, I had to use ngrok, found here: https://ngrok.com/download

5. Once downloaded, open up the ports for whatever ports you are using. For apache, I used this command:
	./ngrok http 80

6. I utilized a MySQL database. Import the "fizz_schema.sql" file found in the sql folder and import it into the MySQL database to generate the needed tables.

7. In index.php, these 3 lines need to be changed, at 103, 104, and 105 depending on what your database URL, username, and password are:
	$servername = "localhost";
	$username = "root";
	$password = "";

8. The same needs to be done in lines 13, 14, 15 in "fizzBuzz.php".

9. In "outCall.php", the following need to be changed to match with your API config and application:
	25. $AccountSid = "AC7e77f203153635d9019244191774351a";
	26. $AuthToken = "d39dd623888a1dc52f480f252445dd76";
	41. "+17143861057", <----change to whatever your Twilio phone number is
	43. array("url" => "http://dc3f7a66.ngrok.io/LendUp-App/fizzBuzz.php?replay=".$replay. <---change to your internet accessible URL

10. And that should be it. My application should have all 4 phases finished. Entries are only made into the table when a call is made and a game of FizzBuzz is sucessfully played. You can refresh to view it when it has been updated. If you want to clear the table, you can just run my mysql file again into the database. 

Once again, I apolgize for the complicated set up. If there are any problems, please do not hesitate to email me at "yinkevin8@gmail.com", or even give me a call whenever at 
"(909) 839-3837". Hope you and the team at LendUp have/had a Happy New Year!
