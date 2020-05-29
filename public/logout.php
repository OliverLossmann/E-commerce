<?php 
require_once('../src/dbconnect.php');
require_once('../src/config.php');

unset($_SESSION["id"]);
unset($_SESSION["email"]);
$url = "index.php";
if(isset($_GET["session_expired"])) {
	$url .= "?session_expired=" . $_GET["session_expired"];
}
header("Location:$url"); ?>

