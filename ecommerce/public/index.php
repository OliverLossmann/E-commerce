<?php
require ('../src/config.php');
require ('../src/dbconnect.php');
require('admin/functions/main.php');

$post  = new Order;
$check = new Order;  
$posts = $post->get_all_products();


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
			<a class="nav-link" type="button" name="register" href='register.php'>Register</a>
			</li>
	
<?php if (empty($_SESSION['id'])) {
	echo "<li class='nav-item'>
			<a class='nav-link' type='button' name='login' href='login.php'>Login</a>
		</li>";
} elseif (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    
}?>
			
			<li class="nav-item">
			<a class="nav-link" type="button" name="mypage" href='mypage.php'>Go to profile</a>
		</li>
		<li class="nav-item">
            <a class="nav-link" type="button" name="logout" href='logout.php'>Logout</a>
        </li>
		<li class='nav-item'>	
			<a class='nav-link' type='button' name='admin'href='admin/index.php'>Admin</a>
		</li>
        </ul>
    </div>
</nav>
<header class="page-header header container-fluid">
	<div class="description">
  <h1>Welcome to the Landing Page!</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis. Suspendisse consectetur mi id libero fringilla, in pharetra sem ullamcorper.</p>
</div>
</header>
<div class="container features">
  <div class="row">
  	<?php foreach($posts as $post){?>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <a  href="viewproduser.php?id=<?php echo $post['id'];?>"><img class="img-fluid" src="<?php echo $post['img_url']?>"></a>
      <p><a href="../public/viewproduser.php?id=<?php echo $post['id'];?>"><?php echo $post['title'];?></a> <a class="price"><?php echo $post['price'];?> KR </a></p>
      <form action="add-cart-item.php" method="POST">
      	<input type="hidden" name="productId" value="<?=$post['id']?>">
      	<input type="number" name="quantity" value="1" min="0">
      	<input type="submit" name="addToCart" value="Add to cart">
      </form>
      <br>
  </div> 
  <?php }?>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="javascript/main.js"></script>
</body>
</html>