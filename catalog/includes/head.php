<!--this is for my files and headings-->
<?php
//This keeps all my head tags from the htlm on every page together. 
//This is where is store my link to my css, and google fonts.
//This is how I am able to see what page I am on as I flip through all the pages of my catalog 
$url = substr($_SERVER['PHP_SELF'],18,-4); 
if($url == "index")
{
	$header = "Home Page";
}
else{
	$header = ucfirst($url). " Page";
}
echo
	'<head>
		<title>'. $header .'</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>'; 
?>