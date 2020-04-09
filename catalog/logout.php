<?php 
session_start();
include_once('includes/functions.php');
include_once('includes/config.php');
loginGranted();
session_destroy();
header('Location: index.php');
