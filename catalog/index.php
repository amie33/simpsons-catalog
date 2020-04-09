<?php
	session_start();
	include_once('includes/functions.php');
	//create variables 
		global $newfirstP;
		$username=""; 
		$password="";
		$message="";
		$granted=false;
		//$display = true; //if the button is pressed $display is set to false 
		loginGranted();//use this function to see if cookie is already set..see if you need to hook up to the database or not	
	if(!$granted)
	{
		//has submit been pressed
		if(isset($_GET['s']) && $_GET['s'] == true)
		{
			//check database to validate username and password
			if(isset($_POST["user-name"]) && isset($_POST["pass"]))
			{
				//assign variable to my post information
				$username = $_POST["user-name"];
				$password = $_POST["pass"];
				
				//if it is true flip the flag..run the function
				//if its true it gives them access throughout the website
					loginGranted($username, $password);	
			}
			//access  was denied, $granted is false AND if the button was actually pushed
				if(!$granted)
				{
					//$display= false;
					$message = "<div id='homer' value ='homer' class='nope'>";
					$message .= "<h3 class='fail'>D'OH! Try again!</h3>";
					$message .= "<img class='homey' src ='img/homey.gif'>";
					$message .= "</div>";
				}
		}
	}
?>
<!DOCTYPE html>
<html land="en">
	<?php include_once('includes/head.php'); ?>
	<body>
	<?php include_once('includes/nav.php'); ?>
		<h1 class="header">Welcome to the kwik-e-mart!</h1>
		<h2 class="header2">Find All the Items from the Simpsons Episodes</h2>
		<h2>Please Log in</h2>
	
	<?php if(!$granted):?>
	<?php echo $message;?>
	<div id="randomDiv" class="login-form-wrapper">
		<form  action="?s=true" method="post">
		<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="user-name">
		<label for="passw"><b>Password</b></label>
			<input type="password" placeholder="Password" name="pass" autocomplete="new-password" id="password_one">
			<input onclick= "myFunction()" type="submit" name="login" class="login">
		</form>
	</div>
	<div class="abepic">
		<a href = "create-account.php"><img class="abe" src="img/abe.gif" alt="abe"></a> 
	</div>
	<div class="create-div">
		<p class="abepara">Dont have an account yet...click abe to get started!</p>
	</div>
	<?php else: ?>
	<div class="excelent">
		<img src="img/burns.gif" alt="burns" class="burns">
	</div>
	<?php endif; ?>
</body>
</html>
































