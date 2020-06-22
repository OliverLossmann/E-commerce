<?php 
require ('../src/config.php');
require ('../src/dbconnect.php');
	

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<nav class="navbar navbar-expand-md">
	<a class="navbar-brand" href="index.php">Home</a>
 <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
 	 <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="main-navigation">
		<ul class="navbar-nav">
			<?php include('cart.php') ?>
			<li class="nav-item">
			<a class="nav-link" type="button" name="products" href='products.php'>Products</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" type="button" name="register" href='edit.php'>Edit Profile</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" type="button" name="login" href='index.php'>Return Home</a>
		</li>
			<li class="nav-item">
			<a class="nav-link" type="button" name="mypage" href='logout.php'>Logout</a>
		</li>
		<li class='nav-item'>	
			<a class='nav-link' type='button' name='admin'href='admin/index.php'>Admin</a>
		</li>

        </ul>
    </div>
</nav>
<header class="page-header header container-fluid">
	<div class="description">
 <?php if (empty($_SESSION['id'])) {
	header("Location:redirect.php");
} elseif (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo "<a style='color:white;'>Welcome to the member's area," ." ". $_SESSION['first_name'] ." ". $_SESSION['last_name'] . "!";
}?>
</div>
</header>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="javascript/main.js"></script>
</body>
</html>