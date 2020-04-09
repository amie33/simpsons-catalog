<?php
	session_start();
	//connection to the database in the config file
		include_once('includes/config.php');
	//connect to database
		$connection = mysqli_connect(HOST, USER, PASS, BASE);

	//command
		$sql = "SELECT * FROM product;";
	
	//run command
		$results= mysqli_query($connection, $sql) or die("Eat My Shorts!"); 
?>
	</body>
</html>
<!DOCTYPE html>
<html land="en">
	<?php include_once('includes/head.php'); ?>
	<body>
		<?php include_once('includes/nav.php'); ?>
		<div class="catalog-headdiv">
			<h1 class="header-catalog">Catalog Page</h1>
		</div>
<?php
	echo '<div class="table-wrapper">';
		echo '<table class="show-prod">';
	//creaet the table with the items stored in the database
	//POSSIBLY REFACTOR THIS INTO A FUNCTION AND PUT IT IN INCLUDES FOLDER 
		echo '<tr><th>Item Name</th><th>Item Price</th><th>Image</th><th>Details</th></tr>';
		while($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
		{
			$id = $rows['id'];//take id and assign it to the id in the database
			echo '<tr><td>';
			echo $rows['name'];
			echo '<br>';
			#echo '<a href="index.php">Add to Cart</a>';
			#echo '</td><td class="descrip">';
			#echo $rows['description']; 
			echo '</td><td>';
			echo '$'.$rows['price'];
			echo '</td><td>';
			echo "<img src='".$rows['image']."'.jpg";
			echo '<br>';
			echo '</td><td>';
			//for the echo statment below I want you to remember how you got it to work.
			//you assigned a variable called $id to the corresponding id's in the database above then
			//in your link you conncatonated that varible to the url so that each time you click on 
			//a product its corresponding $id in the database matches in the url
			echo '<a class="view-details" href="product.php?id='.$id.'">View Products</a>';
			echo '</td></tr>';
		}
		echo '</table>';
	echo '</div>';
?>
	</body>
</html>