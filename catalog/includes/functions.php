<?php
/******************************************************************************************************************************/
/****loginGranted() function works to validate the user input against the username and password in the database***************/


	function loginGranted($username="", $password="")//assign default values to the parameters..if nothing is passed use nothing,otherwise use the post variables
	{
		//initialize the global varible granted to false BECAUSE if it becomes true, we will execute the use of the session
			global $granted;
			$granted = false; 
		
		//check to see if the session exists
			if(isset($_SESSION['whateverIwant']))
			{
				$granted = true;
			}
			else{
			//Connection to the database
			include_once('includes/config.php');
			//connect to database
				$connection = mysqli_connect(HOST, USER, PASS, BASE);

			//query command
				$sql = ("SELECT * FROM userinput WHERE username = '$username' AND password = '$password';");

			//run command
				$results= mysqli_query($connection, $sql) or die("Eat My Shorts!"); 

			//mysqli_num_rows returns a 1 if it's true and 0 if it is false 
				$granted = mysqli_num_rows($results);

			//if $granted is true set the cookie
			//you don't execute this portion if the cookie is already set, and we check if the cookie is set up above in the if statement 
			//STARTED MAKING THIS WITH COOKIES AND THEN MOVED TO SESSIONS..IT'S MORE SECURE
				if($granted)
				{
					#setcookie('chip',$username,time()+3600);
					$_SESSION['whateverIwant'] = "whateva";
				}
			}
	}
?>