<!--navigation menu-->
<!DOCTYPE html> 
<html lang ="en">
<body> 
	<?php
		$urlName = substr($_SERVER['PHP_SELF'],18);//global variable that every page has access to and can access whenever you want 
		
		//use the scandir() function to make your nav more dynamic, it will return an array 
		$fileNames = scandir('.');
		
		//array that holds all the pages in your site 
		$pageArray[] = "index.php";
		for($x =0; $x< sizeof($fileNames); $x++)
		{
			if(substr($fileNames{$x}, -4) == ".php" && $fileNames[$x] !="index.php") $pageArray[]= $fileNames[$x]; 
		}
		//create a for loop to loop through our pages array and create a dynamic navigation menu on each page 
			echo '<nav> <ul>';
			for($x = 0; $x < sizeof($pageArray); $x++)
			{
				echo ($pageArray[$x] == $urlName ? '<li> <a class="current" href="' : '<li><a href="');
				echo $pageArray[$x];
				echo '">';
				//ternary operator..in the event that the first substr is true print out Home, in the event it is not true print the last substring 
				echo (substr($pageArray[$x], 0, -4) == "index" ? "Home" : substr($pageArray[$x], 0, -4));
				echo '</a></li>';
				
			}
		
		echo '</ul> </nav>';
	
	?>
</body>
</html>