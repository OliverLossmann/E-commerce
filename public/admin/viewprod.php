<?php
include_once('../../src/dbconnect.php');
include_once('functions/post.php'); 
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

			<input type="button" name="register" onclick="location.href='index.php'" value="Home">
			<input type="button" name="login" onclick="location.href='add_new_post.php'" value="Create New User">
			<input type="button" name="mypage" onclick="location.href='view_all_posts.php'" value="View All Users">
			<input type="button" name="admin" onclick="location.href='Logout.php'" value="Logout">
			<input type="button" name="logout" onclick="location.href='productlist.php'" value="Product List">

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
			<input type="button" name="return" onclick="location.href='productlist.php'" value="Back">
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