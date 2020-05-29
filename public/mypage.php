<?php 
require '../src/config.php';

require '../src/dbconnect.php';

if (empty($_SESSION['id'])) {
	header("Location:redirect.php");
} elseif (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . "!";
}
	



?>
<input type="button" name="edit" onclick="location.href='edit.php'" value="Edit">
<input type="button" name="return" onclick="location.href='index.php'" value="Return Home">
<input type="button" name="return" onclick="location.href='logout.php'" value="Logout">