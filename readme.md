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

7. In config.php, change all of the required variables. This includes the URL and login information for the database, as well as the API info from Twilio. 

10. And that should be it. My application should have all 4 phases finished. Entries are only made into the table when a call is made and a game of FizzBuzz is sucessfully played. You can refresh to view it when it has been updated. If you want to clear the table, you can just run my mysql file again into the database. 

You can see a version I uploaded on heroku at https://glacial-gorge-23890.herokuapp.com/.

Once again, I apolgize for the complicated set up. If there are any problems, please do not hesitate to email me at "yinkevin8@gmail.com", or even give me a call whenever at 
"(909) 839-3837". Hope you and the team at LendUp have/had a Happy New Year!
 