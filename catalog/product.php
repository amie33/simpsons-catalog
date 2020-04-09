<?php 
session_start();
include_once('includes/functions.php');
loginGranted();//this function needs to be here to check the values of the parameter in the funciton..whether they're nothing or post values
include_once('includes/config.php');
$connection = mysqli_connect(HOST, USER, PASS, BASE);//i dont understand why i have to put this here when it's in the config folder right above 

$product = '';
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$sql = 'SELECT * FROM product WHERE id = '.$_GET['id'];
	$results = mysqli_query($connection, $sql);
	$product = '';
	while($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{
		$product .= "<div class='display'>";
			$product .= "<span class='des'>Name: </span>".$rows['name'];
			$product .= "<br>";
			$product .= "<br>";
			$product .= "<span class='des'> Description: </span>" .$rows['description'];
			$product .= "<br>";
			$product .= "<br>";
			$product .= "<span class='des'> Price: </span>$".$rows['price'];
			$product .= "<br>";
			$product .= "<div class='fiximg'>";
				$product .= "<img src='".$rows['image']."'.jpg'>"; 
			$product .= "</div>";
		$product .= "</div>";
	}
}

//if the button is pushed add it to cart 
/*For future referecne: if add to cart is pressed write a command and grab from the database  */
if(isset($_POST['add-to-cart']))
{
	$sql = 'SELECT * FROM product WHERE id = '.$_POST['id'].' LIMIT 1';
	$results = mysqli_query($connection, $sql);
	while($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{
		$price = $rows['price'];
		$prodName= $rows['name'];
		$imagepic = "<img src='".$rows['image']."'.jpg'>";  
	}
	if(!isset($_SESSION['product-id']))
	{
		$_SESSION['product-id']= array();
		$_SESSION['qty']= array();
		$_SESSION['price']= array();
		$_SESSION['prod-name']= array();
		$_SESSION['image']=array();
	}
//this keeps us from duplicating items in the cart 
	$index = array_search($_POST['id'], $_SESSION['product-id']);
	if($index !== false)
	{
		 
		$_SESSION['qty'][$index] += $_POST['qty'];
	}
	else{
		array_push($_SESSION['product-id'],$_POST['id']);
		array_push($_SESSION['qty'], $_POST['qty']);
		array_push($_SESSION['price'], $price);
		array_push($_SESSION['prod-name'], $prodName);
		array_push($_SESSION['image'], $imagepic);
	}
}

?> 
<!--product page-->
<!DOCTYPE html>
<html land="en">
<?php include_once('includes/head.php'); ?>
<body>
	<?php include_once('includes/nav.php'); ?>
	<h1 class="header">Products Page</h1>
	<?php if($granted) :?><!-- making sure we're logged in because if we aren't nothing should be displayed-->
		<!-- <h2>You should be able to see me only if you're logged in</h2> -->
	<?php 
		echo "<p> ".$product. "</p>";
	?>	
	<form method="post"> 
		<div class="prods-display">
			<input type="hidden" name="id" value = "<?php echo $_GET['id']; ?>">
			<input type="text" name="qty" placeholder="How Many of these do you want?"> 
			<input type="submit" value="Add to Cart" name="add-to-cart">
		</div>
	<?php if(isset($_POST['add-to-cart'])):?>
		<div class="back-to-cart">
			<a href="cart.php">Go to cart</a>
			<p>or</p>
			<a href="catalog.php">Keep Shoppin'</a>
		</div>
	</form>
	<?php endif; ?>
<!-- You are not logged in -->
	<?php else : ?>
	<div class="cart-not-log">
		<h3>You're not logged in...click the Mumu!</h3>
		<a href = "index.php"><img class="mumu" src="img/mumu.gif" alt="mumu"></a>
	</div>
	<?php endif; ?>
<script src="js/script.js"></script>
</body>
</html>