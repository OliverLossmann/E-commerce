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
			<?php if($check_login === false){
			echo	'<li><a href="index.php">Home</a></li>
					 <li><a href="adminpanel.php">Log in</a></li>';
			}else{
			 echo	'<li><a href="index.php">Home</a></li>
					<li><a href="add_new_post.php">Create New User</a></li>
					<li><a href="view_all_posts.php">View All Users</a></li>
					<li><a href="Logout.php">Logout</a></li>';
			}
			?>
			</ul>
		</div>
		<div class="content">
			<div class="left-side">
				<div class="post">
				<div class="post-head">
					<h1><?php echo $post['title'];?></h1>
					<?php echo $post['description'];?>
					<br>
					<?php echo $post['price'];?>
					<div class="post-img">
                       <img src="<?php echo $post['img_url']?>"></img>
                                </div>
				</div>
				
		
			</div>
				
			</div>
			<div class="right-side">
			
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