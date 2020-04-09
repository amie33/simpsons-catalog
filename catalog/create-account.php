<?php 
session_start();
include_once('includes/functions.php');
loginGranted();//this function needs to be here to check the values of the parameter in the funciton..whether they're nothing or post values
?>
<!DOCTYPE html>
<html land="en">
<?php include_once('includes/head.php'); ?>
	<body>
		<?php include_once('includes/nav.php'); ?>
		<h1 class="header">Create Account Page</h1>
		<?php if(!$granted && !isset($_POST['submit'])){ ?> <!-- you are not logged you are NOT granted there fore the contents of ceate account will show-->
			<!-- You should only be able to see the contents of this page IF you are NOT logged in -->
			<h2>Create An Account and Start Shopping!</h2>
			<div class= "create-form-wrapper">
				<form method="post" action="create-account.php">
				<input type="text" placeholder="User Name" name="userName" id="user" required>
				<input type="password" placeholder="Password" name="firstPassword" autocomplete="new-password" id="password_one" onkeyup="letsCheck()"required>
				<input type="password" placeholder="Confirm Password" name="confirmPassword" onkeyup="validate()" id="password_two">
				<div class="divy"> <span id="message" class="spanny"></span> </div>
				<input type="submit" name="submit" class="submit" id = "subbutton" value="Create Account">
				<input type="reset" name="reset" class="reset"> 
				</form>
				<div class="theMess" id="theMess">
					<h3>Password must contain the following :</h3>
					<p id="number" class="invalid">A number</p>
					<p id="length" class="invalid">Minimum 8 characters</p>
				</div>
			</div>
		
<?php include_once('includes/config.php') ?>
<?php
}elseif(isset($_POST['submit']))
{	
	$connection = mysqli_connect(HOST, USER, PASS, BASE);
	$newuser = $_POST['userName'];
	$newfirstP = $_POST['firstPassword'];
	$secondP = $_POST['confirmPassword'];
	
	$sql_u = "SELECT * FROM userinput WHERE username = '$newuser'";
	$sql_p = "SELECT * FROM userinput WHERE password ='$newfirstP'";
	$sql_s = "SELECT * FROM `secret code` WHERE 1";
	
	$results_u = mysqli_query($connection, $sql_u) or die("Sorry Cant Connect");
	$results_p = mysqli_query($connection, $sql_p) or die("Sorry We can't do this");
	$results_s = mysqli_query($connection, $sql_s) or die("Sorry Sucker!"); 
	
	$rows = mysqli_fetch_array($results_s, MYSQLI_ASSOC);

	if(mysqli_num_rows($results_u) > 0)
	{
		echo '<div class="failed">';
			echo '<a href="create-account.php"><img src ="img/ralph.jpg" class="ralph"></a>';
			echo "<h3 class ='fail'>Sorry that username is already taken!</h3>";
		echo '</div>';
	}else
	{
		$query = "INSERT INTO userinput (username, password) VALUES('$newuser', '$newfirstP');";
		$results = mysqli_query($connection, $query) or die("Cant connect Miss");
		echo '<div class="success">';
			echo '<a href="index.php"><img src="img/auto.jpg" class="auto" ></a>';
			echo "<h3 class ='saved'>Cool Mannnn...click me to login!</h3>"; 
		echo '</div>';
		exit();
	}
}else
{
	echo "<div class='have-an-account'>";
		echo "<h3>You already have an account silly</h3>";
		echo "<a href = 'catalog.php'><img src='img/krusty.gif' class='krusty'></a>";
	echo "</div>";
}
?>
<?php //endif;?>
<script src="js/script.js"></script>
	</body>
</html>