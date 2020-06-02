<?php
include_once('../src/dbconnect.php');
include_once('admin/functions/post.php'); 
$post  = new Order;
$check = new Order;
$check_login = $check->logged_in();


if(isset($_GET['id'])){
	$pid = $_GET['id'];
	$post = $post->fetch_product($pid);
	?>
<html>
	<head>
		<title>Product</title>
		<link rel="stylesheet" href="css/style.css">		
	</head>


	<body>
		<div class="wp">
		<div class="menu">
				<ul>
			<input type="button" name="register" onclick="location.href='register.php'" value="Register">
			<input type="button" name="login" onclick="location.href='login.php'" value="Login">
			<input type="button" name="mypage" onclick="location.href='mypage.php'" value="Go to profile">
			<input type="button" name="admin" onclick="location.href='admin/index.php'" value="Admin">
			<input type="button" name="logout" onclick="location.href='logout.php'" value="Logout">
        </ul>
		</div>
		<div class="content">
			<div class="left-side">
				<div class="post">
				<div class="post-head">
					<h1><?php echo $post['title'];?></h1>
					<div class="post-img">
                       <img src="<?php echo $post['img_url']?>"></img>
                       <br>
                       <?php echo $post['price'];?> KR
                       <h2><?php echo $post['description'];?></h2>
                                </div>
				</div>
				
		
			</div>
				
			</div>
			<div class="right-side">
			<input type="button" name="return" onclick="location.href=''" value="Add To Cart">
			<input type="button" name="return" onclick="location.href='index.php'" value="Back">
			</div>
			</div>
			</div>
		</div>
		<div class="footer">
		
		</div>
	</body>
</html>

	<?php
}else{
	header('Location:index.php');
}

?>