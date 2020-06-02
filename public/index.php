<?php

require '../src/config.php';

require '../src/dbconnect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
	<h1>Shop page</h1>
	<a href="register.php">Register here</a>
	<a href="login.php">Login here</a>
	<input type="button" name="return" onclick="location.href='mypage.php'" value="Go to profile">
	<input type="button" name="return" onclick="location.href='admin/index.php'" value="Admin">
</body>
</html>
