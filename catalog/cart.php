<?php 
session_start();
include_once('includes/functions.php');
include_once('includes/config.php');
loginGranted();//this function needs to be here to check the values of the parameter in the funciton..whether they're nothing or post values
$display = true;
//if the user pressed update cart 
/*FOR FUTURE REFERENCE: to create this functionality i want you to remember how you did it.  down in the for loop IF there is a session you're looping through the array of previously pushed products that were added to the cart and creating those as sessions. In the cart there is a quantity field and it's input type is a text field.  The user can in real time change the value of the quantity they want. In the input field for the name value you assigned it qty-$x...x is the itterator, so everytime a product is added and you itterate through the loop there is a userqty-0 for the first element, userqty-1 for the second element...so on and so forth.  So then when the update button is pressed in the cart you have another for loop and in there we check for the length of the array of the session create a variable which we called $postId and assigned it to the userqyt-$x element.  Then we assigned the qty of the xth element to equal whatever the $_POST quantity of new input is, which then updates the price based on the quanity which in turn will update the grandtotal of the cart the way we have it set up! :) 
*/
if(isset($_POST['update']))
{
	for($x = 0; $x < sizeof($_SESSION['qty']); $x++)
	{
		$postId = 'userqty-'.$x;
		$_SESSION['qty'][$x] = $_POST[$postId];//the session variable of that qty and xth element set it equal to whatever qty the user entered
	}
}
//remove the item the user wants from the cart 
/*FOR FUTURE REFERENCE: when the user hits the remove button the item the user clicked on will be removed.  I unset each session value of whatever was in the cart and the post value of remove.  From there I used the array_values function to reutrn the array containing the new values 
*/
if(isset($_POST['remove']))
{
	unset($_SESSION['product-id'] [$_POST['remove']]);
	unset($_SESSION['prod-name'] [$_POST['remove']]);
	unset($_SESSION['qty'] [$_POST['remove']]);
	unset($_SESSION['price'] [$_POST['remove']]);
	unset($_SESSION['image'] [$_POST['remove']]);
	
	$_SESSION['prod-name'] = array_values($_SESSION['prod-name']);
	$_SESSION['product-id'] = array_values($_SESSION['product-id']);
	$_SESSION['price'] = array_values($_SESSION['price']);
	$_SESSION['qty'] = array_values($_SESSION['qty']);
	$_SESSION['image'] = array_values($_SESSION['image']);
}

?>
<!DOCTYPE html>
<html land="en">
<?php include_once('includes/head.php'); ?>
	<body>
		<?php include_once('includes/nav.php'); ?>
		<h1 class="header">Your Shopping Cart</h1>
		<?php if($granted) :?>
		<!-- <h2>You should be able to see me only if you're logged in</h2> -->
		<h2>Shopping Cart Contents:</h2>
		<form method="post">
		<?php
			if(!isset($_SESSION['product-id']) || empty($_SESSION['product-id']))
			{
				echo "<div class='empty-cart'>";
					echo "<p>cart's empty</p>";
					echo "<br>";
					echo '<div class="apupic">';
						echo '<a href = "catalog.php"><img class="apu" src="img/apu.jpg" alt="apu"></a>'; 
					echo '</div>';
					echo '<h3>Keep Shopping...Click on Apu!</h3>';
				echo "</div>";
			}
			if(!isset($_POST['purchase']) && isset($_SESSION['product-id']) && !empty($_SESSION['product-id']))
			{
				echo '<div class="carty" id="hide">';
					$tableOpen ='<table><tr><th>Name</th><th>Unit Price</th><th>Quantity</th><th>Total</th></tr>';
					$tableGuts = ''; 
					$tableClose = '</table>';
					$total = 0;
					for($x = 0; $x < sizeof($_SESSION['product-id']); $x++)
					{
						$tableGuts .='<tr>';
						$tableGuts .='<td>'.$_SESSION['prod-name'][$x].'</td>';
						$tableGuts .='<td>'.$_SESSION['price'][$x].'</span></td>';
						$tableGuts .='<td>
						<input type="submit" value="update" name="update" id="dont">
						<input type="number" min="1" max="10000" name="userqty-'.$x.'" value="'.$_SESSION['qty'][$x].'">
						<button name="remove" value="'.$x.'">remove me</button>
						</td>';
						$tableGuts .='<td>'.(number_format($_SESSION['price'][$x] * $_SESSION['qty'][$x],2)). '</td>';
						$tableGuts .='</tr>';
						$total += ($_SESSION['price'][$x] * $_SESSION['qty'][$x]);	
						
					}
					$tableGuts .= '<tr><td colspan="3">Grand Total:</td><td><span id ="grandtotal">'.number_format($total,2).'</span> </td></tr>';
					$table = $tableOpen.$tableGuts.$tableClose;
					echo $table;
					echo '<div class="purchase-div">';
						echo '<input type="submit" value="purchase" name="purchase">';
					echo '</div>';
				echo '</div>';
			}
		?>

		<?php
			if(isset($_POST['purchase']))
			{	$total = 0;
				echo "<div class='purchase-order'>";
					echo "<h3>thank you...your order is being processed..but will probably never be delivered</h3>";
					echo '<br>';
					echo "<h3>here's what you orderd:</h3>";
					echo '<br>';
					echo '<table class="purchaseditems">';
					echo '<tr><th>Item Name</th><th>Item Price</th><th>Image</th></tr>';
					for($x = 0; $x < sizeof($_SESSION['product-id']); $x++)
					{
						echo '<tr><td>';
						echo "<h3> ".$_SESSION['prod-name'][$x]. "</h3>";
						echo '</td><td>';
						echo "<h3>$".(number_format($_SESSION['price'][$x] * $_SESSION['qty'][$x],2))."</h3>";
						echo '</td><td>';
						echo "<h3>".$_SESSION['image'][$x]."</h3>";
						echo '</td></tr>';
						$total += ($_SESSION['price'][$x] * $_SESSION['qty'][$x]);	
					}
					echo "<tr><td colspan='3'><h3>Purchased Grand Total: $" .number_format($total,2)."</h3></td></tr>";
					echo '</table>';
					echo '<a href = "logout.php"><h3>Click here to logout of your account!</h3></a>';
				echo "</div>";
			}

		?>
		</form>
<?php else : ?>
<div class="cart-not-log">
	<h3>You're not logged in...click Flanders he'll help you!</h3>
	<a href = "index.php"><img class="fland" src="img/flanders.jpg" alt="fland"></a>
</div>
<?php endif; ?><!-- you aren't loggedn in -->
	</body>
</html>